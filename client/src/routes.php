<?php
// Routes

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;


// Get an html view of assertions
$app->get('/assertions', function (Request $request, Response $response, $args) {
  // prepare the search query
  $search=$request->getQueryParam('search');
  if (strlen($search) == 0){
    //$search = '';
  }else {
    $search = '?search='.$search;
  }

  $settings = $this->get('settings')['server'];

  //CURLFile
  $curl = curl_init();
  curl_setopt_array($curl,array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $settings['address'].$search
  ));
  $assertions = curl_exec($curl);
  curl_close($curl);

  $args['assertions'] = json_decode($assertions);
  return $this->renderer->render($response, 'assertions_bs.phtml', $args);
});
