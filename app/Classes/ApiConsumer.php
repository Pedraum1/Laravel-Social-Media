<?php

namespace App\Classes;

use Illuminate\Support\Facades\Http;

class ApiConsumer
{
  protected static $token;

  public static function initialize()
  {
    if(!self::$token){
      self::$token = env('AUTH_TOKEN'); 
    }
  }

  private static function getRequest(string $url)
  {
    ApiConsumer::initialize();
    $response = Http::withHeaders(['Authorization'=>self::$token])->get($url);
    if($response->successful()){
      return $response->json();
    }
    return $response->status();
  }

  private static function postRequest(string $url,array $keys)
  {
    ApiConsumer::initialize();
    $response = Http::withHeaders(['Authorization'=>self::$token])->post($url,$keys);
    if($response->successful()){
      return $response->json();
    }
    return $response->status();
  }

  public static function consume(string $url,string $method = 'get',array $keys = null)
  {
    switch($method){

      case($method == 'post'):
        return ApiConsumer::postRequest($url,$keys);
      break;

      case($method == 'get'):
        return ApiConsumer::getRequest($url);
      break;
    }
  }
}