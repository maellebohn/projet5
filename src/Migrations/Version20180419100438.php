<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180419100438 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE birds (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', name VARCHAR(50) NOT NULL, birthdate DATETIME NOT NULL, description LONGTEXT NOT NULL, price NUMERIC(10, 2) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', content LONGTEXT NOT NULL, title VARCHAR(200) NOT NULL, date_creation DATETIME NOT NULL, image INT DEFAULT NULL, author_FK CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_1DD399504FB8F62F (author_FK), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', firstname VARCHAR(50) NOT NULL, lastname VARCHAR(50) NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, role VARCHAR(50) NOT NULL, date_creation DATETIME NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE infos (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', content LONGTEXT NOT NULL, title VARCHAR(200) NOT NULL, date_creation DATETIME NOT NULL, date_modification DATETIME DEFAULT NULL, image INT DEFAULT NULL, author_FK CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', INDEX IDX_EECA826D4FB8F62F (author_FK), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE news ADD CONSTRAINT FK_1DD399504FB8F62F FOREIGN KEY (author_FK) REFERENCES users (id)');
        $this->addSql('ALTER TABLE infos ADD CONSTRAINT FK_EECA826D4FB8F62F FOREIGN KEY (author_FK) REFERENCES users (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE news DROP FOREIGN KEY FK_1DD399504FB8F62F');
        $this->addSql('ALTER TABLE infos DROP FOREIGN KEY FK_EECA826D4FB8F62F');
        $this->addSql('DROP TABLE birds');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE infos');
    }
}
