<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function content(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Content::class);
    }

    public function mcqs(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Mcq::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function results(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Result::class);
    }
}
