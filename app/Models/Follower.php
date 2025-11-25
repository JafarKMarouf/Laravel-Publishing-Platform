<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follower extends Model
{
    protected $fillable = [
        'user_id',
        'follower_id',
        'created_at',
    ];
    public const UPDATED_AT = null;

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('users');
    }

    /**
     * @return BelongsTo
     */
    public function follower(): BelongsTo
    {
        return $this->belongsTo('followers');
    }
}
