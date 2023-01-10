<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $table = "patients";
    protected $fillable = [
        'doctor_id',
        'patient_name',
        'patient_email',
        'patient_code',
        'status'
    ];
}
