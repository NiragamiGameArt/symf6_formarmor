<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511164940 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69C9D95AF');
        $this->addSql('DROP INDEX IDX_5E90F6D69C9D95AF ON inscription');
        $this->addSql('ALTER TABLE inscription CHANGE session_formation_id session_formation INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D63A264B5 FOREIGN KEY (session_formation) REFERENCES session_formation (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D63A264B5 ON inscription (session_formation)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D63A264B5');
        $this->addSql('DROP INDEX IDX_5E90F6D63A264B5 ON inscription');
        $this->addSql('ALTER TABLE inscription CHANGE session_formation session_formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69C9D95AF FOREIGN KEY (session_formation_id) REFERENCES session_formation (id)');
        $this->addSql('CREATE INDEX IDX_5E90F6D69C9D95AF ON inscription (session_formation_id)');
    }
}
