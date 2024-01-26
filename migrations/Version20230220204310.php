<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230220204310 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE frequentation (id INT AUTO_INCREMENT NOT NULL, membre_id INT NOT NULL, structure_id INT NOT NULL, date_freq DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', montant DOUBLE PRECISION NOT NULL, INDEX IDX_77787A326A99F74A (membre_id), INDEX IDX_77787A322534008B (structure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE frequentation ADD CONSTRAINT FK_77787A326A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('ALTER TABLE frequentation ADD CONSTRAINT FK_77787A322534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frequentation DROP FOREIGN KEY FK_77787A326A99F74A');
        $this->addSql('ALTER TABLE frequentation DROP FOREIGN KEY FK_77787A322534008B');
        $this->addSql('DROP TABLE frequentation');
    }
}
