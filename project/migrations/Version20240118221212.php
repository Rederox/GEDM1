<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240118221212 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE3578F39');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAE3578F39');
        $this->addSql('DROP TABLE fds');
        $this->addSql('DROP INDEX IDX_BF5476CAE3578F39 ON notification');
        $this->addSql('ALTER TABLE notification CHANGE fds_id product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA4584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA4584665A ON notification (product_id)');
        $this->addSql('DROP INDEX IDX_D34A04ADE3578F39 ON product');
        $this->addSql('ALTER TABLE product ADD fds_name VARCHAR(255) DEFAULT NULL, DROP fds_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fds (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, url VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', edited_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE product ADD fds_id INT DEFAULT NULL, DROP fds_name');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE3578F39 FOREIGN KEY (fds_id) REFERENCES fds (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04ADE3578F39 ON product (fds_id)');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA4584665A');
        $this->addSql('DROP INDEX IDX_BF5476CA4584665A ON notification');
        $this->addSql('ALTER TABLE notification CHANGE product_id fds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAE3578F39 FOREIGN KEY (fds_id) REFERENCES fds (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BF5476CAE3578F39 ON notification (fds_id)');
    }
}
