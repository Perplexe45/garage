<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230614163852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option_voiture (id INT AUTO_INCREMENT NOT NULL, idoptions_id INT NOT NULL, idvoiture_id INT NOT NULL, INDEX IDX_F116967AF77218CB (idoptions_id), INDEX IDX_F116967ACC28B580 (idvoiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE options (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE option_voiture ADD CONSTRAINT FK_F116967AF77218CB FOREIGN KEY (idoptions_id) REFERENCES options (id)');
        $this->addSql('ALTER TABLE option_voiture ADD CONSTRAINT FK_F116967ACC28B580 FOREIGN KEY (idvoiture_id) REFERENCES voiture (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE option_voiture DROP FOREIGN KEY FK_F116967AF77218CB');
        $this->addSql('ALTER TABLE option_voiture DROP FOREIGN KEY FK_F116967ACC28B580');
        $this->addSql('DROP TABLE option_voiture');
        $this->addSql('DROP TABLE options');
    }
}
