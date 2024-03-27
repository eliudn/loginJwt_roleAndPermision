<?php

namespace Src\Application\People\Infrastructure\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class People extends Model
{
    protected $table = 'people';
    protected $fillable = [
        'name',
        'last_name',
        'nit',
        'address',
        'date_of_birth'
    ];
    /**
     * @return BelongsTo
     */
    public function email(): HasMany
    {
        return $this->hasMany(Email::class, 'person_id');
    }

    public function phone():HasMany
    {
        return $this->hasMany(Phone::class, 'person_id');
    }
    /**
     * @param mixed $query
     */
    public function scopeWithAllInfo($query)
    {
        return $query->addSelect([
            'email' => Email::select('email')
                ->whereColumn('person_id', 'people.id')
                ->where('is_primary', true)
                ->limit(1),
            'phone' => Phone::select('phone')
                ->whereColumn('person_id','people.id')
                ->where('is_primary',true)
                ->limit(1),
        ]);
    }
}
