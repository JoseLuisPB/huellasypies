<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210516082157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mascota ADD modificada TINYINT(1) NOT NULL, CHANGE fecha_alta fecha_alta VARCHAR(255) NOT NULL, CHANGE fecha_adopcion fecha_adopcion VARCHAR(255) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2265B05DE7927C74 ON usuario (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mascota DROP modificada, CHANGE fecha_alta fecha_alta DATE NOT NULL, CHANGE fecha_adopcion fecha_adopcion DATE NOT NULL');
        $this->addSql('DROP INDEX UNIQ_2265B05DE7927C74 ON usuario');
    }
}
