<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function communityPosts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(CommunityPost::class);
    }
}
