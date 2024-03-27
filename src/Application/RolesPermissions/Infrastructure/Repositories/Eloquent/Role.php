<?php

namespace Src\Application\RolesPermissions\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Src\Management\Auth\Infrastructure\Repositories\Eloquent\User;

final class Role extends Model
{
    protected $table = 'roles';
    protected $fillable =[
        'rol',
        'description',
        'user_id'
    ];
    /**
     * @return BelongsToMany
     */
    public function user(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_roles',
            'rol_id',
            'user_id'
        );
    }
}
