<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322064326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE test (id INT AUTO_INCREMENT NOT NULL, business_account VARCHAR(50) NOT NULL, event_account VARCHAR(50) NOT NULL, event_account_last VARCHAR(50) NOT NULL, sheet_number VARCHAR(255) NOT NULL, civil_code VARCHAR(10) DEFAULT NULL, actual_owner VARCHAR(50) DEFAULT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) DEFAULT NULL, street VARCHAR(50) NOT NULL, adress_supplement VARCHAR(50) DEFAULT NULL, postal_code VARCHAR(10) NOT NULL, city VARCHAR(50) NOT NULL, home_phone VARCHAR(50) DEFAULT NULL, mobile_phone VARCHAR(50) DEFAULT NULL, job_phone VARCHAR(50) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, release_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivery_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_event_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', brand_name VARCHAR(25) NOT NULL, model VARCHAR(25) DEFAULT NULL, version VARCHAR(50) DEFAULT NULL, vin VARCHAR(50) NOT NULL, registration VARCHAR(50) DEFAULT NULL, prospect_type VARCHAR(25) NOT NULL, mileage VARCHAR(255) DEFAULT NULL, energy VARCHAR(25) DEFAULT NULL, seller_vn VARCHAR(50) DEFAULT NULL, seller_vo VARCHAR(50) DEFAULT NULL, billing_comment VARCHAR(50) DEFAULT NULL, type VARCHAR(5) DEFAULT NULL, folder_number VARCHAR(255) DEFAULT NULL, sales_intermediary_vn VARCHAR(255) DEFAULT NULL, event_date DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', event_origin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE test');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
