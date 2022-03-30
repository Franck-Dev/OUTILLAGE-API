<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330192547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maintenance ADD non_conformite LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', ADD sigle VARCHAR(20) DEFAULT NULL, ADD cause_dem VARCHAR(255) NOT NULL, ADD actions_correctives LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD user_valideur VARCHAR(255) DEFAULT NULL, ADD date_valid DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', ADD respo LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD delai_action LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD user_real LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD date_real LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD rep LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', DROP description');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maintenance ADD description LONGTEXT NOT NULL, DROP non_conformite, DROP sigle, DROP cause_dem, DROP actions_correctives, DROP user_valideur, DROP date_valid, DROP respo, DROP delai_action, DROP user_real, DROP date_real, DROP rep');
    }
}
