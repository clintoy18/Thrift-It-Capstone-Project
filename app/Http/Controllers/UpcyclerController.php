<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Mail\UpcycleBookingApproved;
use App\Mail\UpcycleBookingCompleted;
use Illuminate\Support\Facades\Mail;
class UpcyclerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::where('upcycler_id', Auth::id())
        ->whereIn('appstatus', ['pending', 'approved'])
        ->get();
        
        return view('upcycler.index', compact('appointments'));    
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
        $appointment = Appointment::find($id);
        return view('upcycler.show', compact('appointment'));
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function update(UpdateAppointmentRequest $request, $appointmentid)
        {
            $validated = $request->validated();

            $appointment = Appointment::findOrFail($appointmentid);

            // check authorization
            if ($appointment->upcycler_id !==  Auth::id()) {
                abort(403, 'Unauthorized action.');
            }

            //check previous status
            $previousStatus = $appointment->getOriginal('appstatus'); 

            $appointment->update($validated); 

            // if appstatus is approved send email to user 
            if ($previousStatus !== 'approved' && $appointment->appstatus === 'approved') {
                Mail::to($appointment->user->email)->send(new UpcycleBookingApproved($appointment));
            }

           // if appstatus is completed and ready to pick-up send email to user 
            if ($previousStatus !== 'completed' && $appointment->appstatus === 'completed') {
                Mail::to($appointment->user->email)->send(new UpcycleBookingCompleted($appointment));
            }    
            return redirect()->back()->with('status', 'Appointment status updated.');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment) : RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('upcycler.index');

    }
   


}
