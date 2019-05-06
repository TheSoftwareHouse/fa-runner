<?php

declare(strict_types = 1);

namespace Infrastructure\Doctrine\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20190507233422 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $runnerId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $runner2Id = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $runId = \Ramsey\Uuid\Uuid::uuid4()->toString();
        $run2Id = \Ramsey\Uuid\Uuid::uuid4()->toString();

        $this->addSql("INSERT INTO runners (id, email, password) VALUES('$runnerId', 'test_runner@tsh.io', 'some_hashed_password')");
        $this->addSql("INSERT INTO runners (id, email, password) VALUES('$runner2Id', 'test_runner2@tsh.io', 'some_hashed_password')");
        $this->addSql("INSERT INTO runs (id, name, time_limit, start_at, type, length) VALUES
            ('$runId', 'Run 1', 3600, '2019-02-23 12:00:00', '".\Domain\Model\RunType::TYPE_QUARTER_MARATHON."', 10000)");
        $this->addSql("INSERT INTO runs (id, name, time_limit, start_at, type, length) VALUES
            ('$run2Id', 'Run 1', 7200, '2019-04-23 12:00:00', '".\Domain\Model\RunType::TYPE_HALF_MARATHON."', 21097)");
        $this->addSql("INSERT INTO run_participations (runner_id, run_id) VALUES('$runnerId', '$runId')");
    }

    public function down(Schema $schema): void
    {
        $this->addSql("TRUNCATE run_participations");
        $this->addSql("TRUNCATE runners");
        $this->addSql("TRUNCATE runs");
    }
}
