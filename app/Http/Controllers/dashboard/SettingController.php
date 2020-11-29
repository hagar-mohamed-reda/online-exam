<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\helper\Message;
use App\Translation;

class SettingController extends Controller
{

    /**
     * return view
     */
    public function index() {
        return view("dashboard.options.index");
    }

    /**
     * update any option
     */
    public function update(Request $request) {
        try {
            if ($request->id == 7)
                session(["locale" => $request->value]);
            
            $option = Setting::find($request->id);
            $option->value = $request->value;
            $option->update();

            notify(__('edit setting'), __('edit setting') . " " . $option->created_at);
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * edit the translation of Arabic and English
     * 
     * @param Request $request
     */
    public function updateTranslation(Request $request) {
        $translations = json_decode($request->translations);

        foreach ($translations as $item) {
            $translation = Translation::find($item->id);

            if ($translation)
                $translation->update([
                    "word_en" => $item->word_en,
                    "word_ar" => $item->word_ar,
                ]);
        }


        return Message::success(Message::$DONE);
    }
}
