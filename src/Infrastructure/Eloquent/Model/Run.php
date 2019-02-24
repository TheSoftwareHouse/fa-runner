<?php

namespace Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class Run extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'time_limit',
        'start_at',
        'type',
        'length',
    ];

    /**
     * @var string
     */
    protected $table = 'runs';

    /**
     * @var string
     */
    protected $keyType = 'string';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var bool
     */
    public $incrementing = false;

    protected $dates = [
        'start_at'
    ];

    protected $casts = [
        'time_limit' => 'integer',
        'length' => 'integer',
    ];
}
