<?php

namespace App\Models\Configs;

use App\Enums\Synerg\LegalNatureRole;
use App\Models\Workspace\Insider;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LegalNature extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'role',
        'name',
        'slug',
    ];

    /**
     * The insiders that belong to the legal nature.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function insiders(): HasMany
    {
        return $this->hasMany(related: Insider::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source'         => 'name',
                'unique'         => true,
                'includeTrashed' => true,
            ],
        ];
    }

    /**
     * SCOPES.
     *
     */

    /**
     * MUTATORS.
     *
     */

    /**
     * CUSTOMS.
     *
     */

    public function getDisplayRoleAttribute()
    {
        return isset($this->role) ? LegalNatureRole::getDescription(value: (int) $this->role) : null;
    }
}
