<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608132353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810F363C1047');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FCC28B580');
        $this->addSql('DROP TABLE marque');
        $this->addSql('ALTER TABLE gallerie_image DROP nom');
        $this->addSql('DROP INDEX IDX_E9E2810FCC28B580 ON voiture');
        $this->addSql('DROP INDEX IDX_E9E2810F363C1047 ON voiture');
        $this->addSql('ALTER TABLE voiture ADD titre_annonce VARCHAR(50) NOT NULL, DROP idvoiture_id, DROP idmarque_id, DROP modele');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE gallerie_image ADD nom VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE voiture ADD idvoiture_id INT DEFAULT NULL, ADD idmarque_id INT DEFAULT NULL, ADD modele VARCHAR(30) NOT NULL, DROP titre_annonce');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810F363C1047 FOREIGN KEY (idmarque_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FCC28B580 FOREIGN KEY (idvoiture_id) REFERENCES marque (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E9E2810FCC28B580 ON voiture (idvoiture_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810F363C1047 ON voiture (idmarque_id)');
    }
}
