<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230602150220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis (id INT AUTO_INCREMENT NOT NULL, idemploye_id INT NOT NULL, commentaire LONGTEXT NOT NULL, note INT NOT NULL, nom VARCHAR(30) NOT NULL, acceptation TINYINT(1) DEFAULT NULL, INDEX IDX_8F91ABF0CC1F4FA8 (idemploye_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, idemploye_id INT NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, email VARCHAR(100) NOT NULL, telephone VARCHAR(25) NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_4C62E638CC1F4FA8 (idemploye_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE description (id INT AUTO_INCREMENT NOT NULL, idservice_id INT NOT NULL, nom VARCHAR(50) NOT NULL, prix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_6DE4402620F5B4DC (idservice_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employe (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(30) NOT NULL, prenom VARCHAR(30) NOT NULL, adresse VARCHAR(150) NOT NULL, code_postal INT NOT NULL, ville VARCHAR(30) NOT NULL, telephone VARCHAR(25) NOT NULL, is_admin TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F804D3B9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE horaire (id INT AUTO_INCREMENT NOT NULL, idemploye_id INT NOT NULL, jour DATE NOT NULL, heure_ouverture TIME NOT NULL, heure_fermeture TIME NOT NULL, INDEX IDX_BBC83DB6CC1F4FA8 (idemploye_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, idemploye_id INT NOT NULL, nom VARCHAR(50) NOT NULL, INDEX IDX_E19D9AD2CC1F4FA8 (idemploye_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis ADD CONSTRAINT FK_8F91ABF0CC1F4FA8 FOREIGN KEY (idemploye_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638CC1F4FA8 FOREIGN KEY (idemploye_id) REFERENCES employe (id)');
        $this->addSql('ALTER TABLE description ADD CONSTRAINT FK_6DE4402620F5B4DC FOREIGN KEY (idservice_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE service ADD CONSTRAINT FK_E19D9AD2CC1F4FA8 FOREIGN KEY (idemploye_id) REFERENCES employe (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis DROP FOREIGN KEY FK_8F91ABF0CC1F4FA8');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638CC1F4FA8');
        $this->addSql('ALTER TABLE description DROP FOREIGN KEY FK_6DE4402620F5B4DC');
        $this->addSql('ALTER TABLE horaire DROP FOREIGN KEY FK_BBC83DB6CC1F4FA8');
        $this->addSql('ALTER TABLE service DROP FOREIGN KEY FK_E19D9AD2CC1F4FA8');
        $this->addSql('DROP TABLE avis');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE description');
        $this->addSql('DROP TABLE employe');
        $this->addSql('DROP TABLE horaire');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
