<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240325114020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098486F9AC');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09E7A1254A');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP INDEX UNIQ_81398E098486F9AC ON customer');
        $this->addSql('DROP INDEX UNIQ_81398E09E7A1254A ON customer');
        $this->addSql('ALTER TABLE customer ADD street VARCHAR(50) DEFAULT NULL, ADD adress_complement VARCHAR(50) DEFAULT NULL, ADD postal_code VARCHAR(10) NOT NULL, ADD city VARCHAR(50) NOT NULL, ADD home_phone VARCHAR(50) DEFAULT NULL, ADD mobile_phone VARCHAR(50) DEFAULT NULL, ADD job_phone VARCHAR(50) DEFAULT NULL, ADD email VARCHAR(50) DEFAULT NULL, DROP adress_id, DROP contact_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, adress_complement VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, postal_code VARCHAR(10) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, city VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, home_phone VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, mobile_phone VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, job_phone VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, email VARCHAR(50) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE customer ADD adress_id INT NOT NULL, ADD contact_id INT NOT NULL, DROP street, DROP adress_complement, DROP postal_code, DROP city, DROP home_phone, DROP mobile_phone, DROP job_phone, DROP email');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E098486F9AC ON customer (adress_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_81398E09E7A1254A ON customer (contact_id)');
    }
}
