<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211119075907 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE parking (id INT AUTO_INCREMENT NOT NULL, date_sortie DATE NOT NULL, id_voiture INT NOT NULL, num_place INT NOT NULL, date_prevu_retour DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partenariat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (immatricule INT AUTO_INCREMENT NOT NULL, constructeur VARCHAR(100) NOT NULL, marque VARCHAR(100) NOT NULL, etat INT NOT NULL, PRIMARY KEY(immatricule)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD contratdebut DATE NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT DEFAULT 2 NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD reservation_id INT DEFAULT NULL, ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3B83297E7 ON utilisateur (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE parking');
        $this->addSql('DROP TABLE partenariat');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE reservation DROP contratdebut');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B83297E7');
        $this->addSql('DROP INDEX IDX_1D1C63B3B83297E7 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP reservation_id, DROP is_verified');
    }
}
