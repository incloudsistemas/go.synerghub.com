<?php

namespace App\Models\Workspace;

use App\Casts\DateCast;
use App\Enums\ProfileInfos\EducationalLevel;
use App\Enums\ProfileInfos\Gender;
use App\Enums\ProfileInfos\MaritalStatus;
use App\Traits\Workspace\Contactable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;

class ContactIndividual extends Model implements HasMedia
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
        'cpf',
        'rg',
        'gender',
        'birth_date',
        'marital_status',
        'educational_level',
        'nationality',
        'citizenship',
        'occupation',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'birth_date' => DateCast::class
    ];

    /**
     * The legal entities that belongs to the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function legalEntities(): BelongsToMany
    {
        return $this->belongsToMany(
            related: ContactLegalEntity::class,
            table: 'contact_individual_has_legal_entities',
            foreignPivotKey: 'individual_id',
            relatedPivotKey: 'legal_entity_id'
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

        static::deleting(function (Self $individual): void {
            $individual->email = $individual->email . '//deleted_' . md5(uniqid());
            $individual->save();
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

    public function getDisplayGenderAttribute(): ?string
    {
        return isset($this->gender)
            ? Gender::getDescription(value: $this->gender)
            : null;
    }

    public function getDisplayBirthDateAttribute(): ?string
    {
        // return $this->birth_date?->format('d/m/Y');
        return isset($this->birth_date)
            ? ConvertEnToPtBrDate(date: $this->birth_date)
            : null;
    }

    public function getDisplayMaritalStatusAttribute(): ?string
    {
        return isset($this->marital_status)
            ? MaritalStatus::getDescription(value: (int) $this->marital_status)
            : null;
    }

    public function getDisplayEducationalLevelAttribute(): ?string
    {
        return isset($this->educational_level)
            ? EducationalLevel::getDescription(value: (int) $this->educational_level)
            : null;
    }
}
