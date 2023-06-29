<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628074256 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE info_speciale (id INT AUTO_INCREMENT NOT NULL, idemploye_id INT DEFAULT NULL, designation LONGTEXT NOT NULL, INDEX IDX_C1A0D9CDCC1F4FA8 (idemploye_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE info_speciale ADD CONSTRAINT FK_C1A0D9CDCC1F4FA8 FOREIGN KEY (idemploye_id) REFERENCES employe (id)');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE info_speciale DROP FOREIGN KEY FK_C1A0D9CDCC1F4FA8');
        $this->addSql('DROP TABLE info_speciale');
        $this->addSql('ALTER TABLE employe CHANGE is_admin TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture CHANGE titre_annonce titre_annonce VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE avis CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
    }
}
