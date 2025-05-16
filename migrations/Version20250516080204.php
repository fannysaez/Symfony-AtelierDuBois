<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250516080204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE custom_order ADD user_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE custom_order ADD CONSTRAINT FK_36246BF1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_36246BF1A76ED395 ON custom_order (user_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE custom_order DROP FOREIGN KEY FK_36246BF1A76ED395
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_36246BF1A76ED395 ON custom_order
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE custom_order DROP user_id
        SQL);
    }
}
