<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $runnerId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $runner2Id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $runId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $run2Id = \Ramsey\Uuid\Uuid::uuid4()->toString();

        \Illuminate\Support\Facades\DB::table('runners')->insert([
            'id' => $runnerId,
            'email' => 'test_runner@tsh.io',
            'password' => 'some_hashed_password',
        ]);

        \Illuminate\Support\Facades\DB::table('runners')->insert([
            'id' => $runner2Id,
            'email' => 'test_runner2@tsh.io',
            'password' => 'some_hashed_password',
        ]);

        \Illuminate\Support\Facades\DB::table('runs')->insert([
            'id' => $runId,
            'name' => 'Run 1',
            'time_limit' => 3600,
            'start_at' => \DateTime::createFromFormat('Y-m-d h:i:s', '2019-02-23 12:00:00'),
            'type' => \Domain\Model\RunType::TYPE_QUARTER_MARATHON,
            'length' => 10000,
        ]);

        \Illuminate\Support\Facades\DB::table('runs')->insert([
            'id' => $run2Id,
            'name' => 'Run 2',
            'time_limit' => 7200,
            'start_at' => \DateTime::createFromFormat('Y-m-d h:i:s', '2019-04-23 12:00:00'),
            'type' => \Domain\Model\RunType::TYPE_HALF_MARATHON,
            'length' => 21097,
        ]);

        \Illuminate\Support\Facades\DB::table('run_participations')->insert([
            'runner_id' => $runnerId,
            'run_id' => $runId,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('run_participations')->truncate();
        \Illuminate\Support\Facades\DB::table('runners')->truncate();
        \Illuminate\Support\Facades\DB::table('runs')->truncate();
    }
}
