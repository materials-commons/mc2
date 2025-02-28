<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer id
 * @property string name
 * @property string local_path
 * @property integer remote_id
 * @property string notes
 * @property mixed last_synced_at
 * @property mixed remote_last_synced_at
 *
 * @mixin Builder
 */
class LocalProject extends Model
{
    /** @use HasFactory<\Database\Factories\LocalProjectFactory> */
    use HasFactory;

    protected $guarded = ['id'];
    protected $casts = [
        'last_synced_at'        => 'datetime',
        'remote_last_synced_at' => 'datetime',
    ];
}
