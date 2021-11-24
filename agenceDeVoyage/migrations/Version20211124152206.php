<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124152206 extends AbstractMigration
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
        $this->addSql('ALTER TABLE objet ADD objet_id INT NOT NULL');
        $this->addSql('ALTER TABLE objet ADD CONSTRAINT FK_46CD4C38F520CF5A FOREIGN KEY (objet_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_46CD4C38F520CF5A ON objet (objet_id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F520CF5A');
        $this->addSql('DROP INDEX UNIQ_42C84955F520CF5A ON reservation');
        $this->addSql('ALTER TABLE reservation ADD title VARCHAR(255) NOT NULL, ADD contratdebut DATE NOT NULL, DROP objet_id');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT DEFAULT 2 NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD utilisateur_id INT DEFAULT NULL, ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3FB88E14F ON utilisateur (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE parking');
        $this->addSql('DROP TABLE partenariat');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE objet DROP FOREIGN KEY FK_46CD4C38F520CF5A');
        $this->addSql('DROP INDEX IDX_46CD4C38F520CF5A ON objet');
        $this->addSql('ALTER TABLE objet DROP objet_id');
        $this->addSql('ALTER TABLE reservation ADD objet_id INT DEFAULT NULL, DROP title, DROP contratdebut');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955F520CF5A ON reservation (objet_id)');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3FB88E14F');
        $this->addSql('DROP INDEX IDX_1D1C63B3FB88E14F ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP utilisateur_id, DROP is_verified');
    }
}
