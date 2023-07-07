<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230615032554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture ADD idequipement_id INT DEFAULT NULL, ADD idoption_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voiture ADD CONSTRAINT FK_E9E2810FD9DFB49A FOREIGN KEY (idoption_id) REFERENCES option_voiture (id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FF9F51887 ON voiture (idequipement_id)');
        $this->addSql('CREATE INDEX IDX_E9E2810FD9DFB49A ON voiture (idoption_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voiture DROP FOREIGN KEY FK_E9E2810FD9DFB49A');
        $this->addSql('DROP INDEX IDX_E9E2810FF9F51887 ON voiture');
        $this->addSql('DROP INDEX IDX_E9E2810FD9DFB49A ON voiture');
        $this->addSql('ALTER TABLE voiture DROP idequipement_id, DROP idoption_id');
    }
}
