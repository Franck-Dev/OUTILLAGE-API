<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220329122103 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle ADD ref_plan VARCHAR(255) NOT NULL, ADD ind_plan VARCHAR(2) NOT NULL, ADD chemin_cao VARCHAR(255) DEFAULT NULL, ADD details_controle VARCHAR(255) DEFAULT NULL, ADD tolerances VARCHAR(10) DEFAULT NULL, ADD dispo_out DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD type_rapport VARCHAR(255) DEFAULT NULL, ADD moyen_mesure VARCHAR(255) DEFAULT NULL, ADD infos_complementaire VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE controle DROP ref_plan, DROP ind_plan, DROP chemin_cao, DROP details_controle, DROP tolerances, DROP dispo_out, DROP type_rapport, DROP moyen_mesure, DROP infos_complementaire');
    }
}
