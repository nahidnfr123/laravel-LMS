<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function semester(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function clas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Clas::class);
    }

    public function users(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class);
    }

    public function mark(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Mark::class);
    }
}
