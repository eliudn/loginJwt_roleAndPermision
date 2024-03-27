<?php

namespace Src\Application\RolesPermissions\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Management\Auth\Infrastructure\Repositories\Eloquent\User;

final class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable = [
        'permission',
        'description',
        'user_id'
    ];
    public function user():BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_permissions',
            'permission_id',
            'user_id'
        );
    }
}
