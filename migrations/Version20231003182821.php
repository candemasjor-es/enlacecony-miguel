<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231003182821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elegir_menu ADD user_id_id INT DEFAULT NULL, CHANGE name menu_name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE elegir_menu ADD CONSTRAINT FK_F3C31A489D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_F3C31A489D86650F ON elegir_menu (user_id_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649AA88706A');
        $this->addSql('DROP INDEX IDX_8D93D649AA88706A ON user');
        $this->addSql('ALTER TABLE user DROP elegir_menu_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elegir_menu DROP FOREIGN KEY FK_F3C31A489D86650F');
        $this->addSql('DROP INDEX IDX_F3C31A489D86650F ON elegir_menu');
        $this->addSql('ALTER TABLE elegir_menu DROP user_id_id, CHANGE menu_name name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE `user` ADD elegir_menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D649AA88706A FOREIGN KEY (elegir_menu_id) REFERENCES elegir_menu (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649AA88706A ON `user` (elegir_menu_id)');
    }
}
