<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable=[
        'email',
        'user_id',
        'hospital_id',
        'patient_name',
        'primary_contact',
        'secondary_contact',
        'emergency_contact',
        'blood_group',
        'donation_type',
        'unit',
        'required_on',
        'status',
        'image',
        'urgent',
        'notes'
    ];
}
