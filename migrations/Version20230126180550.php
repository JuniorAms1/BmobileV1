<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126180550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE enseigne_details (id INT AUTO_INCREMENT NOT NULL, enseigne_id INT NOT NULL, first_illustration VARCHAR(255) NOT NULL, second_illustration VARCHAR(255) DEFAULT NULL, third_illustration VARCHAR(255) DEFAULT NULL, catalogue VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, siteweb VARCHAR(255) DEFAULT NULL, map_localisation LONGTEXT NOT NULL, rs_insta VARCHAR(255) DEFAULT NULL, rs_facebook VARCHAR(255) DEFAULT NULL, rs_twitter VARCHAR(255) DEFAULT NULL, whatsapp VARCHAR(255) NOT NULL, a_propos LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_F3BEA9156C2A0A71 (enseigne_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enseigne_details ADD CONSTRAINT FK_F3BEA9156C2A0A71 FOREIGN KEY (enseigne_id) REFERENCES enseigne (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enseigne_details DROP FOREIGN KEY FK_F3BEA9156C2A0A71');
        $this->addSql('DROP TABLE enseigne_details');
    }
}
