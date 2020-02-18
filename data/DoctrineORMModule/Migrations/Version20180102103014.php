<?php declare(strict_types = 1);

namespace DoctrineORMModule\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180102103014 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, parent INT DEFAULT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_57698A6A3D8E604F (parent), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_role (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_3E13F07AD60322AC (role_id), INDEX IDX_3E13F07AA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(128) NOT NULL, display_name VARCHAR(100) DEFAULT NULL, ultimo_acesso DATETIME DEFAULT NULL, state INT DEFAULT 0 NOT NULL, email VARCHAR(255) DEFAULT NULL, INDEX idx_usuario_id (id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE financas_dizimo (id INT AUTO_INCREMENT NOT NULL, membro_id INT DEFAULT NULL, data DATETIME DEFAULT NULL, valor NUMERIC(10, 2) NOT NULL, INDEX IDX_1FCB0D95524172E (membro_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pessoa_membro (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) DEFAULT NULL, sexo VARCHAR(255) DEFAULT NULL, endereco VARCHAR(255) DEFAULT NULL, cep VARCHAR(255) DEFAULT NULL, telefone_residencial VARCHAR(255) DEFAULT NULL, telefone_comercial VARCHAR(255) DEFAULT NULL, telefone_celular VARCHAR(255) DEFAULT NULL, nome_pai VARCHAR(255) DEFAULT NULL, nome_mae VARCHAR(255) DEFAULT NULL, estado_civil VARCHAR(255) DEFAULT NULL, nome_conjuge VARCHAR(255) DEFAULT NULL, data_nascimento_conjuge DATE DEFAULT NULL, conjuge_evangelico INT DEFAULT NULL, conjuge_igreja INT DEFAULT NULL, filhos INT DEFAULT NULL, nome_filho1 VARCHAR(255) DEFAULT NULL, idade_filho1 INT DEFAULT NULL, nome_filho2 VARCHAR(255) DEFAULT NULL, idade_filho2 INT DEFAULT NULL, nome_filho3 VARCHAR(255) DEFAULT NULL, idade_filho3 INT DEFAULT NULL, data_batismo DATE DEFAULT NULL, data_nascimento DATE DEFAULT NULL, data_congregacao DATE DEFAULT NULL, cargo VARCHAR(50) DEFAULT NULL, envelope VARCHAR(3) DEFAULT NULL, categoria VARCHAR(3) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_jti (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, subject VARCHAR(255) DEFAULT NULL, audience VARCHAR(255) DEFAULT NULL, expires DATETIME DEFAULT NULL, jti LONGTEXT DEFAULT NULL, INDEX IDX_5720422519EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_access_token (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, access_token LONGTEXT DEFAULT NULL, expires DATETIME DEFAULT NULL, INDEX IDX_F7FA86A419EB6921 (client_id), INDEX IDX_F7FA86A4A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_authorization_code (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, authorization_code VARCHAR(255) DEFAULT NULL, redirect_uri LONGTEXT DEFAULT NULL, expires DATETIME DEFAULT NULL, id_token LONGTEXT DEFAULT NULL, INDEX IDX_793B081719EB6921 (client_id), INDEX IDX_793B0817A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_client (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, client_id VARCHAR(255) DEFAULT NULL, secret VARCHAR(255) DEFAULT NULL, redirect_uri LONGTEXT DEFAULT NULL, grant_type LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', INDEX IDX_AD73274DA76ED395 (user_id), UNIQUE INDEX idx_client_id_unique (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_refresh_token (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, user_id INT DEFAULT NULL, refresh_token VARCHAR(255) DEFAULT NULL, expires DATETIME DEFAULT NULL, INDEX IDX_55DCF75519EB6921 (client_id), INDEX IDX_55DCF755A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_jwt (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, subject VARCHAR(255) DEFAULT NULL, public_key LONGTEXT DEFAULT NULL, INDEX IDX_1F0B7D3F19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_public_key (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, public_key LONGTEXT DEFAULT NULL, private_key LONGTEXT DEFAULT NULL, encryption_algorithm LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_F43F7BD819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_scope (id INT AUTO_INCREMENT NOT NULL, scope LONGTEXT DEFAULT NULL, is_default TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_client_to_scope (scope_id INT NOT NULL, client_id INT NOT NULL, INDEX IDX_813F661A682B5931 (scope_id), INDEX IDX_813F661A19EB6921 (client_id), PRIMARY KEY(scope_id, client_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_authorization_code_to_scope (scope_id INT NOT NULL, authorization_code_id INT NOT NULL, INDEX IDX_B85EB82F682B5931 (scope_id), INDEX IDX_B85EB82F847B7245 (authorization_code_id), PRIMARY KEY(scope_id, authorization_code_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_refresh_token_to_scope (scope_id INT NOT NULL, refresh_token_id INT NOT NULL, INDEX IDX_D818C89C682B5931 (scope_id), INDEX IDX_D818C89CF765F60E (refresh_token_id), PRIMARY KEY(scope_id, refresh_token_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE oauth_access_token_to_scope (scope_id INT NOT NULL, access_token_id INT NOT NULL, INDEX IDX_C1D63208682B5931 (scope_id), INDEX IDX_C1D632082CCB2688 (access_token_id), PRIMARY KEY(scope_id, access_token_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE role ADD CONSTRAINT FK_57698A6AD60322AC FOREIGN KEY (parent) REFERENCES role (id)');
        $this->addSql('ALTER TABLE usuario_role ADD CONSTRAINT FK_3E13F07AD60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE usuario_role ADD CONSTRAINT FK_3E13F07AA76ED395 FOREIGN KEY (user_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE financas_dizimo ADD CONSTRAINT FK_1FCB0D95524172E FOREIGN KEY (membro_id) REFERENCES pessoa_membro (id)');
        $this->addSql('ALTER TABLE oauth_jti ADD CONSTRAINT FK_5720422519EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_access_token ADD CONSTRAINT FK_F7FA86A419EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_access_token ADD CONSTRAINT FK_F7FA86A4A76ED395 FOREIGN KEY (user_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_authorization_code ADD CONSTRAINT FK_793B081719EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_authorization_code ADD CONSTRAINT FK_793B0817A76ED395 FOREIGN KEY (user_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_client ADD CONSTRAINT FK_AD73274DA76ED395 FOREIGN KEY (user_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_refresh_token ADD CONSTRAINT FK_55DCF75519EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_refresh_token ADD CONSTRAINT FK_55DCF755A76ED395 FOREIGN KEY (user_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_jwt ADD CONSTRAINT FK_1F0B7D3F19EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_public_key ADD CONSTRAINT FK_F43F7BD819EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_client_to_scope ADD CONSTRAINT FK_813F661A682B5931 FOREIGN KEY (scope_id) REFERENCES oauth_scope (id)');
        $this->addSql('ALTER TABLE oauth_client_to_scope ADD CONSTRAINT FK_813F661A19EB6921 FOREIGN KEY (client_id) REFERENCES oauth_client (id)');
        $this->addSql('ALTER TABLE oauth_authorization_code_to_scope ADD CONSTRAINT FK_B85EB82F682B5931 FOREIGN KEY (scope_id) REFERENCES oauth_scope (id)');
        $this->addSql('ALTER TABLE oauth_authorization_code_to_scope ADD CONSTRAINT FK_B85EB82F847B7245 FOREIGN KEY (authorization_code_id) REFERENCES oauth_authorization_code (id)');
        $this->addSql('ALTER TABLE oauth_refresh_token_to_scope ADD CONSTRAINT FK_D818C89C682B5931 FOREIGN KEY (scope_id) REFERENCES oauth_scope (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_refresh_token_to_scope ADD CONSTRAINT FK_D818C89CF765F60E FOREIGN KEY (refresh_token_id) REFERENCES oauth_refresh_token (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_access_token_to_scope ADD CONSTRAINT FK_C1D63208682B5931 FOREIGN KEY (scope_id) REFERENCES oauth_scope (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE oauth_access_token_to_scope ADD CONSTRAINT FK_C1D632082CCB2688 FOREIGN KEY (access_token_id) REFERENCES oauth_access_token (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE role DROP FOREIGN KEY FK_57698A6AD60322AC');
        $this->addSql('ALTER TABLE usuario_role DROP FOREIGN KEY FK_3E13F07AD60322AC');
        $this->addSql('ALTER TABLE usuario_role DROP FOREIGN KEY FK_3E13F07AA76ED395');
        $this->addSql('ALTER TABLE oauth_access_token DROP FOREIGN KEY FK_F7FA86A4A76ED395');
        $this->addSql('ALTER TABLE oauth_authorization_code DROP FOREIGN KEY FK_793B0817A76ED395');
        $this->addSql('ALTER TABLE oauth_client DROP FOREIGN KEY FK_AD73274DA76ED395');
        $this->addSql('ALTER TABLE oauth_refresh_token DROP FOREIGN KEY FK_55DCF755A76ED395');
        $this->addSql('ALTER TABLE financas_dizimo DROP FOREIGN KEY FK_1FCB0D95524172E');
        $this->addSql('ALTER TABLE oauth_access_token_to_scope DROP FOREIGN KEY FK_C1D632082CCB2688');
        $this->addSql('ALTER TABLE oauth_authorization_code_to_scope DROP FOREIGN KEY FK_B85EB82F847B7245');
        $this->addSql('ALTER TABLE oauth_jti DROP FOREIGN KEY FK_5720422519EB6921');
        $this->addSql('ALTER TABLE oauth_access_token DROP FOREIGN KEY FK_F7FA86A419EB6921');
        $this->addSql('ALTER TABLE oauth_authorization_code DROP FOREIGN KEY FK_793B081719EB6921');
        $this->addSql('ALTER TABLE oauth_refresh_token DROP FOREIGN KEY FK_55DCF75519EB6921');
        $this->addSql('ALTER TABLE oauth_jwt DROP FOREIGN KEY FK_1F0B7D3F19EB6921');
        $this->addSql('ALTER TABLE oauth_public_key DROP FOREIGN KEY FK_F43F7BD819EB6921');
        $this->addSql('ALTER TABLE oauth_client_to_scope DROP FOREIGN KEY FK_813F661A19EB6921');
        $this->addSql('ALTER TABLE oauth_refresh_token_to_scope DROP FOREIGN KEY FK_D818C89CF765F60E');
        $this->addSql('ALTER TABLE oauth_client_to_scope DROP FOREIGN KEY FK_813F661A682B5931');
        $this->addSql('ALTER TABLE oauth_authorization_code_to_scope DROP FOREIGN KEY FK_B85EB82F682B5931');
        $this->addSql('ALTER TABLE oauth_refresh_token_to_scope DROP FOREIGN KEY FK_D818C89C682B5931');
        $this->addSql('ALTER TABLE oauth_access_token_to_scope DROP FOREIGN KEY FK_C1D63208682B5931');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE usuario_role');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP TABLE financas_dizimo');
        $this->addSql('DROP TABLE pessoa_membro');
        $this->addSql('DROP TABLE oauth_jti');
        $this->addSql('DROP TABLE oauth_access_token');
        $this->addSql('DROP TABLE oauth_authorization_code');
        $this->addSql('DROP TABLE oauth_client');
        $this->addSql('DROP TABLE oauth_refresh_token');
        $this->addSql('DROP TABLE oauth_jwt');
        $this->addSql('DROP TABLE oauth_public_key');
        $this->addSql('DROP TABLE oauth_scope');
        $this->addSql('DROP TABLE oauth_client_to_scope');
        $this->addSql('DROP TABLE oauth_authorization_code_to_scope');
        $this->addSql('DROP TABLE oauth_refresh_token_to_scope');
        $this->addSql('DROP TABLE oauth_access_token_to_scope');
    }
}
