<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118094322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access_fds (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, product_id INT NOT NULL, access_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1BC6BD70A76ED395 (user_id), INDEX IDX_1BC6BD704584665A (product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, user_id INT DEFAULT NULL, sended_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) DEFAULT NULL, message LONGTEXT DEFAULT NULL, INDEX IDX_BF5476CA93CB796C (file_id), INDEX IDX_BF5476CAA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, file_id INT DEFAULT NULL, product_name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, image_url VARCHAR(255) DEFAULT NULL, INDEX IDX_D34A04AD93CB796C (file_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD70A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD704584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD70A76ED395');
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD704584665A');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA93CB796C');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAA76ED395');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD93CB796C');
        $this->addSql('DROP TABLE access_fds');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE user');
    }
}
