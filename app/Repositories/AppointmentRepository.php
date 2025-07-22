<?php

namespace App\Repositories;

use App\Models\Appointment;

class AppointmentRepository
{
    public function all()
    {
        return Appointment::all();
    }

    public function find($id)
    {
        return Appointment::findOrFail($id);
    }

    public function create(array $data)
    {
        return Appointment::create($data);
    }

    public function update(Appointment $appointment, array $data)
    {
        $appointment->update($data);
        return $appointment;
    }

    public function delete(Appointment $appointment)
    {
        return $appointment->delete();
    }

    public function getByUser($userId)
    {
        return Appointment::with('upcycler')->where('user_id', $userId)->get();
    }
}
