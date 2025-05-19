<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250516195630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP CONSTRAINT FK_1D1C63B38F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1D1C63B38F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur RENAME COLUMN classe TO classe_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1D1C63B38F5EA509 ON utilisateur (classe_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP CONSTRAINT fk_1d1c63b38f5ea509
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_1d1c63b38f5ea509
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur RENAME COLUMN classe_id TO classe
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT fk_1d1c63b38f5ea509 FOREIGN KEY (classe) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_1d1c63b38f5ea509 ON utilisateur (classe)
        SQL);
    }
}
