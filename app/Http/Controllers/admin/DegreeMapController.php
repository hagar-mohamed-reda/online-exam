<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Auth;
use App\helper\Message;
use App\helper\Helper;
use App\DegreeMap;
use DB;
use DataTables;

class DegreeMapController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view("admin.degreemap.index");
    }

    /**
     * return json data
     */
    public function getData() {
        $query = DegreeMap::query();

        return DataTables::eloquent($query->latest())
                        ->addColumn('action', function(DegreeMap $degreemap) {
                            return view("admin.degreemap.action", compact("degreemap"));
                        }) 
                        ->rawColumns(['action'])
                        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        try {
            $data = $request->all(); 
            $degreemap = DegreeMap::create($data);

            notify(__('add degreemap'), __('add degreemap') . " " . $degreemap->name);
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
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(DegreeMap $degreemap) {
        return $degreemap->getViewBuilder()->loadEditView();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DegreeMap $degreemap) {
        try {
            $degreemap->update($request->all());

            notify(__('edit degreemap'), __('edit degreemap') . " " . $degreemap->name);
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
    public function destroy(DegreeMap $degreemap) {
        try {
            if (!$degreemap->can_delete)
                return Message::error("cant delete this degreemap");

            notify(__('remove degreemap'), __('remove degreemap') . " " . $degreemap->name);
            $degreemap->delete();
            return Message::success(Message::$DONE);
        } catch (\Exception $ex) {
            return Message::error(Message::$ERROR);
        }
    }

}
