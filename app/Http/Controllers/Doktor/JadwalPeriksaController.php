<?php

namespace App\Http\Controllers\Doktor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkup;
use App\Models\CheckupSchedule;
use Yajra\DataTables\DataTables;

class JadwalPeriksaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // Handle DataTables AJAX request
            $data = CheckupSchedule::where('user_id', auth()->user()->id)->get();
            $data = $data->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'name' => auth()->user()->name,
                    'day' => $schedule->day,
                    'start_time' => $schedule->start_time,
                    'end_time' => $schedule->end_time,
                    'is_active' => $schedule->is_active
                ];
            });
            return DataTables::of($data)->toJson();
        }

        // Handle POST request
        if ($request->isMethod('post')) {
            CheckupSchedule::create([
                'user_id' => auth()->user()->id,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ]);
            return response()->json(['message' => 'Jadwal Berhasil Dibuat']);
        }

        // Handle regular GET request
        return view('doctor.jadwal-periksa');
    }

    public function update(Request $request, $id){
        $data = CheckupSchedule::findOrfail($id);
        $data::update([
            'user_id' => auth()->user()->id,
                'day' => $request->day,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'is_active' => $request->is_active
        ]);
        return response()->json(['message' => 'Jadwal Berhasil terupdate']);

    }
}
