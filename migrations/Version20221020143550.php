<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221020143550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_room (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, nbrstudent INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('ALTER TABLE club ADD adresse VARCHAR(100) NOT NULL');
        $this->addSql('DROP INDEX `primary` ON student');
        $this->addSql('ALTER TABLE student ADD nce VARCHAR(255) NOT NULL, ADD username VARCHAR(100) NOT NULL, DROP ncc, DROP name');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (nce)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE classroom (ud INT NOT NULL, name VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE class_room');
        $this->addSql('ALTER TABLE club DROP adresse');
        $this->addSql('DROP INDEX `PRIMARY` ON student');
        $this->addSql('ALTER TABLE student ADD name VARCHAR(255) NOT NULL, DROP username, CHANGE nce ncc VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE student ADD PRIMARY KEY (ncc)');
    }
}
