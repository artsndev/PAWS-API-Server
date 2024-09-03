<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Queue extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'veterinarian_id',
        'pet_id',
        'appointment_id',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $dates = [
        'deleted_at',
    ];

    /**
     *
     * Define the relationship between User and Appointment models.
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     *
     * Define the relationship between User and Appointment models.
     *
     */
    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class,'veterinarian_id');
    }

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
