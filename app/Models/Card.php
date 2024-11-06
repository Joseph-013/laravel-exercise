<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;
    use SoftDeletes;

    protected static function booted()
    {
        parent::boot();

        static::forceDeleted(function ($card) {
            if ($card->profile_picture !== 'default.jpeg')
                Storage::disk('public')->delete($card->profile_picture);
        });
    }

    protected $fillable = [
        'user_id',
        'profile_picture',
        'first_name',
        'last_name',
        'title',
        'id_code',
        'contact',
        'blood_type',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
