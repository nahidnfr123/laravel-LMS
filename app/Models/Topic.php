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

    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function marks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Mark::class);
    }

    public function clasAttendances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ClasAttendance::class);
    }
}
