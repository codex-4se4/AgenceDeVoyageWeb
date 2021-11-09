<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211102192621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appartement');
        $this->addSql('DROP TABLE chambre');
        $this->addSql('DROP TABLE hebergement');
        $this->addSql('DROP TABLE hotel');
        $this->addSql('DROP TABLE maison');
        $this->addSql('DROP TABLE maisonhote');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP INDEX id_role ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD role_id INT NOT NULL, DROP id_role');
        $this->addSql('CREATE INDEX IDX_1D1C63B3D60322AC ON utilisateur (role_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appartement (numeroEtage INT AUTO_INCREMENT NOT NULL, avecAscenceur TINYINT(1) NOT NULL, PRIMARY KEY(numeroEtage)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE chambre (id INT NOT NULL, typeChambre VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE hebergement (id INT AUTO_INCREMENT NOT NULL, nbChambres INT NOT NULL, nbPersonnes INT NOT NULL, avecPiscine TINYINT(1) NOT NULL, avecParking TINYINT(1) NOT NULL, avecPlage TINYINT(1) NOT NULL, adresse VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE hotel (nbEtoiles INT DEFAULT 1 NOT NULL, formule VARCHAR(255) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, PRIMARY KEY(nbEtoiles)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maison (surfaceJardin DOUBLE PRECISION NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE maisonhote (avecPetitDejInclus TINYINT(1) NOT NULL) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, dateDebut DATE NOT NULL, dateFin DATE NOT NULL, type VARCHAR(100) CHARACTER SET latin1 NOT NULL COLLATE `latin1_swedish_ci`, hebergement_id INT NOT NULL, utilisateur_id INT NOT NULL, INDEX fk_utilisateur_id (utilisateur_id), INDEX fk_reservation_id (hebergement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3D60322AC');
        $this->addSql('DROP INDEX IDX_1D1C63B3D60322AC ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur ADD id_role INT DEFAULT 2, DROP role_id');
        $this->addSql('CREATE INDEX id_role ON utilisateur (id_role)');
    }
}
