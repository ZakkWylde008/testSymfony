<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322141603 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adress (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(50) DEFAULT NULL, adress_complement VARCHAR(50) DEFAULT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(25) NOT NULL, model VARCHAR(25) DEFAULT NULL, version VARCHAR(255) DEFAULT NULL, vin VARCHAR(50) NOT NULL, registration VARCHAR(10) DEFAULT NULL, mileage VARCHAR(255) DEFAULT NULL, actual_owner VARCHAR(255) DEFAULT NULL, energy VARCHAR(25) DEFAULT NULL, event_origin VARCHAR(255) DEFAULT NULL, event_account VARCHAR(255) DEFAULT NULL, last_event_account VARCHAR(255) DEFAULT NULL, release_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_event_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', event_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, home_phone VARCHAR(50) DEFAULT NULL, mobile_phone VARCHAR(50) DEFAULT NULL, job_phone VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE create_invoice (id INT AUTO_INCREMENT NOT NULL, customer_id INT NOT NULL, seller_id INT DEFAULT NULL, car_id INT NOT NULL, business_account VARCHAR(255) NOT NULL, file_number VARCHAR(255) NOT NULL, prospect_type VARCHAR(25) NOT NULL, invoice_comment VARCHAR(255) DEFAULT NULL, delivery_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_B25D80439395C3F3 (customer_id), INDEX IDX_B25D80438DE820D9 (seller_id), INDEX IDX_B25D8043C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, adress_id INT NOT NULL, contact_id INT NOT NULL, civil_code VARCHAR(5) DEFAULT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) DEFAULT NULL, UNIQUE INDEX UNIQ_81398E098486F9AC (adress_id), UNIQUE INDEX UNIQ_81398E09E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seller (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(5) DEFAULT NULL, vn VARCHAR(255) DEFAULT NULL, vo VARCHAR(255) DEFAULT NULL, folder_number_vnvo VARCHAR(255) DEFAULT NULL, sales_intermediary_vn VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE create_invoice ADD CONSTRAINT FK_B25D80439395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE create_invoice ADD CONSTRAINT FK_B25D80438DE820D9 FOREIGN KEY (seller_id) REFERENCES seller (id)');
        $this->addSql('ALTER TABLE create_invoice ADD CONSTRAINT FK_B25D8043C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098486F9AC FOREIGN KEY (adress_id) REFERENCES adress (id)');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E09E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE create_invoice DROP FOREIGN KEY FK_B25D80439395C3F3');
        $this->addSql('ALTER TABLE create_invoice DROP FOREIGN KEY FK_B25D80438DE820D9');
        $this->addSql('ALTER TABLE create_invoice DROP FOREIGN KEY FK_B25D8043C3C6F69F');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098486F9AC');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E09E7A1254A');
        $this->addSql('DROP TABLE adress');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE create_invoice');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE seller');
    }
}
