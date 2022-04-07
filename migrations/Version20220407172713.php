<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220407172713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement ADD tool_id INT DEFAULT NULL, ADD site VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F38F7B22CC FOREIGN KEY (tool_id) REFERENCES tool (id)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F38F7B22CC ON equipement (tool_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F38F7B22CC');
        $this->addSql('DROP INDEX IDX_B8B4C6F38F7B22CC ON equipement');
        $this->addSql('ALTER TABLE equipement DROP tool_id, DROP site');
    }
}
