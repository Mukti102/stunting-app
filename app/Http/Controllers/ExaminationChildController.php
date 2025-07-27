<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\ExaminationChild;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExaminationChildController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = ExaminationChild::with('child')->get();
        return view('pages.pemeriksaan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $children = Child::all();
        return view('pages.pemeriksaan.create', compact('children'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'examination_date' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'head_circumference' => 'required',
            'notes' => 'nullable',
            'action' => 'nullable',
        ]);


        $child = Child::findOrFail($request->child_id);

        // Hitung usia dalam bulan
        $ageInMonths =  ceil(\Carbon\Carbon::parse($child->date_born)
            ->diffInMonths(\Carbon\Carbon::parse($request->examination_date)));


        // Ambil referensi WHO
        $ref = DB::table('ref_tb_u')
            ->where('gender', $child->gender)
            ->where('usia_bulan', $ageInMonths)
            ->first();

        if (!$ref) {
            return redirect()->back()->withErrors(['error' => 'Data referensi WHO tidak ditemukan untuk usia ini']);
        }

        // Hitung Z-score (pakai float)
        $zscore_tbu = ((float)$request->height - (float)$ref->median) / (float)$ref->sd;

        // Tentukan status
        if ($zscore_tbu < -3) {
            $status = 'severely_stunting';
        } elseif ($zscore_tbu >= -3 && $zscore_tbu < -2) {
            $status = 'stunting';
        } elseif ($zscore_tbu >= -2 && $zscore_tbu <= 2) {
            $status = 'normal';
        } else {
            $status = 'berisiko';
        }

        // Tambahkan ke data
        $validated['age_months'] = $ageInMonths;
        $validated['zscore_tbu'] = $zscore_tbu;
        $validated['status_stunting'] = $status;


        try {
            ExaminationChild::create($validated);
            return redirect()->route('pemeriksaan.index')->with('success', 'Berhasil Di Periksa');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memeriksa balita: ' . $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(ExaminationChild $examinationChild,$id)
    {
        $child = ExaminationChild::with('child')->find($id);
        return view('pages.pemeriksaan.show',compact('child'));
    }

    public function normal(){
        $data = ExaminationChild::where('status_stunting','normal')->get();
        return view('pages.pemeriksaan.normal',compact('data'));
    }

    public function nonNormal(){
        $data = ExaminationChild::where('status_stunting','!=','normal')->get();
        return view('pages.pemeriksaan.nonnormal',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ExaminationChild $examinationChild, $id)
    {
        $child = ExaminationChild::find($id);
        $children = Child::all();
        return view('pages.pemeriksaan.edit', compact('children', 'child'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ExaminationChild $examinationChild,$id)
    {
        $examinationChild = ExaminationChild::find($id);
        $validated = $request->validate([
            'child_id' => 'required|exists:children,id',
            'examination_date' => 'required',
            'weight' => 'required',
            'height' => 'required',
            'head_circumference' => 'required',
            'notes' => 'nullable',
            'action' => 'nullable',
        ]);


        $child = Child::findOrFail($request->child_id);

        // Hitung usia dalam bulan
        $ageInMonths =  ceil(\Carbon\Carbon::parse($child->date_born)
            ->diffInMonths(\Carbon\Carbon::parse($request->examination_date)));


        // Ambil referensi WHO
        $ref = DB::table('ref_tb_u')
            ->where('gender', $child->gender)
            ->where('usia_bulan', $ageInMonths)
            ->first();

        if (!$ref) {
            return redirect()->back()->withErrors(['error' => 'Data referensi WHO tidak ditemukan untuk usia ini']);
        }

        // Hitung Z-score (pakai float)
        $zscore_tbu = ((float)$request->height - (float)$ref->median) / (float)$ref->sd;

        // Tentukan status
        if ($zscore_tbu < -3) {
            $status = 'severely_stunting';
        } elseif ($zscore_tbu >= -3 && $zscore_tbu < -2) {
            $status = 'stunting';
        } elseif ($zscore_tbu >= -2 && $zscore_tbu <= 2) {
            $status = 'normal';
        } else {
            $status = 'berisiko';
        }

        // Tambahkan ke data
        $validated['age_months'] = $ageInMonths;
        $validated['zscore_tbu'] = $zscore_tbu;
        $validated['status_stunting'] = $status;


        try {
            $examinationChild->update($validated);
            return redirect()->route('pemeriksaan.index')->with('success', 'Berhasil Di Update');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal Update pemeriksaan balita: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExaminationChild $examinationChild,$id)
    {   
        $examinationChild = ExaminationChild::findOrFail($id);
        try{
            $examinationChild->delete();
            return redirect()->route('pemeriksaan.index')->with('success', 'Berhasil Hapus');
        }catch(Exception $e){
            return redirect()->back()->withErrors(['error' => 'Gagal Hapus pemeriksaan balita: ' . $e->getMessage()]);
        }
    }
}
