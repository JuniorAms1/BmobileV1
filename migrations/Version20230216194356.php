<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230216194356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre ADD parrain_id INT DEFAULT NULL, ADD referal_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29DE2A7A37 FOREIGN KEY (parrain_id) REFERENCES membre (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F6B4FB29DE2A7A37 ON membre (parrain_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29DE2A7A37');
        $this->addSql('DROP INDEX UNIQ_F6B4FB29DE2A7A37 ON membre');
        $this->addSql('ALTER TABLE membre DROP parrain_id, DROP referal_code');
    }
}
