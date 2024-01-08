<?php

namespace App\Http\Controllers\Doktor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Models\PoliRegistrant;

class PeriksaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user()->userDoctorPivots;
        // Get poli_id values from each UserDoctorPivot instance
        $poliIds = $user->map(function ($pivot) {
            return $pivot->poli_id;
        });

        // If you want to get an array of unique poli_id values
        $uniquePoliIds = $poliIds->unique()->values();

        $patientdata = PoliRegistrant::with('patient')->with('checkupSchedule')->with('checkups')->get();
        $patientdata = $patientdata->map(function ($poliRegistrant) {
            return [
                'id' => $poliRegistrant->id,
                'patient_name' => $poliRegistrant->patient->name,
                'queue_number' => $poliRegistrant->queue_number,
                'complaints' => $poliRegistrant->complaints,
            ];
        });
        // dd($patientdata);
        if ($request->ajax()) {
            return DataTables::of($patientdata)->toJson();
        }

        $poli_id = $uniquePoliIds[0];
        return view('doctor.periksa');
    }
}
