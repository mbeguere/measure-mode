<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200513141329 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, dress_maker_id INT DEFAULT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, phone VARCHAR(20) DEFAULT NULL, discr VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), INDEX IDX_8D93D649F43EAE46 (dress_maker_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE measure (id INT AUTO_INCREMENT NOT NULL, datas LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer_measure (id INT AUTO_INCREMENT NOT NULL, model_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, measure_id INT DEFAULT NULL, INDEX IDX_9CDABD9B7975B7E7 (model_id), INDEX IDX_9CDABD9B9395C3F3 (customer_id), INDEX IDX_9CDABD9B5DA37D00 (measure_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649F43EAE46 FOREIGN KEY (dress_maker_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_measure ADD CONSTRAINT FK_9CDABD9B7975B7E7 FOREIGN KEY (model_id) REFERENCES model (id)');
        $this->addSql('ALTER TABLE customer_measure ADD CONSTRAINT FK_9CDABD9B9395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE customer_measure ADD CONSTRAINT FK_9CDABD9B5DA37D00 FOREIGN KEY (measure_id) REFERENCES measure (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649F43EAE46');
        $this->addSql('ALTER TABLE customer_measure DROP FOREIGN KEY FK_9CDABD9B9395C3F3');
        $this->addSql('ALTER TABLE customer_measure DROP FOREIGN KEY FK_9CDABD9B5DA37D00');
        $this->addSql('ALTER TABLE customer_measure DROP FOREIGN KEY FK_9CDABD9B7975B7E7');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE measure');
        $this->addSql('DROP TABLE model');
        $this->addSql('DROP TABLE customer_measure');
    }
}
