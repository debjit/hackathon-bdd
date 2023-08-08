<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
// Type has gov,private, sponsored, I do not know any other things
    protected $fillale = [
        'name',
        'pincode',
        'address',
        'type',
        'notes'
    ];
}
