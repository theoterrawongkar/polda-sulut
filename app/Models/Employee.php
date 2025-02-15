<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /** @use HasFactory<\Database\Factories\EmployeeFactory> */
    use HasFactory;

    protected $fillable = [
        'nrp',
        'name',
        'gender',
        'position',
        'date_of_birth',
        'address',
        'phone',
        'picture',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'date_of_birth' => 'date',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
