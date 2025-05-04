<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RedirectResponse;
class UpcyclerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::where('upcycler_id', Auth::id())
        ->where('appstatus', 'pending')
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

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Appointment $appointment)
    // {
    //     $request->validate([
    //         'appstatus' => 'required|in:pending,approved,declined,completed',
    //     ]);
        
    //     $appointment->update([
    //         'appstatus' => $request->appstatus,
    //     ]);
    
    //     return redirect()->route('upcycler.show', $appointment)->with('status', 'Appointment status updated.');
    // }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment) : RedirectResponse
    {
        $appointment->delete();
        return redirect()->route('upcycler.index');

    }
   


}
