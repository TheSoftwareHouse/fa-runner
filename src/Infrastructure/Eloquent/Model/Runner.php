<?php

namespace Infrastructure\Eloquent\Model;

use Illuminate\Database\Eloquent\Model;
use Infrastucture\Eloquent\Model\RunResult;

class Runner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * @var string
     */
    protected $table = 'runners';

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

    public function participations()
    {
        return $this->hasMany(RunParticipation::class);
    }

    public function results()
    {
        return $this->hasMany(RunResult::class);
    }
}
