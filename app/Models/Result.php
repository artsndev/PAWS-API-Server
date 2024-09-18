<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'veterinarian_id',
        'appointment_id',
        'physical_exam',
        'treatment_plan',
    ];

    /**
     *
     * Define the relationship between User and Appointment models.
     *
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'appointment_id');
    }
}
