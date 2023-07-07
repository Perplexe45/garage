<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230707083947 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis CHANGE idemploye_id idemploye_id INT NOT NULL');
        $this->addSql('ALTER TABLE contact CHANGE idemploye_id idemploye_id INT NOT NULL');
        $this->addSql('ALTER TABLE employe DROP confirm_password, CHANGE password password VARCHAR(255) NOT NULL, CHANGE is_admin is_admin TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE equipement_voiture CHANGE idvoiture_id idvoiture_id INT NOT NULL, CHANGE idequipement_id idequipement_id INT NOT NULL');
        $this->addSql('ALTER TABLE modele DROP FOREIGN KEY FK_10028558363C1047');
        $this->addSql('DROP INDEX IDX_10028558363C1047 ON modele');
        $this->addSql('ALTER TABLE modele DROP idmarque_id, CHANGE id_marque id_marque INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modele RENAME INDEX fk_modele_id_marque TO IDX_100285587C582423');
        $this->addSql('ALTER TABLE option_voiture CHANGE idoptions_id idoptions_id INT NOT NULL, CHANGE idvoiture_id idvoiture_id INT NOT NULL');
        $this->addSql('ALTER TABLE service CHANGE idemploye_id idemploye_id INT NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD idequipement_id INT DEFAULT NULL, ADD idoption_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FF9F51887 FOREIGN KEY (idequipement_id) REFERENCES equipement_voiture (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FD9DFB49A FOREIGN KEY (idoption_id) REFERENCES option_voiture (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F363C1047 FOREIGN KEY (idmarque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FD20F1EFF FOREIGN KEY (idmodele_id) REFERENCES modele (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FF9F51887 ON voiture (idequipement_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FD9DFB49A ON voiture (idoption_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipement_voiture CHANGE idvoiture_id idvoiture_id INT DEFAULT NULL, CHANGE idequipement_id idequipement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD confirm_password VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE is_admin is_admin TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FF9F51887');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FD9DFB49A');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F363C1047');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FD20F1EFF');
        $this->addSql('DROP INDEX IDX_E9E2810FF9F51887 ON voiture');
        $this->addSql('DROP INDEX IDX_E9E2810FD9DFB49A ON voiture');
        $this->addSql('ALTER TABLE voiture DROP idequipement_id, DROP idoption_id');
        $this->addSql('ALTER TABLE avis CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE option_voiture CHANGE idoptions_id idoptions_id INT DEFAULT NULL, CHANGE idvoiture_id idvoiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modele ADD idmarque_id INT DEFAULT NULL, CHANGE id_marque id_marque INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558363C1047 FOREIGN KEY (idmarque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_10028558363C1047 ON modele (idmarque_id)');
        $this->addSql('ALTER TABLE modele RENAME INDEX idx_100285587c582423 TO FK_modele_id_marque');
    }
}
