<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230606144457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipement (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE equipement_voiture (id INT AUTO_INCREMENT NOT NULL, idvoiture_id INT NOT NULL, idequipement_id INT NOT NULL, INDEX IDX_E26FCBDCCC28B580 (idvoiture_id), INDEX IDX_E26FCBDCF9F51887 (idequipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gallerie_image (id INT AUTO_INCREMENT NOT NULL, img1 VARCHAR(255) DEFAULT NULL, img2 VARCHAR(255) DEFAULT NULL, img3 VARCHAR(255) DEFAULT NULL, img4 VARCHAR(255) DEFAULT NULL, img5 VARCHAR(255) DEFAULT NULL, img6 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `option` (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE option_voiture (id INT AUTO_INCREMENT NOT NULL, idoption_id INT NOT NULL, idvoiture_id INT NOT NULL, INDEX IDX_F116967AD9DFB49A (idoption_id), INDEX IDX_F116967ACC28B580 (idvoiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realiser (id INT AUTO_INCREMENT NOT NULL, idservice_id INT NOT NULL, idvoiture_id INT DEFAULT NULL, date DATE DEFAULT NULL, heure TIME DEFAULT NULL, INDEX IDX_7BAB8D0720F5B4DC (idservice_id), INDEX IDX_7BAB8D07CC28B580 (idvoiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voiture (id INT AUTO_INCREMENT NOT NULL, idemploye_id INT NOT NULL, idgallerie_image_id INT NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, circulation VARCHAR(30) NOT NULL, kilometre INT NOT NULL, INDEX IDX_E9E2810FCC1F4FA8 (idemploye_id), INDEX IDX_E9E2810FD48F7184 (idgallerie_image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE equipement_voiture ADD CONSTRAINT FK_E26FCBDCCC28B580 FOREIGN KEY (idvoiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE equipement_voiture ADD CONSTRAINT FK_E26FCBDCF9F51887 FOREIGN KEY (idequipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE option_voiture ADD CONSTRAINT FK_F116967AD9DFB49A FOREIGN KEY (idoption_id) REFERENCES `option` (id)');
        $this->addSql('ALTER TABLE option_voiture ADD CONSTRAINT FK_F116967ACC28B580 FOREIGN KEY (idvoiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D0720F5B4DC FOREIGN KEY (idservice_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE realiser ADD CONSTRAINT FK_7BAB8D07CC28B580 FOREIGN KEY (idvoiture_id) REFERENCES voiture (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FCC1F4FA8 FOREIGN KEY (idemploye_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FD48F7184 FOREIGN KEY (idgallerie_image_id) REFERENCES gallerie_image (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement_voiture DROP FOREIGN KEY FK_E26FCBDCCC28B580');
        $this->addSql('ALTER TABLE equipement_voiture DROP FOREIGN KEY FK_E26FCBDCF9F51887');
        $this->addSql('ALTER TABLE option_voiture DROP FOREIGN KEY FK_F116967AD9DFB49A');
        $this->addSql('ALTER TABLE option_voiture DROP FOREIGN KEY FK_F116967ACC28B580');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D0720F5B4DC');
        $this->addSql('ALTER TABLE realiser DROP FOREIGN KEY FK_7BAB8D07CC28B580');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FCC1F4FA8');
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FD48F7184');
        $this->addSql('DROP TABLE equipement');
        $this->addSql('DROP TABLE equipement_voiture');
        $this->addSql('DROP TABLE gallerie_image');
        $this->addSql('DROP TABLE `option`');
        $this->addSql('DROP TABLE option_voiture');
        $this->addSql('DROP TABLE realiser');
        $this->addSql('DROP TABLE voiture');
    }
}
