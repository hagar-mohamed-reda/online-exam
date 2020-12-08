<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * my funtions
 */
if (!function_exists('notify')) {

    /**
     * Translate the given message.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @return string|array|null
     */
    function notify($title, $body='') { 
        try {
            return App\Notification::notify($title, $body);
        } catch (\Exception $exc) {
            return null;
        } 
    }

}