<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118214943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation ADD objet_id INT DEFAULT NULL, DROP title, DROP discription, CHANGE contratdebut contratdebut VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955F520CF5A FOREIGN KEY (objet_id) REFERENCES objet (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955F520CF5A ON reservation (objet_id)');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT DEFAULT 2 NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD reservation_id INT DEFAULT NULL, ADD is_verified TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3B83297E7 ON utilisateur (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955F520CF5A');
        $this->addSql('DROP INDEX UNIQ_42C84955F520CF5A ON reservation');
        $this->addSql('ALTER TABLE reservation ADD title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD discription VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP objet_id, CHANGE contratdebut contratdebut DATE NOT NULL');
        $this->addSql('ALTER TABLE role CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3B83297E7');
        $this->addSql('DROP INDEX IDX_1D1C63B3B83297E7 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP reservation_id, DROP is_verified');
    }
}
