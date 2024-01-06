<?php

use Illuminate\Support\Facades\Http;

function getData()
{
    $url = 'https://api.ipify.org/?format=json';
    try {
        $response = Http::get($url);
        
        $data = $response->json();
        $data['http_code'] = $response->getStatusCode();
        return $data;
    } catch (\Throwable $th) {
        return [
            'status' => 'error',
            'http_code' => 500,
            'message' => 'service unavailable'
        ];
    }
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    
    $api = "https://api.opencagedata.com/geocode/v1/json?q=" . $lat1 . "," . $lon1 . "&language=en&key=471fe1412c03495eac64ae34d0e91944";
    $response = Http::get($api);
    $data = json_decode($response->body());
    
    $lat1 = $data->results[0]->geometry->lat;
    $lon1 = $data->results[0]->geometry->lng;
  
    $api = "https://api.opencagedata.com/geocode/v1/json?q=" . $lat2 . "," . $lon2 . "&language=en&key=471fe1412c03495eac64ae34d0e91944";
    $response = Http::get($api);
    $data = json_decode($response->body());

    $lat2 = $data->results[0]->geometry->lat;
    $lon2 = $data->results[0]->geometry->lng;
  
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);
  
  
    
  if ($unit == "K") {
      return ($miles * 1.609344);
    } else
   
  if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return
   
  $miles;
    }
  }