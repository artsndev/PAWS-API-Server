<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'breed',
        'species',
        'age',
        'sex',
        'color',
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

}
