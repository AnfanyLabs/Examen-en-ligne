<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250516171837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE classe DROP niveau
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP CONSTRAINT fk_1d1c63b3f6b192e
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX idx_1d1c63b3f6b192e
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur RENAME COLUMN id_classe_id TO classe_id
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
            ALTER TABLE classe ADD niveau VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP CONSTRAINT FK_1D1C63B38F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_1D1C63B38F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur RENAME COLUMN classe_id TO id_classe_id
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT fk_1d1c63b3f6b192e FOREIGN KEY (id_classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX idx_1d1c63b3f6b192e ON utilisateur (id_classe_id)
        SQL);
    }
}
