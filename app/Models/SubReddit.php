<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubReddit extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'bannerImage',
        'description',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function joinedUsers()
    {
        return $this->belongsToMany(User::class);
    }
}
