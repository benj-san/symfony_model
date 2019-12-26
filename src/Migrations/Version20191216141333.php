<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191216141333 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE booking (id INT AUTO_INCREMENT NOT NULL, begin_at DATETIME DEFAULT NULL, end_at DATETIME DEFAULT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_registration CHANGE registration_date registration_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE registration CHANGE registration_date registration_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE event CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE booking');
        $this->addSql('ALTER TABLE event CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE end_date end_date DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE event_registration CHANGE registration_date registration_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE registration CHANGE registration_date registration_date DATETIME NOT NULL');
    }
}
