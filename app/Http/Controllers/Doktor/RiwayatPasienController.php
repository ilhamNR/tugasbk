<?php

namespace App\Http\Controllers\Doktor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\CheckupDetail;
use App\Models\Medicine;
use Yajra\DataTables\DataTables;

class RiwayatPasienController extends Controller
{
    public function index(Request $request, $id)
    {
        $data = Checkup::whereHas('poliRegistrant', function ($query) use ($id) {
            $query->where('patient_id', $id);
        })->get();
        if ($request->ajax()){
            return DataTables::of($data)->toJson();
        }

        // Rest of your code...
    }

}
