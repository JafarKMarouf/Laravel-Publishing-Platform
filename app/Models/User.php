<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
        'image',
        'bio'
    ];

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
        if ($this->image) {
            return Storage::url($this->image);
        }
        return null;
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
