<?php

namespace App\Http\Controllers;

use App\Models\Vak;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;



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
        $validator = Validator::make($request->all(), [
            'naam' => [
                'required',
                Rule::unique('vakken', 'naam'),
            ],
            'opleiding' => 'required',
            'semester' => 'required|integer|min:1|max:2',
            'duur' => 'required',
            'sessies' => 'required|integer',
        ], [
            'naam.unique' => 'De naam van het vak bestaat al!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error-message', $validator->errors()->first());
        }

        $input = $request->all();
        Vak::create($input);
        return redirect('vak')->with('success-message','Vak succesvol aangemaakt!');
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
        $vak = Vak::find($id);
        return view('vakken.edit')->with('vakken',$vak);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vak = Vak::find($id);

        $validator = Validator::make($request->all(), [
            'naam' => [
                'required',
                Rule::unique('vakken', 'naam')->ignore($id),
            ],
            'opleiding' => 'required',
            'semester' => 'required|integer|min:1|max:2',
            'duur' => 'required',
            'sessies' => 'required|integer',
        ], [
            'naam.unique' => 'De naam van het vak bestaat al!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error-message', $validator->errors()->first());
        }

        $input = $request->all();
        $vak->update($input);
        return redirect('vak')->with('success-message','Vak succesvol bewerkt!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vak = Vak::findOrFail($id);
        $vak->delete();
        return redirect('vak')->with('success-message','Vak succesvol verwijderd!');
    }



}
