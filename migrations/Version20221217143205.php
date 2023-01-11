<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221217143205 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animaux (id INT AUTO_INCREMENT NOT NULL, enclos_id INT DEFAULT NULL, animaux VARCHAR(50) NOT NULL, nid BIGINT NOT NULL, arrive DATE NOT NULL, depart DATE DEFAULT NULL, proprietaire VARCHAR(10) NOT NULL, genre VARCHAR(255) NOT NULL, espece VARCHAR(255) NOT NULL, mf_nd VARCHAR(255) NOT NULL, sterilise VARCHAR(10) NOT NULL, quarantaine VARCHAR(10) NOT NULL, INDEX IDX_9ABE194DB1C0859 (enclos_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enclos (id INT AUTO_INCREMENT NOT NULL, espaces_id INT DEFAULT NULL, espace_in VARCHAR(255) NOT NULL, nom VARCHAR(50) NOT NULL, superficie BIGINT NOT NULL, max_animaux INT NOT NULL, quarantaines VARCHAR(10) NOT NULL, INDEX IDX_8CCECB21A3C3180A (espaces_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE espaces (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, superficie BIGINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animaux ADD CONSTRAINT FK_9ABE194DB1C0859 FOREIGN KEY (enclos_id) REFERENCES enclos (id)');
        $this->addSql('ALTER TABLE enclos ADD CONSTRAINT FK_8CCECB21A3C3180A FOREIGN KEY (espaces_id) REFERENCES espaces (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animaux DROP FOREIGN KEY FK_9ABE194DB1C0859');
        $this->addSql('ALTER TABLE enclos DROP FOREIGN KEY FK_8CCECB21A3C3180A');
        $this->addSql('DROP TABLE animaux');
        $this->addSql('DROP TABLE enclos');
        $this->addSql('DROP TABLE espaces');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
