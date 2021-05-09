<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210509070741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D4BAB96C');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP INDEX IDX_2265B05D4BAB96C ON usuario');
        $this->addSql('ALTER TABLE usuario ADD rol VARCHAR(255) NOT NULL, DROP rol_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, rol VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE usuario ADD rol_id INT NOT NULL, DROP rol');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D4BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id)');
        $this->addSql('CREATE INDEX IDX_2265B05D4BAB96C ON usuario (rol_id)');
    }
}
