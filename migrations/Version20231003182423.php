<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003182423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE elegir_menu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD elegir_menu_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649AA88706A FOREIGN KEY (elegir_menu_id) REFERENCES elegir_menu (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AA88706A ON user (elegir_menu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649AA88706A');
        $this->addSql('DROP TABLE elegir_menu');
        $this->addSql('DROP INDEX IDX_8D93D649AA88706A ON `user`');
        $this->addSql('ALTER TABLE `user` DROP elegir_menu_id, CHANGE roles roles JSON NOT NULL COMMENT \'(DC2Type:json)\'');
    }
}
