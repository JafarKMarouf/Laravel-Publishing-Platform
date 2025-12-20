<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class User extends Authenticatable implements HasMedia
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'bio'
    ];

    /**
     * @param Media|null $media
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('avatar')
            ->width(128)
            ->crop(128, 128);
    }

    /**
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('users')
            ->singleFile();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return string|null
     */
    public function imageUrl(): ?string
    {
        $media = $this->getFirstMedia('users');
        if ($media->hasGeneratedConversion('avatar')) {
            return $media->getUrl('avatar');
        }
        return $media->getUrl();
    }

    /**
     * @return User|HasMany
     */
    public function posts(): User|HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'follower_id',
            'user_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'followers',
            'user_id',
            'follower_id'
        );
    }

    /**
     * @param Post $post
     * @return bool
     */
    public function hasClap(Post $post): bool
    {
        return $post->claps()->where('user_id', $this->id)->exists();
    }

    /**
     * @param $id
     * @return bool
     */
    public function isFollowedBy($id): bool
    {
        return $this->followers()
            ->where('user_id', $id)
            ->exists();
    }
}
