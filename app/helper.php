<?php
 if (!function_exists('setting')){
     function setting(){
        return \App\Setting::orderBy('id','desc')->first();
     }
 }
?>