<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $upcyclers = User::where('role', 1)->get(); // fetch all upcyclers
        return view('appointments.index', compact('upcyclers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $upcyclerId = $request->query('upcycler_id'); 
        $upcycler = null;

        if($upcyclerId){
            $upcycler = User::where('role', 1)->find($upcyclerId); 
        }

        return view('appointments.create', compact('upcycler'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id(); 
        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $upcyclers = User::where('role', 1)->get();
        return view('appointments.edit', compact('appointment', 'upcyclers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        $validated = $request->validated();
        $appointment->update($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }
 

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.myAppointments')->with('success', 'Appointment deleted successfully!');
    }
    
    public function myAppointments()
    {
        $appointments = Appointment::with('upcycler')->where('user_id', Auth::id())->get();
        return view('appointments.myAppointments', compact('appointments'));
    }

    public function cancel(Appointment $appointment)
    {
        if($appointment->appstatus == 'cancelled' || $appointment->appstatus == 'completed' || $appointment->appstatus == 'declined'){
            return redirect()->route('appointments.myAppointments')->withErrors('This appointment cannot be cancelled.');
        }

        $now = Carbon::now();
        $appointmentTime = Carbon::parse($appointment->appdate); // Replace with the actual column name if different
        
        if($appointmentTime->diffInHours($now) < 24){
            return redirect()->route('appointments.myAppointments')->withErrors('You can only cancel appointments more than 24 hours in advance.');
        }
        $appointment->update(['appstatus' => 'cancelled']);
        return redirect()->route('appointments.myAppointments')->with('success', 'Appointment cancelled successfully!');
    }
}
