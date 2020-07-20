<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aircraft;

class AircraftController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createAircraft');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:aircrafts',
            'hub_id'=>'required|integer|exists:hubs,id'
        ]);

        $aircraft = new Aircraft([
            'name' => $request->get('name'),
            'hub_id' => $request->get('hub_id')
        ]);
        $aircraft->save();
        return redirect('/aircrafts')->with('success', 'Aircraft saved!');
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
    public function edit($id)
    {
        $aircraft = Aircraft::find($id);
        // dump($hub);
        // print_r($hub->name);
        //return view('createHub');
        return view('editAircraft', compact('aircraft'));

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
        $request->validate([
            'name'=>'required|unique:aircrafts,name,'. $id,
            'hub_id'=>'required|integer|exists:hubs,id'
        ]);

        $aircraft = Aircraft::find($id);
        $aircraft->name =  $request->get('name');
        $aircraft->hub_id = $request->get('hub_id');
        $aircraft->save();

        return redirect('/aircrafts')->with('success', 'Aircraft updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aircraft = Aircraft::find($id);
        $aircraft->delete();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
