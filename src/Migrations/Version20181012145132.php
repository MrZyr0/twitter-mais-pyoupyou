<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181012145132 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pyoupyou ADD project_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE pyoupyou ADD CONSTRAINT FK_8A0708A9166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_8A0708A9166D1F9C ON pyoupyou (project_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE pyoupyou DROP FOREIGN KEY FK_8A0708A9166D1F9C');
        $this->addSql('DROP INDEX IDX_8A0708A9166D1F9C ON pyoupyou');
        $this->addSql('ALTER TABLE pyoupyou DROP project_id');
    }
}
