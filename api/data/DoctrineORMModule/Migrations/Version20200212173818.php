<?php

declare(strict_types=1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200212173818 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE responsability (id INT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, social_contract_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_5AA1C46F217BBB47 (person_id), INDEX IDX_5AA1C46F50D210D3 (social_contract_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE social_contract (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, file_path VARCHAR(600) NOT NULL, validated TINYINT(1) DEFAULT \'0\' NOT NULL, UNIQUE INDEX UNIQ_67BEBC75979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, cnpj VARCHAR(11) NOT NULL, corporate_name VARCHAR(255) NOT NULL, fancy_name VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094FC8C6906B (cnpj), UNIQUE INDEX UNIQ_4FBF094F5915169C (corporate_name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE people (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, cpf VARCHAR(11) NOT NULL, UNIQUE INDEX UNIQ_28166A263E3E11F0 (cpf), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id BIGINT AUTO_INCREMENT NOT NULL, person_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), UNIQUE INDEX UNIQ_1483A5E9217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AccessToken_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, client_id BIGINT NOT NULL, user_id BIGINT DEFAULT NULL, accessToken LONGTEXT DEFAULT NULL, expires DATETIME DEFAULT NULL, INDEX IDX_C092BBF419EB6921 (client_id), INDEX IDX_C092BBF4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AuthorizationCode_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, client_id BIGINT NOT NULL, user_id BIGINT DEFAULT NULL, authorizationCode VARCHAR(255) DEFAULT NULL, redirectUri LONGTEXT DEFAULT NULL, expires DATETIME DEFAULT NULL, idToken LONGTEXT DEFAULT NULL, INDEX IDX_7DED2FDD19EB6921 (client_id), INDEX IDX_7DED2FDDA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Client_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, user_id BIGINT DEFAULT NULL, clientId VARCHAR(191) DEFAULT NULL, secret VARCHAR(255) DEFAULT NULL, redirectUri LONGTEXT DEFAULT NULL, grantType LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_A66D48A8A76ED395 (user_id), UNIQUE INDEX UNIQ_A66D48A8EA1CE9BE (clientId), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Jti_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, client_id BIGINT NOT NULL, subject VARCHAR(255) DEFAULT NULL, audience VARCHAR(255) DEFAULT NULL, expires DATETIME DEFAULT NULL, jti LONGTEXT DEFAULT NULL, INDEX IDX_2C13A64519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Jwt_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, client_id BIGINT NOT NULL, subject VARCHAR(255) DEFAULT NULL, publicKey LONGTEXT DEFAULT NULL, INDEX IDX_F220BE7A19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE PublicKey_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, client_id BIGINT NOT NULL, publicKey LONGTEXT DEFAULT NULL, privateKey LONGTEXT DEFAULT NULL, encryptionAlgorithm VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_7355AB8319EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RefreshToken_OAuth2 (id BIGINT AUTO_INCREMENT NOT NULL, client_id BIGINT NOT NULL, user_id BIGINT DEFAULT NULL, refreshToken VARCHAR(255) DEFAULT NULL, expires DATETIME DEFAULT NULL, INDEX IDX_EEBE59C919EB6921 (client_id), INDEX IDX_EEBE59C9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Scope_OAuth2 (id BIGINT NOT NULL, scope VARCHAR(191) NOT NULL, isDefault TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_95A8FC4EAF55D3 (scope), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ClientToScope_OAuth2 (scope_id BIGINT NOT NULL, client_id BIGINT NOT NULL, INDEX IDX_EAF8221A682B5931 (scope_id), INDEX IDX_EAF8221A19EB6921 (client_id), PRIMARY KEY(scope_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AuthorizationCodeToScope_OAuth2 (scope_id BIGINT NOT NULL, authorization_code_id BIGINT NOT NULL, INDEX IDX_1EA6C7E682B5931 (scope_id), INDEX IDX_1EA6C7E847B7245 (authorization_code_id), PRIMARY KEY(scope_id, authorization_code_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE RefreshTokenToScope_OAuth2 (scope_id BIGINT NOT NULL, refresh_token_id BIGINT NOT NULL, INDEX IDX_9F46C12E682B5931 (scope_id), INDEX IDX_9F46C12EF765F60E (refresh_token_id), PRIMARY KEY(scope_id, refresh_token_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE AccessTokenToScope_OAuth2 (scope_id BIGINT NOT NULL, access_token_id BIGINT NOT NULL, INDEX IDX_49A2A53D682B5931 (scope_id), INDEX IDX_49A2A53D2CCB2688 (access_token_id), PRIMARY KEY(scope_id, access_token_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F217BBB47 FOREIGN KEY (person_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE responsability ADD CONSTRAINT FK_5AA1C46F50D210D3 FOREIGN KEY (social_contract_id) REFERENCES social_contract (id)');
        $this->addSql('ALTER TABLE social_contract ADD CONSTRAINT FK_67BEBC75979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9217BBB47 FOREIGN KEY (person_id) REFERENCES people (id)');
        $this->addSql('ALTER TABLE AccessToken_OAuth2 ADD CONSTRAINT FK_C092BBF419EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AccessToken_OAuth2 ADD CONSTRAINT FK_C092BBF4A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AuthorizationCode_OAuth2 ADD CONSTRAINT FK_7DED2FDD19EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AuthorizationCode_OAuth2 ADD CONSTRAINT FK_7DED2FDDA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Client_OAuth2 ADD CONSTRAINT FK_A66D48A8A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Jti_OAuth2 ADD CONSTRAINT FK_2C13A64519EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE Jwt_OAuth2 ADD CONSTRAINT FK_F220BE7A19EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE PublicKey_OAuth2 ADD CONSTRAINT FK_7355AB8319EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RefreshToken_OAuth2 ADD CONSTRAINT FK_EEBE59C919EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RefreshToken_OAuth2 ADD CONSTRAINT FK_EEBE59C9A76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ClientToScope_OAuth2 ADD CONSTRAINT FK_EAF8221A682B5931 FOREIGN KEY (scope_id) REFERENCES Scope_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ClientToScope_OAuth2 ADD CONSTRAINT FK_EAF8221A19EB6921 FOREIGN KEY (client_id) REFERENCES Client_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AuthorizationCodeToScope_OAuth2 ADD CONSTRAINT FK_1EA6C7E682B5931 FOREIGN KEY (scope_id) REFERENCES Scope_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AuthorizationCodeToScope_OAuth2 ADD CONSTRAINT FK_1EA6C7E847B7245 FOREIGN KEY (authorization_code_id) REFERENCES AuthorizationCode_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RefreshTokenToScope_OAuth2 ADD CONSTRAINT FK_9F46C12E682B5931 FOREIGN KEY (scope_id) REFERENCES Scope_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE RefreshTokenToScope_OAuth2 ADD CONSTRAINT FK_9F46C12EF765F60E FOREIGN KEY (refresh_token_id) REFERENCES RefreshToken_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AccessTokenToScope_OAuth2 ADD CONSTRAINT FK_49A2A53D682B5931 FOREIGN KEY (scope_id) REFERENCES Scope_OAuth2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE AccessTokenToScope_OAuth2 ADD CONSTRAINT FK_49A2A53D2CCB2688 FOREIGN KEY (access_token_id) REFERENCES AccessToken_OAuth2 (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE responsability DROP FOREIGN KEY FK_5AA1C46F50D210D3');
        $this->addSql('ALTER TABLE social_contract DROP FOREIGN KEY FK_67BEBC75979B1AD6');
        $this->addSql('ALTER TABLE responsability DROP FOREIGN KEY FK_5AA1C46F217BBB47');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9217BBB47');
        $this->addSql('ALTER TABLE AccessToken_OAuth2 DROP FOREIGN KEY FK_C092BBF4A76ED395');
        $this->addSql('ALTER TABLE AuthorizationCode_OAuth2 DROP FOREIGN KEY FK_7DED2FDDA76ED395');
        $this->addSql('ALTER TABLE Client_OAuth2 DROP FOREIGN KEY FK_A66D48A8A76ED395');
        $this->addSql('ALTER TABLE RefreshToken_OAuth2 DROP FOREIGN KEY FK_EEBE59C9A76ED395');
        $this->addSql('ALTER TABLE AccessTokenToScope_OAuth2 DROP FOREIGN KEY FK_49A2A53D2CCB2688');
        $this->addSql('ALTER TABLE AuthorizationCodeToScope_OAuth2 DROP FOREIGN KEY FK_1EA6C7E847B7245');
        $this->addSql('ALTER TABLE AccessToken_OAuth2 DROP FOREIGN KEY FK_C092BBF419EB6921');
        $this->addSql('ALTER TABLE AuthorizationCode_OAuth2 DROP FOREIGN KEY FK_7DED2FDD19EB6921');
        $this->addSql('ALTER TABLE Jti_OAuth2 DROP FOREIGN KEY FK_2C13A64519EB6921');
        $this->addSql('ALTER TABLE Jwt_OAuth2 DROP FOREIGN KEY FK_F220BE7A19EB6921');
        $this->addSql('ALTER TABLE PublicKey_OAuth2 DROP FOREIGN KEY FK_7355AB8319EB6921');
        $this->addSql('ALTER TABLE RefreshToken_OAuth2 DROP FOREIGN KEY FK_EEBE59C919EB6921');
        $this->addSql('ALTER TABLE ClientToScope_OAuth2 DROP FOREIGN KEY FK_EAF8221A19EB6921');
        $this->addSql('ALTER TABLE RefreshTokenToScope_OAuth2 DROP FOREIGN KEY FK_9F46C12EF765F60E');
        $this->addSql('ALTER TABLE ClientToScope_OAuth2 DROP FOREIGN KEY FK_EAF8221A682B5931');
        $this->addSql('ALTER TABLE AuthorizationCodeToScope_OAuth2 DROP FOREIGN KEY FK_1EA6C7E682B5931');
        $this->addSql('ALTER TABLE RefreshTokenToScope_OAuth2 DROP FOREIGN KEY FK_9F46C12E682B5931');
        $this->addSql('ALTER TABLE AccessTokenToScope_OAuth2 DROP FOREIGN KEY FK_49A2A53D682B5931');
        $this->addSql('DROP TABLE responsability');
        $this->addSql('DROP TABLE social_contract');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE people');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE AccessToken_OAuth2');
        $this->addSql('DROP TABLE AuthorizationCode_OAuth2');
        $this->addSql('DROP TABLE Client_OAuth2');
        $this->addSql('DROP TABLE Jti_OAuth2');
        $this->addSql('DROP TABLE Jwt_OAuth2');
        $this->addSql('DROP TABLE PublicKey_OAuth2');
        $this->addSql('DROP TABLE RefreshToken_OAuth2');
        $this->addSql('DROP TABLE Scope_OAuth2');
        $this->addSql('DROP TABLE ClientToScope_OAuth2');
        $this->addSql('DROP TABLE AuthorizationCodeToScope_OAuth2');
        $this->addSql('DROP TABLE RefreshTokenToScope_OAuth2');
        $this->addSql('DROP TABLE AccessTokenToScope_OAuth2');
    }
}
