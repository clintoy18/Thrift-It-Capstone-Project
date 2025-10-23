<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DonationImage extends Model
{
    use HasFactory;

    protected $table = 'donation_images';

    protected $fillable = ['donation_id', 'image'];

    public function donation()
    {
        return $this->belongsTo(Donation::class);
    }
}
