<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404094010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, serie_id INT NOT NULL, number INT NOT NULL, first_air_date DATE DEFAULT NULL, overview LONGTEXT DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, tmdb_id INT NOT NULL, date_created DATETIME NOT NULL, date_modified DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_F0E45BA92D710CF2 (poster), UNIQUE INDEX UNIQ_F0E45BA955BCC5E5 (tmdb_id), INDEX IDX_F0E45BA9D94388BD (serie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE serie (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, overview LONGTEXT DEFAULT NULL, status VARCHAR(50) DEFAULT NULL, vote NUMERIC(3, 1) DEFAULT NULL, popularity NUMERIC(6, 2) DEFAULT NULL, genres VARCHAR(255) DEFAULT NULL, first_air_date DATE DEFAULT NULL, last_air_date DATE DEFAULT NULL, backdrop VARCHAR(255) DEFAULT NULL, poster VARCHAR(255) DEFAULT NULL, tmdb_id INT NOT NULL, date_modified DATETIME DEFAULT NULL, date_created DATETIME NOT NULL, UNIQUE INDEX UNIQ_AA3A9334EBFEDE68 (backdrop), UNIQUE INDEX UNIQ_AA3A93342D710CF2 (poster), UNIQUE INDEX UNIQ_AA3A933455BCC5E5 (tmdb_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(40) NOT NULL, first_name VARCHAR(40) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT FK_F0E45BA9D94388BD FOREIGN KEY (serie_id) REFERENCES serie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season DROP FOREIGN KEY FK_F0E45BA9D94388BD');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE serie');
        $this->addSql('DROP TABLE user');
    }
}
