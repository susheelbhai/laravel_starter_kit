<?php

if (!function_exists('maskEmail')) {
    function maskEmail($email){
        print preg_replace_callback('/(\w)(.*?)(\w)(@.*?)$/s', function ($matches){
         return $matches[1].preg_replace("/\w/", "*", $matches[2]).$matches[3].$matches[4];
        }, $email);
    }
}
if (!function_exists('maskPhone')) {
    function maskPhone($number){
    
        $mask_number =  str_repeat("*", strlen($number)-4) . substr($number, -4);
        
        return $mask_number;
    }
}

if (!function_exists('custom_date')) {
    function custom_date($params = '')
    {
        $date=date_create($params);
      return date_format($date,"jS F Y");
    }
}

if (!function_exists('custom_time')) {
    function custom_time($params = '')
    {
        $date=date_create($params);
      return date_format($date,"h:i A");
    }
}

if (!function_exists('custom_date_time')) {
    function custom_date_time($params = '')
    {
        $date=date_create($params);
      return date_format($date,"jS F Y, h:i A");
    }
}

if (!function_exists('warrantyType')) {
    function warrantyType($valid_till, $date_of_implant)
    {
        $date_diff = date_diff(date_create($valid_till),date_create($date_of_implant))->format("%a");
                  if($date_diff > 54750){ return 'PFL'; }
                  else { return 'Standard'; }
    }
} 

if (!function_exists('valid_till')) {
    function valid_till($valid_till, $date_of_implant)
                {
                  $date_diff = date_diff(date_create($valid_till),date_create($date_of_implant))->format("%a");
                  if($date_diff > 54750){ return 'PFL'; }
                  else { return custom_date($valid_till); }
                }
} 