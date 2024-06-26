<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240624112441 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__member AS SELECT id, full_name, fonction, date_joined, description, social_link_one, social_link_two, social_link_three, image_url FROM member');
        $this->addSql('DROP TABLE member');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, date_joined DATETIME DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, social_link_one VARCHAR(255) DEFAULT NULL, social_link_two VARCHAR(255) DEFAULT NULL, social_link_three VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO member (id, full_name, fonction, date_joined, description, social_link_one, social_link_two, social_link_three, image_url) SELECT id, full_name, fonction, date_joined, description, social_link_one, social_link_two, social_link_three, image_url FROM __temp__member');
        $this->addSql('DROP TABLE __temp__member');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__member AS SELECT id, full_name, fonction, description, social_link_one, social_link_two, social_link_three, image_url, date_joined FROM member');
        $this->addSql('DROP TABLE member');
        $this->addSql('CREATE TABLE member (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, fonction VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, social_link_one VARCHAR(255) DEFAULT NULL, social_link_two VARCHAR(255) DEFAULT NULL, social_link_three VARCHAR(255) DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, date_joined DATE DEFAULT NULL --(DC2Type:date_immutable)
        )');
        $this->addSql('INSERT INTO member (id, full_name, fonction, description, social_link_one, social_link_two, social_link_three, image_url, date_joined) SELECT id, full_name, fonction, description, social_link_one, social_link_two, social_link_three, image_url, date_joined FROM __temp__member');
        $this->addSql('DROP TABLE __temp__member');
    }
}
