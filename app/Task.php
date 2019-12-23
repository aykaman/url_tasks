<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UrlTask
 * @package App
 *
 * @property int id,
 * @property string url,
 * @property string local_path,
 * @property string status,
 * @property int created_at,
 * @property int updated_at,
 */
class Task extends Model
{
    const STATUS_PENDING = 'pending';

    const STATUS_DOWNLOADING = 'downloading';

    const STATUS_COMPLETE = 'complete';

    const STATUS_ERROR = 'error';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'url',
        'local_path',
        'status',
        'created_at',
        'updated_at',
    ];
}
