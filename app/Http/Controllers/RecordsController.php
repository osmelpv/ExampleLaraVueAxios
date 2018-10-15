<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Record;

class RecordsController extends Controller
{
    public function __construct()
    {
      //$this->middleware('auth:api');
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // if($request->ajax()){
            $records = Record::orderBy('id', 'DESC')->paginate(10);
            return [
                'pagination' => [
                    'total' => $records->total(),
                    'current_page' => $records->currentPage(),
                    'perPage' => $records->perPage(),
                    'lastPage' => $records->lastPage(),
                    'from' => $records->firstItem(),
                    'to' => $records->lastItem(),
                ],
                'records' => $records
            ];
       // }
        
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'uuid' => 'required',
            'status' => 'required'
        ]);

        Record::create($request->all());
        return;
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'uuid' => 'required',
            'status' => 'required'
        ]);

        Record::find($id)->update($request->all());
        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Record::findOrFail($id);
        $record->delete();
    }
}
