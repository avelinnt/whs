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

$app->post('/API/assertions', function (Request $request, Response $response, $arg) {

  $body = $request->getBody();
  $decode_body = json_decode($body, true);

  $assertion = new App\Assertion;
  $assertion -> topic = $decode_body['topic'];
  $assertion -> sentence = $decode_body['sentence'];
  $assertion -> save();
  $result = json_encode($assertion);
  return $result;
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

$app->put('/API/assertions/{id}', function(Request $request, Response $response) {
  $body = $request->getBody();
  $decode_body = json_decode($body, true);
  $route = $request->getAttribute('route');
  $assId = $route->getArgument('id');
  $result = App\Assertion::find($assId);
  $result -> topic = $decode_body['topic'];
  $result -> sentence = $decode_body['sentence'];
  $result->save();

  $assertions = json_encode($result);
  $body = $response->getBody();
  $body->write($assertions);
  $newResponse = $response->withHeader('Content-type', 'application/json');
  return $newResponse;

});

$app->delete('/API/assertions/{id}', function(Request $request, Response $response) {
  $body = $request->getBody();
  $decode_body = json_decode($body, true);
  $route = $request->getAttribute('route');
  $assId = $route->getArgument('id');
  $result = App\Assertion::find($assId);
  $result -> delete();

  $assertions = json_encode($result);
  $body = $response->getBody();
  $body->write($assertions);
  $newResponse = $response->withHeader('Content-type', 'application/json');
  return $newResponse;

});
