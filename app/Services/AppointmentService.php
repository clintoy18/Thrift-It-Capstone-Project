<?php

namespace App\Services;

use App\Repositories\AppointmentRepository;
use App\Models\Appointment;
use Carbon\Carbon;

class AppointmentService
{
    protected $appointmentRepository;

    public function __construct(AppointmentRepository $appointmentRepository)
    {
        $this->appointmentRepository = $appointmentRepository;
    }

    public function getAllAppointments()
    {
        return $this->appointmentRepository->all();
    }

    public function getAppointmentById($id)
    {
        return $this->appointmentRepository->find($id);
    }

    public function createAppointment(array $data)
    {
        return $this->appointmentRepository->create($data);
    }

    public function updateAppointment(Appointment $appointment, array $data)
    {
        return $this->appointmentRepository->update($appointment, $data);
    }

    public function deleteAppointment(Appointment $appointment)
    {
        return $this->appointmentRepository->delete($appointment);
    }

    public function getAppointmentsByUser($userId)
    {
        return $this->appointmentRepository->getByUser($userId);
    }

    public function cancelAppointment(Appointment $appointment)
    {
        if (in_array($appointment->appstatus, ['cancelled', 'completed', 'declined'])) {
            return ['error' => 'This appointment cannot be cancelled.'];
        }

        $now = Carbon::now(config('app.timezone'));
        $appointmentTime = Carbon::parse($appointment->appdate, config('app.timezone'));

        if ($appointmentTime->isPast()) {
            return ['error' => 'You cannot cancel a past appointment.'];
        }

        if ($now->diffInHours($appointmentTime) < 24) {
            return ['error' => 'You can only cancel appointments more than 24 hours in advance.'];
        }

        // if($appointment->appstatus == 'approved')
        // {
        //     return ['error' => 'You cannot cancel approved appointment.'];

        // }

        $this->appointmentRepository->update($appointment, ['appstatus' => 'cancelled']);
        return ['success' => 'Appointment cancelled successfully!'];
    }
}
