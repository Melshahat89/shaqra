<?php

function getSetting($name){
    $setting = \App\Application\Model\Setting::where('name' , $name)->first();
    return $setting ? $setting->body_setting : null;
}