<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331081004 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE maintenance_maintenance_items (maintenance_id INT NOT NULL, maintenance_items_id INT NOT NULL, INDEX IDX_62ACE21FF6C202BC (maintenance_id), INDEX IDX_62ACE21F75C8AAA9 (maintenance_items_id), PRIMARY KEY(maintenance_id, maintenance_items_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maintenance_items (id INT AUTO_INCREMENT NOT NULL, non_conformite LONGTEXT NOT NULL, actions_correctives LONGTEXT DEFAULT NULL, respo VARCHAR(255) DEFAULT NULL, delai_action DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', user_real VARCHAR(255) DEFAULT NULL, date_real DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE maintenance_maintenance_items ADD CONSTRAINT FK_62ACE21FF6C202BC FOREIGN KEY (maintenance_id) REFERENCES maintenance (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maintenance_maintenance_items ADD CONSTRAINT FK_62ACE21F75C8AAA9 FOREIGN KEY (maintenance_items_id) REFERENCES maintenance_items (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE maintenance DROP cause_dem, DROP actions_correctives, DROP respo, DROP delai_action, DROP user_real, DROP date_real');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE maintenance_maintenance_items DROP FOREIGN KEY FK_62ACE21F75C8AAA9');
        $this->addSql('DROP TABLE maintenance_maintenance_items');
        $this->addSql('DROP TABLE maintenance_items');
        $this->addSql('ALTER TABLE maintenance ADD cause_dem VARCHAR(255) NOT NULL, ADD actions_correctives LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD respo LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD delai_action LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD user_real LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', ADD date_real LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\'');
    }
}
