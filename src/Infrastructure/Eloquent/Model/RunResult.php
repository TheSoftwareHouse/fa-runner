<?php

namespace Infrastucture\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Infrastructure\Eloquent\Model\Run;
use Infrastructure\Eloquent\Model\Runner;

class RunResult extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'runner_id',
        'run_id',
        'time',
    ];

    /**
     * @var string
     */
    protected $table = 'run_results';

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

    protected $casts = [
        'time' => 'integer',
    ];

    public function runner()
    {
        return $this->belongsTo(Runner::class);
    }

    public function run()
    {
        return $this->belongsTo(Run::class);
    }
}
