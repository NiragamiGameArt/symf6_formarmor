<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511170704 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D69C9D95AF');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D619EB6921');
        $this->addSql('DROP TABLE inscription');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, session_formation_id INT NOT NULL, date_inscription DATE NOT NULL, validee TINYINT(1) NOT NULL, INDEX IDX_5E90F6D69C9D95AF (session_formation_id), INDEX IDX_5E90F6D619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D69C9D95AF FOREIGN KEY (session_formation_id) REFERENCES session_formation (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }
}
