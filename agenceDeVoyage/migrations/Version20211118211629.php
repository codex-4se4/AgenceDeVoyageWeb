<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118211629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement ADD nb_chambres INT NOT NULL, ADD nb_personnes INT NOT NULL, ADD avec_piscine TINYINT(1) NOT NULL, ADD avec_parking TINYINT(1) NOT NULL, ADD avec_plage TINYINT(1) NOT NULL, ADD adresse VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE hotel ADD nb_chambres INT NOT NULL, ADD nb_personnes INT NOT NULL, ADD avec_piscine TINYINT(1) NOT NULL, ADD avec_parking TINYINT(1) NOT NULL, ADD avec_plage TINYINT(1) NOT NULL, ADD adresse VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE maison ADD nb_chambres INT NOT NULL, ADD nb_personnes INT NOT NULL, ADD avec_piscine TINYINT(1) NOT NULL, ADD avec_parking TINYINT(1) NOT NULL, ADD avec_plage TINYINT(1) NOT NULL, ADD adresse VARCHAR(200) NOT NULL');
        $this->addSql('ALTER TABLE maison_hote ADD nb_chambres INT NOT NULL, ADD nb_personnes INT NOT NULL, ADD avec_piscine TINYINT(1) NOT NULL, ADD avec_parking TINYINT(1) NOT NULL, ADD avec_plage TINYINT(1) NOT NULL, ADD adresse VARCHAR(200) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appartement DROP nb_chambres, DROP nb_personnes, DROP avec_piscine, DROP avec_parking, DROP avec_plage, DROP adresse');
        $this->addSql('ALTER TABLE hotel DROP nb_chambres, DROP nb_personnes, DROP avec_piscine, DROP avec_parking, DROP avec_plage, DROP adresse');
        $this->addSql('ALTER TABLE maison DROP nb_chambres, DROP nb_personnes, DROP avec_piscine, DROP avec_parking, DROP avec_plage, DROP adresse');
        $this->addSql('ALTER TABLE maison_hote DROP nb_chambres, DROP nb_personnes, DROP avec_piscine, DROP avec_parking, DROP avec_plage, DROP adresse');
    }
}
