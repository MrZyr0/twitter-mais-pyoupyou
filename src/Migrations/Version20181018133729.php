<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181018133729 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friend ADD user_to_id INT DEFAULT NULL, ADD user_from_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61D2F7B13D FOREIGN KEY (user_to_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC6120C3C701 FOREIGN KEY (user_from_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_55EEAC61D2F7B13D ON friend (user_to_id)');
        $this->addSql('CREATE INDEX IDX_55EEAC6120C3C701 ON friend (user_from_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC61D2F7B13D');
        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC6120C3C701');
        $this->addSql('DROP INDEX IDX_55EEAC61D2F7B13D ON friend');
        $this->addSql('DROP INDEX IDX_55EEAC6120C3C701 ON friend');
        $this->addSql('ALTER TABLE friend DROP user_to_id, DROP user_from_id');
    }
}
