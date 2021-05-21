<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210521092016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE room_visit_log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATE NOT NULL, player_name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE visit (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_visit_log_id INTEGER NOT NULL, room_name VARCHAR(255) NOT NULL, times_visited INTEGER DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_437EE93966D5A120 ON visit (room_visit_log_id)');
        $this->addSql('DROP INDEX IDX_96737FF1D70101B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achievement AS SELECT id, achievement_log_id, description FROM achievement');
        $this->addSql('DROP TABLE achievement');
        $this->addSql('CREATE TABLE achievement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, achievement_log_id INTEGER DEFAULT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_96737FF1D70101B FOREIGN KEY (achievement_log_id) REFERENCES achievement_log (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO achievement (id, achievement_log_id, description) SELECT id, achievement_log_id, description FROM __temp__achievement');
        $this->addSql('DROP TABLE __temp__achievement');
        $this->addSql('CREATE INDEX IDX_96737FF1D70101B ON achievement (achievement_log_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE room_visit_log');
        $this->addSql('DROP TABLE visit');
        $this->addSql('DROP INDEX IDX_96737FF1D70101B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achievement AS SELECT id, achievement_log_id, description FROM achievement');
        $this->addSql('DROP TABLE achievement');
        $this->addSql('CREATE TABLE achievement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, achievement_log_id INTEGER DEFAULT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO achievement (id, achievement_log_id, description) SELECT id, achievement_log_id, description FROM __temp__achievement');
        $this->addSql('DROP TABLE __temp__achievement');
        $this->addSql('CREATE INDEX IDX_96737FF1D70101B ON achievement (achievement_log_id)');
    }
}
