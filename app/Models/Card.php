<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    /** @use HasFactory<\Database\Factories\CardFactory> */
    use HasFactory;
    use SoftDeletes;

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
