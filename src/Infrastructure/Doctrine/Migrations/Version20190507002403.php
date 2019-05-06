<?php

declare(strict_types=1);

namespace Infrastructure\Doctrine\DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190507002403 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE runs (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', name VARCHAR(255) NOT NULL, time_limit INT NOT NULL, start_at DATETIME NOT NULL, type VARCHAR(255) NOT NULL, length INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE runners (id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', email VARCHAR(255) NOT NULL, password VARCHAR(120) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE run_participations (run_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', runner_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', INDEX IDX_D412F1D584E3FEC4 (run_id), INDEX IDX_D412F1D53C7FB593 (runner_id), PRIMARY KEY(run_id, runner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE run_results (run_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', runner_id CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', time INT NOT NULL, INDEX IDX_C7C1943484E3FEC4 (run_id), INDEX IDX_C7C194343C7FB593 (runner_id), PRIMARY KEY(run_id, runner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE run_participations ADD CONSTRAINT FK_D412F1D584E3FEC4 FOREIGN KEY (run_id) REFERENCES runs (id)');
        $this->addSql('ALTER TABLE run_participations ADD CONSTRAINT FK_D412F1D53C7FB593 FOREIGN KEY (runner_id) REFERENCES runners (id)');
        $this->addSql('ALTER TABLE run_results ADD CONSTRAINT FK_C7C1943484E3FEC4 FOREIGN KEY (run_id) REFERENCES runs (id)');
        $this->addSql('ALTER TABLE run_results ADD CONSTRAINT FK_C7C194343C7FB593 FOREIGN KEY (runner_id) REFERENCES runners (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE run_participations DROP FOREIGN KEY FK_D412F1D584E3FEC4');
        $this->addSql('ALTER TABLE run_results DROP FOREIGN KEY FK_C7C1943484E3FEC4');
        $this->addSql('ALTER TABLE run_participations DROP FOREIGN KEY FK_D412F1D53C7FB593');
        $this->addSql('ALTER TABLE run_results DROP FOREIGN KEY FK_C7C194343C7FB593');
        $this->addSql('DROP TABLE runs');
        $this->addSql('DROP TABLE runners');
        $this->addSql('DROP TABLE run_participations');
        $this->addSql('DROP TABLE run_results');
    }
}
