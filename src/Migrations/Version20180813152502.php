<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180813152502 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE birds CHANGE birthdate birthdate INT NOT NULL, CHANGE price price INT NOT NULL');
        $this->addSql('ALTER TABLE news CHANGE date_creation date_creation INT NOT NULL, CHANGE image image VARCHAR(50) DEFAULT NULL, CHANGE author_FK author_FK CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE users ADD reset_password_token VARCHAR(10) DEFAULT NULL, CHANGE date_creation date_creation INT NOT NULL');
        $this->addSql('ALTER TABLE infos CHANGE date_modification date_modification DATETIME DEFAULT NULL, CHANGE image image VARCHAR(50) DEFAULT NULL, CHANGE author_FK author_FK CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE birds CHANGE birthdate birthdate DATETIME NOT NULL, CHANGE price price NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE infos CHANGE date_modification date_modification DATETIME DEFAULT \'NULL\', CHANGE image image VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE author_FK author_FK CHAR(36) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE news CHANGE date_creation date_creation DATETIME NOT NULL, CHANGE image image VARCHAR(50) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci, CHANGE author_FK author_FK CHAR(36) DEFAULT \'NULL\' COLLATE utf8mb4_unicode_ci COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE users DROP reset_password_token, CHANGE date_creation date_creation DATETIME NOT NULL');
    }
}
