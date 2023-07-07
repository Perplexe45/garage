<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230706151059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

        $this->addSql('ALTER TABLE voiture ADD circulation INT NOT NULL, ADD prix INT NOT NULL, CHANGE idmarque_id idmarque_id INT NOT NULL, CHANGE idmodele_id idmodele_id INT NOT NULL, CHANGE caracteristique caracteristique VARCHAR(300) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipement_voiture CHANGE idvoiture_id idvoiture_id INT DEFAULT NULL, CHANGE idequipement_id idequipement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture DROP circulation, DROP prix, CHANGE idmarque_id idmarque_id INT DEFAULT NULL, CHANGE idmodele_id idmodele_id INT DEFAULT NULL, CHANGE caracteristique caracteristique LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe ADD confirm_password VARCHAR(255) DEFAULT NULL, CHANGE password password VARCHAR(255) DEFAULT NULL, CHANGE is_admin is_admin TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE avis CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE option_voiture CHANGE idoptions_id idoptions_id INT DEFAULT NULL, CHANGE idvoiture_id idvoiture_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE modele ADD idmarque_id INT DEFAULT NULL, CHANGE id_marque id_marque INT NOT NULL');
        $this->addSql('ALTER TABLE modele ADD CONSTRAINT FK_10028558363C1047 FOREIGN KEY (idmarque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_10028558363C1047 ON modele (idmarque_id)');
        $this->addSql('ALTER TABLE modele RENAME INDEX idx_100285587c582423 TO FK_modele_id_marque');
    }
}
