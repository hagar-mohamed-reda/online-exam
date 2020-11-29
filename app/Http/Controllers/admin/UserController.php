<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

use App\helper\Message;
use App\helper\Helper;
use App\User; 
use DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.user.index");
    }

    /**
     * return json data
     */
    public function getData() {
        return DataTables::eloquent(User::query())
                        ->addColumn('action', function(User $user) {
                            return view("admin.user.action", compact("user"));
                        })    
                        ->editColumn('department_id', function(User $user) { 
                            return optional($user->department)->name;
                        })  
                        ->editColumn('active', function(User $user) {
                            $label = $user->active == 1? 'success' : 'danger';
                            $text = $user->active == 1? __('on') : __('off');
                            
                            return "<span class='label label-$label' >$text</span>";
                        })  
                        ->editColumn('is_paid', function(User $user) {
                            $label = $user->is_paid == 1? 'success' : 'danger';
                            $text = $user->is_paid == 1? __('on') : __('off');
                            
                            return "<span class='label label-$label' >$text</span>";
                        })  
                        ->rawColumns(['action', 'active', 'is_paid'])
                        ->toJson();
    } 
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            $user = User::create($request->all());  
            
            // upload user photo
            Helper::uploadImg($request->file("photo"), "/user", function($filename) use ($user){
                $user->update([
                    "photo" => $filename
                ]);
            });
            
            notify(__('add user'), __('add user') . " " . $user->name);
            return Message::success(Message::$DONE);
        } catch (Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
    
    /**
     * import users from excel file
     * 
     * @param Request $request
     * @return type
     */
    public function import(Request $request) { 
        return Message::success(Message::$DONE);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        return $user->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    { 
        try {   
            $user->update($request->all()); 
            
            // upload user photo
            Helper::uploadImg($request->file("photo"), "/user", function($filename) use ($user){
                $user->update([
                    "photo" => $filename
                ]);
            });
            notify(__('edit user'), __('edit user') . " " . $user->name);
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
    public function destroy(User $user)
    { 
        try { 
            notify(__('remove user'), __('remove user') . " " . $user->name);
            $user->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }
}
