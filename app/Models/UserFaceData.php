<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFaceData extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'photo',
        'model',
    ];


    public function api_user()
    {
        return $this->belongsTo(ApiUser::class, 'user_id', 'id');
    }
}
