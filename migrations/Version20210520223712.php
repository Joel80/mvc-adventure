<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520223712 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_96737FF1D70101B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achievement AS SELECT id, achievement_log_id, description FROM achievement');
        $this->addSql('DROP TABLE achievement');
        $this->addSql('CREATE TABLE achievement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, achievement_log_id INTEGER DEFAULT NULL, description VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_96737FF1D70101B FOREIGN KEY (achievement_log_id) REFERENCES achievement_log (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO achievement (id, achievement_log_id, description) SELECT id, achievement_log_id, description FROM __temp__achievement');
        $this->addSql('DROP TABLE __temp__achievement');
        $this->addSql('CREATE INDEX IDX_96737FF1D70101B ON achievement (achievement_log_id)');
        $this->addSql('ALTER TABLE event_descriptor ADD COLUMN achievement VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_96737FF1D70101B');
        $this->addSql('CREATE TEMPORARY TABLE __temp__achievement AS SELECT id, achievement_log_id, description FROM achievement');
        $this->addSql('DROP TABLE achievement');
        $this->addSql('CREATE TABLE achievement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, achievement_log_id INTEGER DEFAULT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO achievement (id, achievement_log_id, description) SELECT id, achievement_log_id, description FROM __temp__achievement');
        $this->addSql('DROP TABLE __temp__achievement');
        $this->addSql('CREATE INDEX IDX_96737FF1D70101B ON achievement (achievement_log_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__event_descriptor AS SELECT id, event, description, room_description, add_exit, exit_leads_to, exit_is_in_room, exit_name, event_room FROM event_descriptor');
        $this->addSql('DROP TABLE event_descriptor');
        $this->addSql('CREATE TABLE event_descriptor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, event VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, room_description VARCHAR(2000) NOT NULL, add_exit BOOLEAN NOT NULL, exit_leads_to VARCHAR(255) DEFAULT NULL, exit_is_in_room VARCHAR(255) DEFAULT NULL, exit_name VARCHAR(255) DEFAULT NULL, event_room VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO event_descriptor (id, event, description, room_description, add_exit, exit_leads_to, exit_is_in_room, exit_name, event_room) SELECT id, event, description, room_description, add_exit, exit_leads_to, exit_is_in_room, exit_name, event_room FROM __temp__event_descriptor');
        $this->addSql('DROP TABLE __temp__event_descriptor');
    }
}
