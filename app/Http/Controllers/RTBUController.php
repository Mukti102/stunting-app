<?php

namespace App\Http\Controllers;

use App\Models\RTBU;
use Exception;
use Illuminate\Http\Request;

class RTBUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RTBU::all();
        return view('pages.rtbu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RTBU $rTBU)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RTBU $rTBU) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RTBU $rTBU,$id)
    {   
        $rTBU = RTBU::findOrFail($id);
        $validated = $request->validate([
            'gender' => 'required|in:laki-laki,perempuan',
            'usia_bulan' => 'required',
            'median' => 'required|numeric',
            'sd' => 'required|numeric'
        ]);

        try{
            $rTBU->update($validated);
            return back()->with('success',"Berhasil Di Update");
        }catch(Exception $e){
            return back()->withErrors(['error' => 'failed to Update' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RTBU $rTBU,$id)
    {   
        $rTBU = RTBU::findOrFail($id);

        try{
            $rTBU->delete();
            return back()->with('success','Berhasil Di Hapus');
        }catch(Exception $e){
            return back()->withErrors(['error' => 'failed To Delete' . $e->getMessage()]);
        }
    }
}
