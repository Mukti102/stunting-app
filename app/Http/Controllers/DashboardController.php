<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Desa;
use App\Models\ExaminationChild;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $desa = Desa::count();
        $totalChildren = Child::count();

        $normalExamination = ExaminationChild::where('status_stunting', 'normal')->count();
        $nonNormalExamination = ExaminationChild::where('status_stunting', '!=', 'normal')->count();

        $normalPercentage = $totalChildren > 0 ? ($normalExamination / $totalChildren) * 100 : 0;
        $nonNormalPercentage = $totalChildren > 0 ? ($nonNormalExamination / $totalChildren) * 100 : 0;

        return view('pages.dashboard', compact(
            'desa',
            'totalChildren',
            'normalExamination',
            'nonNormalExamination',
            'normalPercentage',
            'nonNormalPercentage'
        ));
    }
}
