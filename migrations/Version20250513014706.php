<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250513014706 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE classe (id SERIAL NOT NULL, niveau VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE copie (id SERIAL NOT NULL, id_examen_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, contenu TEXT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A6E330BC85FDD9BD ON copie (id_examen_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_A6E330BCC6EE5C49 ON copie (id_utilisateur_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE epreuve (id SERIAL NOT NULL, nom VARCHAR(255) NOT NULL, coefficient INT NOT NULL, date_epreuve DATE NOT NULL, heure_debut TIME(0) WITHOUT TIME ZONE NOT NULL, duree_epreuve INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE examen (id SERIAL NOT NULL, classe_id INT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_514C8FEC8F5EA509 ON examen (classe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE question (id SERIAL NOT NULL, epreuve_id INT NOT NULL, titre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, points INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_B6F7494EAB990336 ON question (epreuve_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id SERIAL NOT NULL, id_classe_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_1D1C63B3F6B192E ON utilisateur (id_classe_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON utilisateur (email)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.created_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.available_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            COMMENT ON COLUMN messenger_messages.delivered_at IS '(DC2Type:datetime_immutable)'
        SQL);
        $this->addSql(<<<'SQL'
            CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
                BEGIN
                    PERFORM pg_notify('messenger_messages', NEW.queue_name::text);
                    RETURN NEW;
                END;
            $$ LANGUAGE plpgsql;
        SQL);
        $this->addSql(<<<'SQL'
            DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie ADD CONSTRAINT FK_A6E330BC85FDD9BD FOREIGN KEY (id_examen_id) REFERENCES examen (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie ADD CONSTRAINT FK_A6E330BCC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT FK_B6F7494EAB990336 FOREIGN KEY (epreuve_id) REFERENCES epreuve (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie DROP CONSTRAINT FK_A6E330BC85FDD9BD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie DROP CONSTRAINT FK_A6E330BCC6EE5C49
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE examen DROP CONSTRAINT FK_514C8FEC8F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP CONSTRAINT FK_B6F7494EAB990336
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP CONSTRAINT FK_1D1C63B3F6B192E
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE classe
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE copie
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE epreuve
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE examen
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE question
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
