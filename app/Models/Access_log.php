<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Access_log extends Model
{
    public $timestamps = false;  // Desactivar timestamps

    protected $fillable = [
        'user_id',
        'ip_address',
        'success',
        'attempted_at',
        'email_attempted',
        'user_agent',
    ];

    protected $casts = [
        'success' => 'boolean',
        'read' => 'boolean',
        'attempted_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
