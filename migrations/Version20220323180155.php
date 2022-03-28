<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323180155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demandes (id INT AUTO_INCREMENT NOT NULL, tool_sap_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, date_besoin DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', demandeur VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_affectation DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', groupe_affectation VARCHAR(255) DEFAULT NULL, date_planif DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_real DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', statut VARCHAR(255) NOT NULL, INDEX IDX_BD940CBBF483093 (tool_sap_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tool (id INT AUTO_INCREMENT NOT NULL, sap_tool_number INT NOT NULL, designation VARCHAR(255) DEFAULT NULL, identification VARCHAR(255) DEFAULT NULL, utilisation VARCHAR(255) DEFAULT NULL, programme_avion VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_20F33ED1BD7DC630 (sap_tool_number), UNIQUE INDEX UNIQ_20F33ED149E7720D (identification), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBBF483093 FOREIGN KEY (tool_sap_id) REFERENCES tool (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBBF483093');
        $this->addSql('DROP TABLE demandes');
        $this->addSql('DROP TABLE tool');
    }
}
