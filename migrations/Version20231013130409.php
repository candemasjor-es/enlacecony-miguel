<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013130409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE elegir_menu DROP FOREIGN KEY FK_F3C31A489D86650F');
        $this->addSql('ALTER TABLE evento DROP FOREIGN KEY FK_47860B05875C3867');
        $this->addSql('DROP TABLE elegir_menu');
        $this->addSql('DROP TABLE evento');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE elegir_menu (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, menu_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, text LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_F3C31A489D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE evento (id INT AUTO_INCREMENT NOT NULL, user_id_evento_id INT DEFAULT NULL, eventos VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_47860B05875C3867 (user_id_evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE elegir_menu ADD CONSTRAINT FK_F3C31A489D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evento ADD CONSTRAINT FK_47860B05875C3867 FOREIGN KEY (user_id_evento_id) REFERENCES user (id)');
    }
}
