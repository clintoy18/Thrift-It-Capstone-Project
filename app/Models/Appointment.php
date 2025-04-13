<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $primarykey = 'appointmentid';
    
    protected $fillable = [
        'user_id',
        'upcycler_id',
        'appdetails',
        'apptype',
        'appstatus',
        'appdate',
    ];

    //relationship with user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    //relationship with the upcycler
    public function upcycler()
    {
        return $this->belongsTo(User::class, 'upcycler_id');
    }
}
