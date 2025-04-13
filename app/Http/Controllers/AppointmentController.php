<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

        $validated['user_id'] = Auth::id(); // Assign the currently logged-in user's ID

        Appointment::create($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('appointments.show', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $upcyclers = User::where('role', 1)->get();
        return view('appointments.edit', compact('appointment', 'upcyclers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            return redirect()->route('appointments.index')->with('error', 'You are not authorized to edit this appointment.');
        }

        $validated = $request->validated();

        $appointment->update($validated);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully!');
    }
}
