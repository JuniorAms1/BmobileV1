<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230221190127 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frequentation DROP FOREIGN KEY FK_77787A322534008B');
        $this->addSql('ALTER TABLE frequentation DROP FOREIGN KEY FK_77787A326A99F74A');
        $this->addSql('DROP INDEX IDX_77787A326A99F74A ON frequentation');
        $this->addSql('DROP INDEX IDX_77787A322534008B ON frequentation');
        $this->addSql('ALTER TABLE frequentation ADD membre VARCHAR(255) NOT NULL, ADD structure VARCHAR(255) NOT NULL, DROP membre_id, DROP structure_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE frequentation ADD membre_id INT NOT NULL, ADD structure_id INT NOT NULL, DROP membre, DROP structure');
        $this->addSql('ALTER TABLE frequentation ADD CONSTRAINT FK_77787A322534008B FOREIGN KEY (structure_id) REFERENCES structure (id)');
        $this->addSql('ALTER TABLE frequentation ADD CONSTRAINT FK_77787A326A99F74A FOREIGN KEY (membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_77787A326A99F74A ON frequentation (membre_id)');
        $this->addSql('CREATE INDEX IDX_77787A322534008B ON frequentation (structure_id)');
    }
}
