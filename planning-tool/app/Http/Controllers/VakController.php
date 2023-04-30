<?php

namespace App\Http\Controllers;

use App\Models\Vak;
use Illuminate\Http\Request;

class VakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vakken = Vak::all();
        return view('vakken.index')->with('vakken',$vakken);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vakken.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        Vak::create($input);
        return redirect('vak')->with('succes-message','Vak succesvol aangemaakt!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
