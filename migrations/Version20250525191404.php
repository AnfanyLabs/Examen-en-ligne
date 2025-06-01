<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250525191404 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE classe (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE copie (id INT AUTO_INCREMENT NOT NULL, id_examen_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_A6E330BC85FDD9BD (id_examen_id), INDEX IDX_A6E330BCC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE epreuve (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, coefficient INT NOT NULL, date_epreuve DATE NOT NULL, heure_debut TIME NOT NULL, duree_epreuve INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE examen (id INT AUTO_INCREMENT NOT NULL, classe_id INT NOT NULL, titre VARCHAR(255) NOT NULL, INDEX IDX_514C8FEC8F5EA509 (classe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, epreuve_id INT NOT NULL, titre VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, contenu VARCHAR(255) NOT NULL, points INT NOT NULL, INDEX IDX_B6F7494EAB990336 (epreuve_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, classe_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:json)', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, statut TINYINT(1) DEFAULT 0 NOT NULL, INDEX IDX_1D1C63B38F5EA509 (classe_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie ADD CONSTRAINT FK_A6E330BC85FDD9BD FOREIGN KEY (id_examen_id) REFERENCES examen (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie ADD CONSTRAINT FK_A6E330BCC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE examen ADD CONSTRAINT FK_514C8FEC8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question ADD CONSTRAINT FK_B6F7494EAB990336 FOREIGN KEY (epreuve_id) REFERENCES epreuve (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B38F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE copie DROP FOREIGN KEY FK_A6E330BC85FDD9BD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE copie DROP FOREIGN KEY FK_A6E330BCC6EE5C49
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE examen DROP FOREIGN KEY FK_514C8FEC8F5EA509
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE question DROP FOREIGN KEY FK_B6F7494EAB990336
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B38F5EA509
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
