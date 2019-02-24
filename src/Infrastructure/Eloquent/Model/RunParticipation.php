<?php

namespace Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;

class RunParticipation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'runner_id',
        'run_id',
    ];

    /**
     * @var string
     */
    protected $table = 'run_participations';

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

    public function runner()
    {
        return $this->belongsTo(Runner::class);
    }

    public function run()
    {
        return $this->belongsTo(Run::class);
    }
}
