<?php

namespace Src\Management\Auth\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Src\Application\People\Infrastructure\Repositories\Eloquent\People;
use Src\Application\RolesPermissions\Domain\Permission;
use Src\Application\RolesPermissions\Domain\Role;

final class User extends Model
{
    protected $table = "users";
    protected $fillable = [
        'username',
        'person_id',
        'password',
    ];

    protected $hidden =["password"];

    /**
     * @return HasOne
     */
    public function people(): HasOne
    {
        return $this->hasOne(People::class, 'id');
    }
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'user_roles',
            'user_id',
            'rol_id',
        );
    }
    public function permission(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'user_permissions',
            'user_id',
            'permission_id'
        );
    }
}
