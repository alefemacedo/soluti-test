<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200215222219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE social_contracts ADD user_id BIGINT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_contracts ADD CONSTRAINT FK_3B06F404A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_3B06F404A76ED395 ON social_contracts (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE social_contracts DROP FOREIGN KEY FK_3B06F404A76ED395');
        $this->addSql('DROP INDEX IDX_3B06F404A76ED395 ON social_contracts');
        $this->addSql('ALTER TABLE social_contracts DROP user_id');
    }
}
