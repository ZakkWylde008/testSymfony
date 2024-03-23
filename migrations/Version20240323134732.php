<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240323134732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_account (id INT AUTO_INCREMENT NOT NULL, name_account VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_account (id INT AUTO_INCREMENT NOT NULL, name_account VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_origin (id INT AUTO_INCREMENT NOT NULL, event_origin VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prospect_type (id INT AUTO_INCREMENT NOT NULL, name_prospect VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD event_origin_id INT NOT NULL, ADD event_account_id INT NOT NULL, ADD last_event_account_id INT NOT NULL, DROP event_origin, DROP event_account, DROP last_event_account');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DD0374DF1 FOREIGN KEY (event_origin_id) REFERENCES event_origin (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DC3858695 FOREIGN KEY (event_account_id) REFERENCES event_account (id)');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DE5B60D79 FOREIGN KEY (last_event_account_id) REFERENCES event_account (id)');
        $this->addSql('CREATE INDEX IDX_773DE69DD0374DF1 ON car (event_origin_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DC3858695 ON car (event_account_id)');
        $this->addSql('CREATE INDEX IDX_773DE69DE5B60D79 ON car (last_event_account_id)');
        $this->addSql('ALTER TABLE create_invoice ADD business_account_id INT NOT NULL, ADD prospect_type_id INT NOT NULL, DROP business_account, DROP prospect_type');
        $this->addSql('ALTER TABLE create_invoice ADD CONSTRAINT FK_B25D80435BC85711 FOREIGN KEY (business_account_id) REFERENCES business_account (id)');
        $this->addSql('ALTER TABLE create_invoice ADD CONSTRAINT FK_B25D80436009C47 FOREIGN KEY (prospect_type_id) REFERENCES prospect_type (id)');
        $this->addSql('CREATE INDEX IDX_B25D80435BC85711 ON create_invoice (business_account_id)');
        $this->addSql('CREATE INDEX IDX_B25D80436009C47 ON create_invoice (prospect_type_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE create_invoice DROP FOREIGN KEY FK_B25D80435BC85711');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DC3858695');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DE5B60D79');
        $this->addSql('ALTER TABLE car DROP FOREIGN KEY FK_773DE69DD0374DF1');
        $this->addSql('ALTER TABLE create_invoice DROP FOREIGN KEY FK_B25D80436009C47');
        $this->addSql('DROP TABLE business_account');
        $this->addSql('DROP TABLE event_account');
        $this->addSql('DROP TABLE event_origin');
        $this->addSql('DROP TABLE prospect_type');
        $this->addSql('DROP INDEX IDX_773DE69DD0374DF1 ON car');
        $this->addSql('DROP INDEX IDX_773DE69DC3858695 ON car');
        $this->addSql('DROP INDEX IDX_773DE69DE5B60D79 ON car');
        $this->addSql('ALTER TABLE car ADD event_origin VARCHAR(255) DEFAULT NULL, ADD event_account VARCHAR(255) DEFAULT NULL, ADD last_event_account VARCHAR(255) DEFAULT NULL, DROP event_origin_id, DROP event_account_id, DROP last_event_account_id');
        $this->addSql('DROP INDEX IDX_B25D80435BC85711 ON create_invoice');
        $this->addSql('DROP INDEX IDX_B25D80436009C47 ON create_invoice');
        $this->addSql('ALTER TABLE create_invoice ADD business_account VARCHAR(255) NOT NULL, ADD prospect_type VARCHAR(25) NOT NULL, DROP business_account_id, DROP prospect_type_id');
    }
}
