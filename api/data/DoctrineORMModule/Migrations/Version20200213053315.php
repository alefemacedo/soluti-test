<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200213053315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE responsability DROP FOREIGN KEY FK_5AA1C46F217BBB47');
        $this->addSql('ALTER TABLE responsability DROP FOREIGN KEY FK_5AA1C46F50D210D3');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F217BBB47 FOREIGN KEY (person_id) REFERENCES people (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F50D210D3 FOREIGN KEY (social_contract_id) REFERENCES social_contract (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE social_contract DROP FOREIGN KEY FK_67BEBC75979B1AD6');
        $this->addSql('ALTER TABLE social_contract ADD CONSTRAINT FK_67BEBC75979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9217BBB47');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9217BBB47 FOREIGN KEY (person_id) REFERENCES people (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE responsability DROP FOREIGN KEY FK_5AA1C46F217BBB47');
        $this->addSql('ALTER TABLE responsability DROP FOREIGN KEY FK_5AA1C46F50D210D3');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F217BBB47 FOREIGN KEY (person_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F50D210D3 FOREIGN KEY (social_contract_id) REFERENCES social_contract (id)');
        $this->addSql('ALTER TABLE social_contract DROP FOREIGN KEY FK_67BEBC75979B1AD6');
        $this->addSql('ALTER TABLE social_contract ADD CONSTRAINT FK_67BEBC75979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9217BBB47');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9217BBB47 FOREIGN KEY (person_id) REFERENCES people (id)');
    }
}
