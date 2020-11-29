<?php

namespace App\Http\Controllers\doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
 
use App\helper\Message;
use App\helper\Helper;
use App\Question; 
use App\QuestionChoice; 
use DB;
use DataTables;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("doctor.question.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = Question::where("user_id", Auth::user()->id);
        
        return DataTables::eloquent($query)
                        ->addColumn('action', function(Question $question) {
                            return view("doctor.question.action", compact("question"));
                        })->editColumn('course_id', function(Question $question) {
                            return optional($question->course)->name;
                        })->editColumn('question_type_id', function(Question $question) {
                            return __(optional($question->questionType)->name);
                        })->editColumn('text', function(Question $question) {
                            return substr($question->text, 0, 100) . "..";
                        }) 
                        ->editColumn('active', function(Question $question) {
                            $label = $question->active == 1? 'success' : 'danger';
                            $text = $question->active == 1? __('on') : __('off');
                            
                            return "<span class='label label-$label' >$text</span>";
                        }) 
                        ->editColumn('is_sharied', function(Question $question) {
                            $label = $question->is_sharied == 1? 'success' : 'danger';
                            $text = $question->is_sharied == 1? __('on') : __('off');
                            
                            return "<span class='label label-$label' >$text</span>";
                        }) 
                        ->rawColumns(['action', 'active', 'is_sharied'])
                        ->toJson();
    } 
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view("doctor.question.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $data["user_id"] = Auth::user()->id;
             
            $question = Question::create($data); 
            
            for($index = 0; $index < count($request->choice); $index ++) {
                QuestionChoice::create([
                    "question_id" => $question->id, 
                    "text" => $request->choice[$index], 
                    "is_answer" => $request->is_answer[$index] 
                ]);
            }
            
            
            notify(__('add question'), __('add question') . " " . $question->name); 
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        return view("doctor.question.show", compact("question"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    { 
        return $question->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    { 
        try {
            $question->update($request->all()); 
            
            notify(__('edit question'), __('edit question') . " " . $question->name);
            return Message::success(Message::$EDIT);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    { 
        try { 
            notify(__('remove question'), __('remove question') . " " . $question->name);
            $question->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
