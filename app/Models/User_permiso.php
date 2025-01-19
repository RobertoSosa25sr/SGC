<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_permiso extends Model
{
    protected $fillable = [
        'user_id',
        'permiso_id',
        'active'
    ];

    /**
     * Get the user that owns the permission.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the permiso associated with this record.
     */
    public function permiso(): BelongsTo
    {
        return $this->belongsTo(Permiso::class);
    }
}
