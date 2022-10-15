<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = ['rating', 'subscription_status'];

    public function getSubscriptionStatusAttribute(): bool
    {
        $subscription = $this->users()->where('users.id', auth()->id())->first();
        return (bool)$subscription;
    }

    public function getRatingAttribute(): float
    {
        return round($this->reviews()->average('rating') ?? 0, 2);
    }

    public function sections(): HasMany
    {
        return $this->hasMany(Section::class)->orderBy('id');
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class)->orderBy('id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
