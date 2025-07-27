<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Desa;
use Exception;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Child::with('desa')->get();
        return view('pages.balita.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desa = Desa::all();
        return view('pages.balita.create', compact('desa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nik' => 'required|digits:16|unique:children,nik',
            'no_kk' => 'required|digits:16',
            'name' => 'required|string|max:100',
            'gender' => 'required|in:laki-laki,perempuan',
            'date_born' => 'required|date',
            'mother_name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'parent_phone' => 'required|string|max:15',
            'address' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
        ]);

        try {
            // Simpan data balita ke database
            Child::create($validated);
            // Redirect dengan pesan sukses
            return redirect()->route('balita.index')->with('success', 'Data balita berhasil ditambahkan.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to create balita: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Child $child, $id)
    {
        $child = Child::with('desa')->findOrFail($id);
        return view('pages.balita.show', compact('child'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Child $child, $id)
    {
        $child = Child::findOrFail($id);
        $desa = Desa::all();
        return view('pages.balita.edit', compact('child', 'desa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Child $child,$id)
    {   
        $child = Child::findOrFail($id);
        $validated = $request->validate([
            'nik' => 'required|digits:16',
            'no_kk' => 'required|digits:16',
            'name' => 'required|string|max:100',
            'gender' => 'required|in:laki-laki,perempuan',
            'date_born' => 'required|date',
            'mother_name' => 'required|string|max:100',
            'father_name' => 'required|string|max:100',
            'parent_phone' => 'required|string|max:15',
            'address' => 'required|string',
            'desa_id' => 'required|exists:desas,id',
        ]);

        try {
            // Simpan data balita ke database
            $child->update($validated);
            // Redirect dengan pesan sukses
            return redirect()->route('balita.index')->with('success', 'Data balita berhasil diperbarui.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to update balita: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Child $child,$id)
    {
        $child = Child::findOrFail($id);
        try {
            $child->delete();
            return redirect()->route('balita.index')->with('success', 'Data balita berhasil dihapus.');
        } catch (Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Failed to delete balita: ' . $e->getMessage()]);
        }
    }
}
