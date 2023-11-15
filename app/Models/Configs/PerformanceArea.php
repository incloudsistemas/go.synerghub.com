<?php

namespace App\Models\Configs;

use App\Models\Workspace\Insider;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PerformanceArea extends Model
{
    use HasFactory, Sluggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * The insider that belongs to the cnae.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function insiders(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Insider::class,
            table: 'insider_has_performance_areas',
            foreignPivotKey: 'performance_area_id',
            relatedPivotKey: 'insider_id'
        );
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
