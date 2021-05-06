<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210506144841 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE estado_mascota (id INT AUTO_INCREMENT NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE estado_noticia (id INT AUTO_INCREMENT NOT NULL, estado VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mascota (id INT AUTO_INCREMENT NOT NULL, tipo_id INT NOT NULL, estado_id INT NOT NULL, usuario_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, foto VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, requisitos LONGTEXT DEFAULT NULL, fecha_alta DATE NOT NULL, fecha_adopcion DATE NOT NULL, vacunado TINYINT(1) NOT NULL, desparasitado TINYINT(1) NOT NULL, esterilizado TINYINT(1) NOT NULL, microchip TINYINT(1) NOT NULL, INDEX IDX_11298D77A9276E6C (tipo_id), INDEX IDX_11298D779F5A440B (estado_id), INDEX IDX_11298D77DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE noticia (id INT AUTO_INCREMENT NOT NULL, estado_id INT NOT NULL, autor_id INT NOT NULL, titulo VARCHAR(255) NOT NULL, cuerpo LONGTEXT NOT NULL, foto VARCHAR(255) NOT NULL, fecha_publicacion DATE NOT NULL, INDEX IDX_31205F969F5A440B (estado_id), INDEX IDX_31205F9614D45BBE (autor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, rol VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_mascota (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, rol_id INT NOT NULL, nombre VARCHAR(255) NOT NULL, poblacion VARCHAR(255) NOT NULL, provincia VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, activo TINYINT(1) NOT NULL, email VARCHAR(255) NOT NULL, telefono VARCHAR(255) NOT NULL, fecha_alta DATE NOT NULL, reiniciar_password TINYINT(1) NOT NULL, direccion VARCHAR(255) DEFAULT NULL, INDEX IDX_2265B05D4BAB96C (rol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D77A9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_mascota (id)');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D779F5A440B FOREIGN KEY (estado_id) REFERENCES estado_mascota (id)');
        $this->addSql('ALTER TABLE mascota ADD CONSTRAINT FK_11298D77DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F969F5A440B FOREIGN KEY (estado_id) REFERENCES estado_noticia (id)');
        $this->addSql('ALTER TABLE noticia ADD CONSTRAINT FK_31205F9614D45BBE FOREIGN KEY (autor_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D4BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D779F5A440B');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F969F5A440B');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D4BAB96C');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D77A9276E6C');
        $this->addSql('ALTER TABLE mascota DROP FOREIGN KEY FK_11298D77DB38439E');
        $this->addSql('ALTER TABLE noticia DROP FOREIGN KEY FK_31205F9614D45BBE');
        $this->addSql('DROP TABLE estado_mascota');
        $this->addSql('DROP TABLE estado_noticia');
        $this->addSql('DROP TABLE mascota');
        $this->addSql('DROP TABLE noticia');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE tipo_mascota');
        $this->addSql('DROP TABLE usuario');
    }
}
