<?php

namespace Src\Application\People\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;

final class Phone extends Model
{
    protected $table = "phones";
    protected $fillable = [
        'person_id',
        'phone',
        'is_primary'
    ];
}
