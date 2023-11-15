<?php

namespace App\Models\Configs;

use App\Models\Workspace\Insider;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cnae extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'name',
        'slug',
    ];

    /**
     * The insider that belongs to the cnae.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function secondaryInsiders(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Insider::class,
            table: 'insider_has_secondary_cnaes',
            foreignPivotKey: 'cnae_id',
            relatedPivotKey: 'insider_id'
        );
    }

    /**
     * The insiders that belong to the economic category.
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
}
