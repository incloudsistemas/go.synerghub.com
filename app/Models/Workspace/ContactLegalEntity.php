<?php

namespace App\Models\Workspace;

use App\Casts\DateCast;
use App\Casts\FloatCast;
use App\Enums\Synerg\TaxAssessment;
use App\Enums\Synerg\TaxRegime;
use App\Traits\Workspace\Contactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;

class ContactLegalEntity extends Model implements HasMedia
{
    use HasFactory, Contactable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'trade_name',
        'cnpj',
        'municipal_registration',
        'state_registration',
        'nire',
        'nire_registered_at',
        'share_capital',
        'tax_assessment',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nire_registered_at' => DateCast::class,
        'share_capital'      => FloatCast::class,
    ];


    /**
     * The individuals that belongs to the legal entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function individuals(): BelongsToMany
    {
        return $this->belongsToMany(
            related: ContactIndividual::class,
            table: 'contact_individual_has_legal_entities',
            foreignPivotKey: 'legal_entity_id',
            relatedPivotKey: 'individual_id'
        )
            ->withPivot(columns: 'order');
    }

    /**
     * EVENT LISTENERS.
     *
     */

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Self $legalEntity): void {
            $legalEntity->email = $legalEntity->email . '//deleted_' . md5(uniqid());
            $legalEntity->save();
        });
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

    public function getDisplayNireRegisteredAtAttribute(): ?string
    {
        // return $this->nire_registered_at?->format('d/m/Y');
        return isset($this->nire_registered_at)
            ? ConvertEnToPtBrDate(date: $this->nire_registered_at)
            : null;
    }

    public function getDisplayShareCapitalAttribute(): ?string
    {
        return $this->share_capital ? number_format($this->share_capital, 2, ',', '.') : null;
    }

    public function getDisplayTaxRegimeAttribute(): ?string
    {
        return isset($this->tax_regime)
            ? TaxRegime::getDescription(value: (int) $this->tax_regime)
            : null;
    }
    public function getDisplayTaxAssessmentAttribute(): ?string
    {
        return isset($this->tax_assessment)
            ? TaxAssessment::getDescription(value: (int) $this->tax_assessment)
            : null;
    }
}
