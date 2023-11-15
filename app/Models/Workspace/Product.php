<?php

namespace App\Models\Workspace;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'module',
        'name',
        'abbreviattion',
        'description'
    ];

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
        $avatar = $this->getFirstMedia('avatar');

        return $avatar ?? null;
    }

    public function getDisplayAvatarAttribute(): string
    {
        return isset($this->featured_image)
            ? $this->featured_image->getUrl()
            : PlaceholderImg(width: 1920, height: 1080);
    }
}
