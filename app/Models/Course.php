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
    protected $appends = ['rating', 'subscription_status', 'status_text'];

    public function getStatusTextAttribute(): bool|string
    {
        $user = $this->users()->where('users.id', auth()->id())->first();
        if ($user) {
            $subscription = $user->pivot;
            return $subscription ? $subscription->status : '';
        }

        return false;
    }

    public function getSubscriptionStatusAttribute(): bool|int
    {
        $user = $this->users()->where('users.id', auth()->id())->first();
        if ($user) {
            $subscription = $user->pivot;
            return $subscription && $subscription->status === 'active' ? 1 : 0;
        }

        return false;
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
        return $this->belongsToMany(User::class)->withPivot('status')->orderBy('id');
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }
}
