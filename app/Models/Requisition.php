<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Requisition extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'creator_id',
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
        'notes',
    ];

    protected $casts = [
        'status' => 'boolean',
        'urgent' => 'boolean',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function hospital(): BelongsTo
    {
        return $this->belongsTo(Hospital::class);
    }

    public function required_blood_group(): HasOne
    {
        return $this->hasOne(BloodGroup::class, 'id', 'blood_group');
    }

    public function type(): BelongsTo
    {
        return $this->BelongsTo(DonationType::class, 'donation_type', 'id');
    }
}
