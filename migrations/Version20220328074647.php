<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328074647 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE controle (id INT AUTO_INCREMENT NOT NULL, outillage_id INT NOT NULL, equipement_id INT DEFAULT NULL, date_besoin DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_creat VARCHAR(255) NOT NULL, user_modif VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_E39396E1714266E (outillage_id), INDEX IDX_E39396E806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maintenance (id INT AUTO_INCREMENT NOT NULL, outillage_id INT DEFAULT NULL, equipement_id INT DEFAULT NULL, date_besoin DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', description LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_creat VARCHAR(255) NOT NULL, user_modif VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_2F84F8E91714266E (outillage_id), INDEX IDX_2F84F8E9806F0F5C (equipement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sbo (id INT AUTO_INCREMENT NOT NULL, outillage_id INT DEFAULT NULL, indice VARCHAR(2) NOT NULL, identification VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_besoin DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_creat VARCHAR(255) NOT NULL, user_modif VARCHAR(255) DEFAULT NULL, fichier VARCHAR(255) DEFAULT NULL, INDEX IDX_23307AF71714266E (outillage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396E1714266E FOREIGN KEY (outillage_id) REFERENCES tool (id)');
        $this->addSql('ALTER TABLE controle ADD CONSTRAINT FK_E39396E806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E91714266E FOREIGN KEY (outillage_id) REFERENCES tool (id)');
        $this->addSql('ALTER TABLE maintenance ADD CONSTRAINT FK_2F84F8E9806F0F5C FOREIGN KEY (equipement_id) REFERENCES equipement (id)');
        $this->addSql('ALTER TABLE sbo ADD CONSTRAINT FK_23307AF71714266E FOREIGN KEY (outillage_id) REFERENCES tool (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE controle');
        $this->addSql('DROP TABLE maintenance');
        $this->addSql('DROP TABLE sbo');
    }
}
