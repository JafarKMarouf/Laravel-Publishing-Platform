<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'content',
        'slug',
        'published_at'
    ];

    /**
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->width(300)
            ->nonQueued();
        $this->addMediaConversion('large')
            ->width(1200)
            ->nonQueued();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return HasMany
     */
    public function claps(): hasMany
    {
        return $this->hasMany(Clap::class);
    }


    /**
     * @param bool $preview
     * @return string|null
     */
    public function imageUrl(bool $preview = false): ?string
    {
        $media = $this->getFirstMedia('posts');
        if ($media->hasGeneratedConversion($preview ? 'large' : 'preview')) {
            return $media->getUrl($preview ? 'large' : 'preview');
        }
        return $media->getUrl();
    }

    /**
     * @param int $wordsInMinutes
     * @return int
     */
    public function readTime(int $wordsInMinutes = 100): int
    {
        $countWords = str_word_count(strip_tags($this->content));
        return max(1, ceil($countWords / $wordsInMinutes));
    }
}
