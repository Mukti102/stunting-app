<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Desa::all();
        return view('pages.desa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama_desa" => "required|unique:desas",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "kode_pos" => "nullable|string|max:10",
        ]);

        try {
            Desa::create($request->all());
            return redirect()->route('desa.index')->with('success', 'Desa created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create desa: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Desa $desa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Desa $desa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            "nama_desa" => "required",
            "kecamatan" => "required",
            "kabupaten" => "required",
            "provinsi" => "required",
            "kode_pos" => "nullable|string|max:10",
        ]);

        try {
            $desa->update($request->all());
            return redirect()->route('desa.index')->with('success', 'Desa updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update desa: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Desa $desa)
    {
        try{
            $desa->delete();
            return redirect()->route('desa.index')->with('success', 'Desa deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete desa: ' . $e->getMessage()]);
        }
    }
}
