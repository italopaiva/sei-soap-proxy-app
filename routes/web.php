<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Http\Request;

$app->get('/', function () use ($app) {
  return $app->version();
});

$app->post('/seiws', function (Request $request) {
  $url = env('SEI_WS_URL');
  $seiWs =  new \SoapClient($url);

  try{
    $response = $seiWs->__soapCall(
      $request->input('service'),
      $request->input('data')
    );
    $response = json_decode(json_encode($response), true);

    return response()->json($response);
  }catch(Exception $e){
    return response()->json($e, 400);
  }
});
