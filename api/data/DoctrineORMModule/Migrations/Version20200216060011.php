<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200216060011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE responsabilities (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, social_contract_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_F215258B217BBB47 (person_id), INDEX IDX_F215258B50D210D3 (social_contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE responsabilities ADD CONSTRAINT FK_F215258B217BBB47 FOREIGN KEY (person_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsabilities ADD CONSTRAINT FK_F215258B50D210D3 FOREIGN KEY (social_contract_id) REFERENCES social_contracts (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE responsability');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE responsability (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, social_contract_id INT DEFAULT NULL, type VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_unicode_ci`, INDEX IDX_5AA1C46F50D210D3 (social_contract_id), INDEX IDX_5AA1C46F217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F217BBB47 FOREIGN KEY (person_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F50D210D3 FOREIGN KEY (social_contract_id) REFERENCES social_contracts (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE responsabilities');
    }
}
