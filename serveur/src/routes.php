<?php
// Routes

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// Get a simple message
$app->get('/API', function(Request $request, Response $response) {
  $body = $response->getBody();
  $body->write("Welcome to whs API");
  return $body;
});

$app->get('/API/assertions', function(Request $request, Response $response) {

  $search=$request->getQueryParam('search');
  if (strlen($search) == 0)
  $search = '';

  $result = App\Assertion::where('sentence', 'like', '%'.$search.'%')->get();

  $assertions = json_encode($result);
  $body = $response->getBody();
  $body->write($assertions);
  $newResponse = $response->withHeader('Content-type', 'application/json');
  return $newResponse;

});

$app->post('/API/assertions', function(Request $request, Response $response) {

  $body = $request->getBody();
  //true pour retourner un tableau associatif
  $input = json_decode($body, true);

  $result = App\Assertion::insert(
    ['topic' =>  $topic = $input["topic"], 'sentence' =>  $sentence = $input["sentence"]]
  );

  // A REVOIR EN DESSOUS

  $assertions = json_encode($result);
  $body = $response->getBody();
  $body->write($assertions);
  $newResponse = $response->withHeader('Content-type', 'application/json');
  return $newResponse;


});

$app->get('/API/assertions/{id}', function(Request $request, Response $response) {

  $route = $request->getAttribute('route');
  $assId = $route->getArgument('id');
  $result = App\Assertion::find($assId);

  $assertions = json_encode($result);
  $body = $response->getBody();
  $body->write($assertions);
  $newResponse = $response->withHeader('Content-type', 'application/json');
  return $newResponse;

});
