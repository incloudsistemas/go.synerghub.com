<?php

namespace App\Models\Workspace;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Contact extends Model
{
    use HasFactory;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contactable_type',
        'contactable_id',
        'additional_emails',
        'phones',
        'complement',
        'custom',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'additional_emails' => 'array',
        'phones'            => 'array',
        'custom'            => 'array',
    ];

    /**
     * Get the insider associated with the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function insider(): HasOne
    {
        return $this->hasOne(related: Insider::class);
    }

    /**
     * Get the user associated with the contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(related: User::class);
    }

    /**
     * Get the user's addresses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function addresses(): MorphMany
    {
        return $this->morphMany(related: Address::class, name: 'addressable');
    }

    /**
     * Get all of the owning contactable models.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function contactable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * EVENT LISTENERS.
     *
     */

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

    public function getDisplayMainPhoneAttribute(): ?string
    {
        return $this->phones[0]['number'] ?? null;
    }
}
