<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181015084747 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE friends (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE incubator (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, is_public TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE project ADD incubator_id INT NOT NULL, ADD is_public TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE20802FC8 FOREIGN KEY (incubator_id) REFERENCES incubator (id)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE20802FC8 ON project (incubator_id)');
        $this->addSql('ALTER TABLE pyoupyou ADD incubator_id INT DEFAULT NULL, ADD is_public TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE pyoupyou ADD CONSTRAINT FK_8A0708A920802FC8 FOREIGN KEY (incubator_id) REFERENCES incubator (id)');
        $this->addSql('CREATE INDEX IDX_8A0708A920802FC8 ON pyoupyou (incubator_id)');
        $this->addSql('ALTER TABLE user ADD is_public TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE20802FC8');
        $this->addSql('ALTER TABLE pyoupyou DROP FOREIGN KEY FK_8A0708A920802FC8');
        $this->addSql('DROP TABLE friends');
        $this->addSql('DROP TABLE incubator');
        $this->addSql('DROP INDEX IDX_2FB3D0EE20802FC8 ON project');
        $this->addSql('ALTER TABLE project DROP incubator_id, DROP is_public');
        $this->addSql('DROP INDEX IDX_8A0708A920802FC8 ON pyoupyou');
        $this->addSql('ALTER TABLE pyoupyou DROP incubator_id, DROP is_public');
        $this->addSql('ALTER TABLE user DROP is_public');
    }
}
