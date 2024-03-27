<?php

namespace Src\Application\People\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Email extends Model
{
    protected $table = 'emails';
    protected $fillable = [
        'person_id',
        'email',
        'is_primary'
    ];
}
