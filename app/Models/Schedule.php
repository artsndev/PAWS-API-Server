<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'doctor_id',
        'schedule_time',
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
     * Define the relationship between Doctor and Schedule models.
     *
     */
    public function veterinarian()
    {
        return $this->belongsTo(Veterinarian::class,'veterinarian_id');
    }

    /**
     *
     * Define the relationship between Doctor and Schedule models.
     *
     */
    public function appointment()
    {
        return $this->belongsTo(Appointment::class,'schedule_id');
    }
}
