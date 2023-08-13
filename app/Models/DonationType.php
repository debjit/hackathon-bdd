<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DonationType extends Model
{
    use HasFactory;

    public function requisitions(): HasMany
    {
        return $this->hasMany(Requisition::class, 'id', 'donation_type');
    }
}
