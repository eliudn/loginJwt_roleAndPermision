<?php

namespace Src\Management\Auth\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

class UserAccessToken extends Model
{
    protected $table = 'user_access_token';
    protected $fillable = [
        'user_id',
        'token',
        'invalid_token_at',
        'location'
    ];
}
