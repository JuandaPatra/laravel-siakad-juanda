<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = Schedule::with('subject', 'subject.lecturer')->paginate(10);
        // return $schedules;
        return view('pages.schedules.index',['type_menu' => 'schedule'], compact('schedules'));

        $pass = "*&@!";
        $md5 = md5("password");


        $login = $pass + $md5 + $pass;

        


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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    function generateCode(Schedule $schedule) 
    {
        return view('pages.schedules.input-qrcode',['type_menu' => 'schedule'],[
            'schedule' => $schedule
        ]);
    }

    function showQRCode(Schedule $schedule) 
    {
        return view('pages.schedules.show-qrcode',['type_menu' => 'schedule'],[
            'schedule'=> $schedule
        ]);
    }

    function generateQR(Request $request, Schedule $schedule) 
    {
        // return $request;

        $validated = $request->validate([
            'code' => 'required',
        ]);

        if($validated){
           $schedule->update([
            'kode_absensi' => $request->code
           ]);
        }

        return redirect()->route('show-qrcode', $schedule);
        
    }
}
