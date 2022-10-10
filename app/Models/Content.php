<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function section(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function assignment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Assignment::class);
    }

    public function exam(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Exam::class);
    }

    public function recorded_class(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(RecordedClass::class);
    }

    public function live_class(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(LiveClass::class);
    }

    public function note(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Note::class);
    }

    public function pdf(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Pdf::class);
    }
}
