<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216161128 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE responsabilities CHANGE person_id person_id INT NOT NULL, CHANGE social_contract_id social_contract_id INT NOT NULL');
        $this->addSql('ALTER TABLE social_contracts CHANGE company_id company_id INT DEFAULT NULL, CHANGE user_id user_id BIGINT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE responsabilities CHANGE person_id person_id INT DEFAULT NULL, CHANGE social_contract_id social_contract_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE social_contracts CHANGE company_id company_id INT NOT NULL, CHANGE user_id user_id BIGINT NOT NULL');
    }
}
