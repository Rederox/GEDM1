<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115213858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD709D86650F');
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD70DE18E50B');
        $this->addSql('DROP INDEX IDX_1BC6BD709D86650F ON access_fds');
        $this->addSql('DROP INDEX IDX_1BC6BD70DE18E50B ON access_fds');
        $this->addSql('ALTER TABLE access_fds ADD user_id INT NOT NULL, ADD product_id INT NOT NULL, DROP user_id_id, DROP product_id_id');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD70A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD704584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_1BC6BD70A76ED395 ON access_fds (user_id)');
        $this->addSql('CREATE INDEX IDX_1BC6BD704584665A ON access_fds (product_id)');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAD5C72E60');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA9D86650F');
        $this->addSql('DROP INDEX IDX_BF5476CAD5C72E60 ON notification');
        $this->addSql('DROP INDEX IDX_BF5476CA9D86650F ON notification');
        $this->addSql('ALTER TABLE notification ADD file_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, DROP file_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA93CB796C ON notification (file_id)');
        $this->addSql('CREATE INDEX IDX_BF5476CAA76ED395 ON notification (user_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADD5C72E60');
        $this->addSql('DROP INDEX IDX_D34A04ADD5C72E60 ON product');
        $this->addSql('ALTER TABLE product CHANGE file_id_id file_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD93CB796C FOREIGN KEY (file_id) REFERENCES file (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD93CB796C ON product (file_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD70A76ED395');
        $this->addSql('ALTER TABLE access_fds DROP FOREIGN KEY FK_1BC6BD704584665A');
        $this->addSql('DROP INDEX IDX_1BC6BD70A76ED395 ON access_fds');
        $this->addSql('DROP INDEX IDX_1BC6BD704584665A ON access_fds');
        $this->addSql('ALTER TABLE access_fds ADD user_id_id INT NOT NULL, ADD product_id_id INT NOT NULL, DROP user_id, DROP product_id');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD709D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE access_fds ADD CONSTRAINT FK_1BC6BD70DE18E50B FOREIGN KEY (product_id_id) REFERENCES product (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1BC6BD709D86650F ON access_fds (user_id_id)');
        $this->addSql('CREATE INDEX IDX_1BC6BD70DE18E50B ON access_fds (product_id_id)');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD93CB796C');
        $this->addSql('DROP INDEX IDX_D34A04AD93CB796C ON product');
        $this->addSql('ALTER TABLE product CHANGE file_id file_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADD5C72E60 FOREIGN KEY (file_id_id) REFERENCES file (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D34A04ADD5C72E60 ON product (file_id_id)');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA93CB796C');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CAA76ED395');
        $this->addSql('DROP INDEX IDX_BF5476CA93CB796C ON notification');
        $this->addSql('DROP INDEX IDX_BF5476CAA76ED395 ON notification');
        $this->addSql('ALTER TABLE notification ADD file_id_id INT DEFAULT NULL, ADD user_id_id INT DEFAULT NULL, DROP file_id, DROP user_id');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CAD5C72E60 FOREIGN KEY (file_id_id) REFERENCES file (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_BF5476CAD5C72E60 ON notification (file_id_id)');
        $this->addSql('CREATE INDEX IDX_BF5476CA9D86650F ON notification (user_id_id)');
    }
}
