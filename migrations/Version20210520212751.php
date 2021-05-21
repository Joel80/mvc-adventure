<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210520212751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE achievement (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, achievement_log_id INTEGER DEFAULT NULL, description VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_96737FF1D70101B ON achievement (achievement_log_id)');
        $this->addSql('CREATE TABLE achievement_log (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATE NOT NULL, player_name VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE event_descriptor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, event VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, room_description VARCHAR(2000) NOT NULL, add_exit BOOLEAN NOT NULL, exit_leads_to VARCHAR(255) DEFAULT NULL, exit_is_in_room VARCHAR(255) DEFAULT NULL, exit_name VARCHAR(255) DEFAULT NULL, event_room VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE exit_descriptor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, leads_to_room VARCHAR(255) NOT NULL, located_in_room VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE item_descriptor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, item_id VARCHAR(255) NOT NULL, placement_description VARCHAR(255) NOT NULL, room_index VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE room_descriptor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, description VARCHAR(2000) NOT NULL, room_index VARCHAR(255) NOT NULL, room_image VARCHAR(255) NOT NULL, room_name VARCHAR(255) NOT NULL)');
    }

    public function postUp(Schema $schema): void
    {
        $this->connection->insert("room_descriptor", ['description' => 'You are in in a room filled with debris. Beds, desks and overturned chairs litter the room. Severed cables hangs from the ceiling. Red flashing emergency light fills the room and you can see a small locker in one corner of the room. The locker door is slightly ajar but seems jammed. To the north is a great door, it is shut and seems impossible to open by force. On the floor in front of the door lies a fallen exit sign. There is a small slot next to the door.', 'room_index' => 'roomOne', 'room_image' => 'img/room1.jpg', 'room_name' => 'The Safe Room']);
        $this->connection->insert("room_descriptor", ['description' => 'This hallway is lit only by the flashing red light from the room to the south. Dust and debris covers the floor. Water drips from the ceiling high above and forms a small pool in the middle of the floor. There is an exit to the south and an exit to the east.', 'room_index' => 'roomTwo', 'room_image' => 'img/room2.jpg', 'room_name' => 'The Hallway']);
        $this->connection->insert("room_descriptor", ['description' => 'This room seems to get it´s power from another power source. It is dark but a small computer on a desk in the corner seems to be working. The screen flashes: \'Authorization needed\'. There is an exit to the west, an exit to the east and an exit to the north', 'room_index' => 'roomThree', 'room_image' => 'img/room3.jpg', 'room_name' => 'The Surveilance Room']);
        $this->connection->insert("room_descriptor", ['description' => 'This room - maybe it was a canteen once? You can´t remember but there are many tables and chairs here among the debris. There is an exit to the west.', 'room_index' => 'roomFour', 'room_image' => 'img/room4.jpg', 'room_name' => 'The Canteen']);
        $this->connection->insert("room_descriptor", ['description' => 'The power seems to be working in this this great hall. It basks in flickering yellow light. The room is dominated by a large vault door on the northern wall. Next to the door is a keypad. There is an exit to the south.', 'room_index' => 'roomFive', 'room_image' => 'img/room5.jpg', 'room_name' => 'The Canteen']);
        $this->connection->insert("room_descriptor", ['description' => 'You are outside, free once again. But the world has changed. The sky is ashen grey, the soil is twisted and burned. Dust storms rages on the horizon. To the north you think you can spot some ruins. After a brief moment of hesitation you move on towards the ruins - braving this new desolated world.', 'room_index' => 'roomSix', 'room_image' => 'img/room6.jpg', 'room_name' => 'Outside']);
        $this->connection->insert("room_descriptor", ['description' => 'You are in in a room filled with debris. Beds, desks, and overturned chairs litter the room. Severed cables hangs from the ceiling. Red flashing emergency light fills the room and you can see a small locker in one corner of the room. The locker door is slightly ajar but seems jammed. A fallen exit sign lies on the floor. The door to the north is open', 'room_index' => 'roomOnePostEv1', 'room_image' => 'img/room1.jpg', 'room_name' => 'The Safe Room']);
        $this->connection->insert("room_descriptor", ['description' => 'You are in in a room filled with debris. Beds, desks and overturned chairs litter the room. Severed cables hangs from the ceiling. Red flashing emergency light fills the room and you can see a small locker in one corner of the room. The locker door is open and you can see the number \'1\' drawn on the wall inside. A fallen exit sign lies on the floor. The door to the north is open', 'room_index' => 'roomOnePostEv2', 'room_image' => 'img/room1.jpg', 'room_name' => 'The Safe Room']);
        $this->connection->insert("room_descriptor", ['description' => 'This hallway is lit only by the flashing red light from the room to the south. Dust and debris covers the floor. Someone has etched a \'3\' in the middle of the floor. There is an exit to the south and an exit to the east.', 'room_index' => 'roomTwoPostEv3', 'room_image' => 'img/room2.jpg', 'room_name' => 'The Hallway']);
        $this->connection->insert("room_descriptor", ['description' => 'This room seems to get it´s power from another power source. It is dark but a small computer on a desk in the corner seems to be working. The screen flickers and you can here a voice repeating \'Zzzz exit code zz3z\'. It is hard to hear the message among all the static. There is an exit to the west, an exit to the east and an exit to the north', 'room_index' => 'roomThreePostEv4', 'room_image' => 'img/room3.jpg', 'room_name' => 'The Surveilance Room']);
        $this->connection->insert("room_descriptor", ['description' => 'The power seems to be working in this this great hall. It basks in flickering yellow light. The great vault door on the north wall is open. There is an exit to the south. To the north lies the exit to the rest of the world and maybe freedom?', 'room_index' => 'roomFivePostEv5', 'room_image' => 'img/room5.jpg', 'room_name' => 'The Canteen']);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE achievement');
        $this->addSql('DROP TABLE achievement_log');
        $this->addSql('DROP TABLE event_descriptor');
        $this->addSql('DROP TABLE exit_descriptor');
        $this->addSql('DROP TABLE item_descriptor');
        $this->addSql('DROP TABLE room_descriptor');
    }
}
