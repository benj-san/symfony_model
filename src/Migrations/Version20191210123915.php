<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191210123915 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_protagonist (tag_id INT NOT NULL, protagonist_id INT NOT NULL, INDEX IDX_3CC76AE5BAD26311 (tag_id), INDEX IDX_3CC76AE5CDF038AD (protagonist_id), PRIMARY KEY(tag_id, protagonist_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_protagonist ADD CONSTRAINT FK_3CC76AE5BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_protagonist ADD CONSTRAINT FK_3CC76AE5CDF038AD FOREIGN KEY (protagonist_id) REFERENCES protagonist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE protagonist RENAME INDEX idx_937ab03412469de2 TO IDX_200E100512469DE2');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag_protagonist DROP FOREIGN KEY FK_3CC76AE5BAD26311');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE tag_protagonist');
        $this->addSql('ALTER TABLE protagonist RENAME INDEX idx_200e100512469de2 TO IDX_937AB03412469DE2');
    }
}
