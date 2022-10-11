<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['subscription_status'];

    public function getSubscriptionStatusAttribute(): bool
    {
        $subscription = $this->users()->where('users.id', auth()->id())->first();
        return (bool)$subscription;
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class)->orderBy('id');
    }
}
