<?php

namespace App\Models\Workspace;

use App\Enums\UserStatus;
use App\Models\Configs\Cnae;
use App\Models\Configs\EconomicCategory;
use App\Models\Configs\LegalNature;
use App\Models\Configs\PerformanceArea;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Insider extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contact_id',
        'legal_nature_id',
        'economic_category_id',
        'cnae_id',
        'name',
        'email',
        'status',
    ];

    /**
     * The performance areas that belongs to the insider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function performanceAreas(): BelongsToMany
    {
        return $this->belongsToMany(
            related: PerformanceArea::class,
            table: 'insider_has_performance_areas',
            foreignPivotKey: 'insider_id',
            relatedPivotKey: 'performance_area_id'
        );
    }

    /**
     * The sec cnaes that belongs to the insider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function secondaryCnaes(): BelongsToMany
    {
        return $this->belongsToMany(
            related: Cnae::class,
            table: 'insider_has_secondary_cnaes',
            foreignPivotKey: 'insider_id',
            relatedPivotKey: 'cnae_id'
        );
    }

    /**
     * Get the legal nature that owns the insider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cnae(): BelongsTo
    {
        return $this->belongsTo(related: Cnae::class);
    }

    /**
     * Get the legal nature that owns the insider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function economicCategory(): BelongsTo
    {
        return $this->belongsTo(related: EconomicCategory::class);
    }

    /**
     * Get the legal nature that owns the insider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function legalNature(): BelongsTo
    {
        return $this->belongsTo(related: LegalNature::class);
    }

    /**
     * Get the contact that owns the insider.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contact(): BelongsTo
    {
        return $this->belongsTo(related: Contact::class);
    }

    /**
     * SCOPES.
     *
     */

    public function scopeByStatuses(Builder $query, array $statuses = [1,]): Builder
    {
        return $query->whereIn('status', $statuses);
    }

    /**
     * MUTATORS.
     *
     */

    /**
     * CUSTOMS.
     *
     */

    public function getDisplayStatusAttribute(): string
    {
        return UserStatus::getDescription(value: (int) $this->status);
    }

    public function getDisplayStatusColorAttribute(): string
    {
        return UserStatus::getColorByValue(status: (int) $this->status);
    }
}
