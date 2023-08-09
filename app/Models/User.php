<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'blood_group',
        'primary_contact',
        'secondary_contact',
        'emergency_contact',
        'donor',
        'last_donated',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date' => 'last_donated',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function requisitions(): BelongsToMany
    {
        return $this->belongsToMany(Requisition::class);
    }

    public function bloodGroup(): HasOne{
        return $this->hasOne(BloodGroup::class,'id','blood_group');
    }
}
