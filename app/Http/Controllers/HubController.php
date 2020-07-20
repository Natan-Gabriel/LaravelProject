<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hub;

class HubController extends Controller
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
        return view('createHub');
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
            'name'=>'required|unique:hubs',
            'code'=>'required|unique:hubs|min:3|max:3',
            'reputation'=>'required|integer|lte:100|gte:0',
            'price'=>'required|integer|gte:0|lte:100000'
        ]);

        $hub = new Hub([
            'name' => $request->get('name'),
            'code' => $request->get('code'),
            'reputation' => $request->get('reputation'),
            'price' => $request->get('price')
        ]);
        $hub->save();
        return redirect('/hubs')->with('success', 'Hub saved!');
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
        $hub = Hub::find($id);
        // dump($hub);
        // print_r($hub->name);
        //return view('createHub');
        return view('editHub', compact('hub'));
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
            'name'=>'required|unique:hubs,name,'. $id,
            'code'=>'required|min:3|max:3|unique:hubs,code,'. $id,
            'reputation'=>'required|integer|lte:100|gte:0',
            'price'=>'required|integer|gte:0|lte:100000'
            
        ]);

        $hub = Hub::find($id);
        $hub->name =  $request->get('name');
        $hub->code = $request->get('code');
        $hub->reputation = $request->get('reputation');
        $hub->price = $request->get('price');
        $hub->save();

        return redirect('/hubs')->with('success', 'Hub updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $hub = Hub::find($id);
        $hub->delete();
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
