<?php

namespace App\Http\Controllers;

use App\Models\Checkup;
use App\Models\CheckupDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\PoliRegistrant;
use App\Models\User;
use App\Models\CheckupSchedule;
use App\Models\Medicine;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    public function index()
    {
        $doctors = User::where('roles', 'doctor')->get();
        // dd($doctors);
        return view('user', compact('doctors'));
    }

    public function getSchedule(Request $request)
    {
        $data = CheckupSchedule::where('user_id', $request->id)->get();
        $data = $data->map(function ($schedule) {
            return [
                'id' => "{$schedule->id}",
                'schedule' => "{$schedule->day}, {$schedule->start_time} - {$schedule->end_time}",
            ];
        });
        return response()->json($data);
    }
    public function getMedicine()
    {
        $data = Medicine::all();
        return response()->json($data);
    }
    public function registerCheckup(Request $request)
    {
        $patient = Session::get('patientData');
        $poliRegistrantWithMaxQueue = PoliRegistrant::all()->max('queue_number');
        $queue_number = $poliRegistrantWithMaxQueue + 1;
        PoliRegistrant::create([
            'patient_id' => $patient->id,
            'checkup_schedule_id' => $request->schedule,
            'complaints' => $request->complaint,
            'queue_number' => $queue_number
        ]);
        return back()->with('success', 'anda telah terdaftar');
    }

    public function finishCheckup(Request $request, $id){
        $cost = 150000;
        foreach($request->medicines as $medicine){
            $data =  Medicine::where('id', $medicine)->first();
            $cost = $cost + $data->price;
        }
        DB::beginTransaction();
        $checkup = Checkup::create([
            'checkup_register_id' => $id,
            'checkup_date' => Carbon::now(),
            'details' => $request->notes,
            'cost' => $cost
        ]);

        foreach($request->medicines as $medicine){
            CheckupDetail::create([
                'checkup_id' => $checkup->id,
                'medicine_id' => $medicine
            ]);
        }
        DB::commit();
        return back()->with('success', 'Data Tersimpan');
    }
}
