<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211124191423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement (id INT AUTO_INCREMENT NOT NULL, nb_chambres INT NOT NULL, nb_personnes INT NOT NULL, avec_piscine TINYINT(1) NOT NULL, avec_parking TINYINT(1) NOT NULL, avec_plage TINYINT(1) NOT NULL, adresse VARCHAR(200) NOT NULL, numero_etage INT NOT NULL, avec_ascenseur TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, nb_chambres INT NOT NULL, nb_personnes INT NOT NULL, avec_piscine TINYINT(1) NOT NULL, avec_parking TINYINT(1) NOT NULL, avec_plage TINYINT(1) NOT NULL, adresse VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hotel (id INT AUTO_INCREMENT NOT NULL, nb_chambres INT NOT NULL, nb_personnes INT NOT NULL, avec_piscine TINYINT(1) NOT NULL, avec_parking TINYINT(1) NOT NULL, avec_plage TINYINT(1) NOT NULL, adresse VARCHAR(200) NOT NULL, nb_etoiles INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison (id INT AUTO_INCREMENT NOT NULL, nb_chambres INT NOT NULL, nb_personnes INT NOT NULL, avec_piscine TINYINT(1) NOT NULL, avec_parking TINYINT(1) NOT NULL, avec_plage TINYINT(1) NOT NULL, adresse VARCHAR(200) NOT NULL, surface_jardin DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maison_hote (id INT AUTO_INCREMENT NOT NULL, nb_chambres INT NOT NULL, nb_personnes INT NOT NULL, avec_piscine TINYINT(1) NOT NULL, avec_parking TINYINT(1) NOT NULL, avec_plage TINYINT(1) NOT NULL, adresse VARCHAR(200) NOT NULL, avec_petit_dej_inclus TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT DEFAULT 2 NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT 2 NOT NULL, reservation_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, cin VARCHAR(8) NOT NULL, passeport VARCHAR(6) NOT NULL, login VARCHAR(180) NOT NULL, mdp VARCHAR(200) NOT NULL, photo VARCHAR(200) DEFAULT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B3AA08CB10 (login), INDEX IDX_1D1C63B3D60322AC (role_id), INDEX IDX_1D1C63B3B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (immatricule INT AUTO_INCREMENT NOT NULL, constructeur VARCHAR(100) NOT NULL, marque VARCHAR(100) NOT NULL, etat INT NOT NULL, PRIMARY KEY(immatricule)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE offre ADD partenariat_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offre ADD CONSTRAINT FK_AF86866F5C1628E0 FOREIGN KEY (partenariat_id) REFERENCES partenariat (id)');
        $this->addSql('CREATE INDEX IDX_AF86866F5C1628E0 ON offre (partenariat_id)');
        $this->addSql('DROP INDEX UNIQ_42C84955F520CF5A ON reservation');
        $this->addSql('ALTER TABLE reservation ADD title VARCHAR(255) NOT NULL, ADD idr INT NOT NULL, ADD objet VARCHAR(255) NOT NULL, ADD user VARCHAR(255) NOT NULL, ADD discription VARCHAR(255) DEFAULT NULL, DROP objet_id, CHANGE contratdebut contratdebut DATE NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE maison_hote');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('ALTER TABLE offre DROP FOREIGN KEY FK_AF86866F5C1628E0');
        $this->addSql('DROP INDEX IDX_AF86866F5C1628E0 ON offre');
        $this->addSql('ALTER TABLE offre DROP partenariat_id');
        $this->addSql('ALTER TABLE reservation ADD objet_id INT DEFAULT NULL, DROP title, DROP idr, DROP objet, DROP user, DROP discription, CHANGE contratdebut contratdebut VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955F520CF5A ON reservation (objet_id)');
    }
}
