<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230630064241 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD idmarque_id INT, ADD idmodele_id INT, CHANGE titre_annonce titre_annonce VARCHAR(50)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F363C1047 FOREIGN KEY (idmarque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FD20F1EFF FOREIGN KEY (idmodele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F363C1047 ON voiture (idmarque_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FD20F1EFF ON voiture (idmodele_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contact CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F363C1047');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FD20F1EFF');
        $this->addSql('DROP INDEX IDX_E9E2810F363C1047 ON voiture');
        $this->addSql('DROP INDEX IDX_E9E2810FD20F1EFF ON voiture');
        $this->addSql('ALTER TABLE voiture DROP idmarque_id, DROP idmodele_id, CHANGE titre_annonce titre_annonce VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE service CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD confirm_password VARCHAR(255) NOT NULL, CHANGE is_admin is_admin TINYINT(1) DEFAULT NULL');
    }
}
