<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231013125731 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE personas (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, nombres VARCHAR(255) NOT NULL, apellidos VARCHAR(255) NOT NULL, elegir_menu VARCHAR(255) NOT NULL, evento VARCHAR(255) NOT NULL, otro LONGTEXT NOT NULL, INDEX IDX_7C8260719D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personas ADD CONSTRAINT FK_7C8260719D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personas DROP FOREIGN KEY FK_7C8260719D86650F');
        $this->addSql('DROP TABLE personas');
    }
}
