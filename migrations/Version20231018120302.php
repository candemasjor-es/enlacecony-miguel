<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231018120302 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personas_pequenos DROP FOREIGN KEY FK_FEF22EB99D86650F');
        $this->addSql('ALTER TABLE personas_pequenos ADD tronas VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX idx_fef22eb99d86650f ON personas_pequenos');
        $this->addSql('CREATE INDEX IDX_FEF22EB9A76ED395 ON personas_pequenos (user_id)');
        $this->addSql('ALTER TABLE personas_pequenos ADD CONSTRAINT FK_FEF22EB99D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE personas_pequenos DROP FOREIGN KEY FK_FEF22EB9A76ED395');
        $this->addSql('ALTER TABLE personas_pequenos DROP tronas');
        $this->addSql('DROP INDEX idx_fef22eb9a76ed395 ON personas_pequenos');
        $this->addSql('CREATE INDEX IDX_FEF22EB99D86650F ON personas_pequenos (user_id)');
        $this->addSql('ALTER TABLE personas_pequenos ADD CONSTRAINT FK_FEF22EB9A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
    }
}
