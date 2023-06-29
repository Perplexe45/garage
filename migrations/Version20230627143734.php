<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230627143734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        $this->addSql('ALTER TABLE employe ADD confirm_password VARCHAR(255) NOT NULL, CHANGE is_admin is_admin TINYINT NULL');

       
       
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE service CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE avis CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contact CHANGE idemploye_id idemploye_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE employe DROP confirm_password, CHANGE is_admin is_admin TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture CHANGE titre_annonce titre_annonce VARCHAR(50) DEFAULT NULL');
    }
}
