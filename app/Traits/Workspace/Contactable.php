<?php

namespace App\Traits\Workspace;

use App\Models\Address;
use App\Models\Workspace\Contact;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait Contactable
{
    use SoftDeletes, InteractsWithMedia;

    /**
     * Get the contactable's contact.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function contact(): MorphOne
    {
        return $this->morphOne(related: Contact::class, name: 'contactable');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 345, 230)
            ->nonQueued();
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

    public function getAvatarAttribute(): ?Media
    {
        $avatar = $this->getMedia('avatar')
            ->first();

        return $avatar ?? null;
    }

    public function getDisplayAvatarAttribute(): string
    {
        return isset($this->featured_image)
            ? $this->featured_image->getUrl()
            : PlaceholderImg(width: 1920, height: 1080);
    }
}
