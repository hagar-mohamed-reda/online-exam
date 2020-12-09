<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


use App\Translation;


    /**
     * Translate the given message.
     *
     * @param  string|null  $key
     * @param  array   $replace
     * @param  string|null  $locale
     * @return \Illuminate\Contracts\Translation\Translator|string|array|null
     */
    function trans($key = null, $replace = [], $locale = null) {
        $word = $key;
        // prepare key
        $key = strtolower($key);
        $key = str_replace(" ", "_", $key);

        // my code for translation
        try {
            $translation = Translation::where('key', $key)->first();

            if ($translation) {
                $translate = (Lang::getLang() == 'Ar') ? $translation->word_ar : $translation->word_en;

                if ($translate)
                    return $translate;
            } else {
                Translation::create([
                    "key" => $key,
                    "word_en" => $word
                ]);
            }
        } catch (\Exception $exc) {
            //
        }



        return $word;
    }



    if (function_exists('__')) {

        function __($key = null, $replace = [], $locale = null) {
            return trans($key, $replace, $locale);
        }

    }
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