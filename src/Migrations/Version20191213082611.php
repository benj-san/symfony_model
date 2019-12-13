<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191213082611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, start_date DATETIME DEFAULT NULL, end_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_protagonist (event_id INT NOT NULL, protagonist_id INT NOT NULL, INDEX IDX_8B87C38571F7E88B (event_id), INDEX IDX_8B87C385CDF038AD (protagonist_id), PRIMARY KEY(event_id, protagonist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event_protagonist ADD CONSTRAINT FK_8B87C38571F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_protagonist ADD CONSTRAINT FK_8B87C385CDF038AD FOREIGN KEY (protagonist_id) REFERENCES protagonist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE registration CHANGE registration_date registration_date DATETIME NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE event_protagonist DROP FOREIGN KEY FK_8B87C38571F7E88B');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_protagonist');
        $this->addSql('ALTER TABLE registration CHANGE registration_date registration_date DATETIME NOT NULL');
    }
}
