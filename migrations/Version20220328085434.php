<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220328085434 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_travail (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBBF483093');
        $this->addSql('DROP INDEX IDX_BD940CBBF483093 ON demandes');
        $this->addSql('ALTER TABLE demandes ADD controle_id INT DEFAULT NULL, ADD maintenance_id INT DEFAULT NULL, DROP type, DROP description, DROP date_besoin, DROP demandeur, CHANGE tool_sap_id sbo_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB25C30196 FOREIGN KEY (sbo_id) REFERENCES sbo (id)');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBB758926A6 FOREIGN KEY (controle_id) REFERENCES controle (id)');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBBF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD940CBB25C30196 ON demandes (sbo_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD940CBB758926A6 ON demandes (controle_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BD940CBBF6C202BC ON demandes (maintenance_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE type_travail');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBB25C30196');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBB758926A6');
        $this->addSql('ALTER TABLE demandes DROP FOREIGN KEY FK_BD940CBBF6C202BC');
        $this->addSql('DROP INDEX UNIQ_BD940CBB25C30196 ON demandes');
        $this->addSql('DROP INDEX UNIQ_BD940CBB758926A6 ON demandes');
        $this->addSql('DROP INDEX UNIQ_BD940CBBF6C202BC ON demandes');
        $this->addSql('ALTER TABLE demandes ADD tool_sap_id INT DEFAULT NULL, ADD type VARCHAR(255) NOT NULL, ADD description LONGTEXT NOT NULL, ADD date_besoin DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD demandeur VARCHAR(255) NOT NULL, DROP sbo_id, DROP controle_id, DROP maintenance_id');
        $this->addSql('ALTER TABLE demandes ADD CONSTRAINT FK_BD940CBBF483093 FOREIGN KEY (tool_sap_id) REFERENCES tool (id)');
        $this->addSql('CREATE INDEX IDX_BD940CBBF483093 ON demandes (tool_sap_id)');
    }
}
