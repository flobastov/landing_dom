<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190203090540 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE form_data_request (id INT AUTO_INCREMENT NOT NULL, raw LONGTEXT NOT NULL COMMENT \'(DC2Type:json_array)\', created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(128) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, publish TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_140AB620989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_page_block (page_id INT NOT NULL, page_block_id INT NOT NULL, INDEX IDX_EE7A596AC4663E4 (page_id), INDEX IDX_EE7A596A6972852C (page_block_id), PRIMARY KEY(page_id, page_block_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_block (id INT AUTO_INCREMENT NOT NULL, gallery INT DEFAULT NULL, media_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, body LONGTEXT DEFAULT NULL, code VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_E59A68F4472B783A (gallery), INDEX IDX_E59A68F4EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, media_id INT DEFAULT NULL, gallery INT DEFAULT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, square VARCHAR(255) NOT NULL, floors VARCHAR(255) NOT NULL, dimensions VARCHAR(255) NOT NULL, equipment VARCHAR(255) NOT NULL, foundation VARCHAR(255) NOT NULL, overlap VARCHAR(255) NOT NULL, roof VARCHAR(255) DEFAULT NULL, term VARCHAR(255) DEFAULT NULL, price VARCHAR(255) DEFAULT NULL, publish TINYINT(1) DEFAULT NULL, type enum(\'Проект\', \'Объект\'), INDEX IDX_D34A04ADEA9FDD75 (media_id), UNIQUE INDEX UNIQ_D34A04AD472B783A (gallery), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, value VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE thread (id VARCHAR(255) NOT NULL, permalink VARCHAR(255) NOT NULL, is_commentable TINYINT(1) NOT NULL, num_comments INT NOT NULL, last_comment_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, context VARCHAR(64) NOT NULL, default_format VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__gallery_media (id INT AUTO_INCREMENT NOT NULL, gallery_id INT DEFAULT NULL, media_id INT DEFAULT NULL, position INT NOT NULL, enabled TINYINT(1) NOT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_80D4C5414E7AF8F (gallery_id), INDEX IDX_80D4C541EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media__media (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, enabled TINYINT(1) NOT NULL, provider_name VARCHAR(255) NOT NULL, provider_status INT NOT NULL, provider_reference VARCHAR(255) NOT NULL, provider_metadata LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', width INT DEFAULT NULL, height INT DEFAULT NULL, length NUMERIC(10, 0) DEFAULT NULL, content_type VARCHAR(255) DEFAULT NULL, content_size INT DEFAULT NULL, copyright VARCHAR(255) DEFAULT NULL, author_name VARCHAR(255) DEFAULT NULL, context VARCHAR(64) DEFAULT NULL, cdn_is_flushable TINYINT(1) DEFAULT NULL, cdn_flush_identifier VARCHAR(64) DEFAULT NULL, cdn_flush_at DATETIME DEFAULT NULL, cdn_status INT DEFAULT NULL, updated_at DATETIME NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_group (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_583D1F3E5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, date_of_birth DATETIME DEFAULT NULL, firstname VARCHAR(64) DEFAULT NULL, lastname VARCHAR(64) DEFAULT NULL, website VARCHAR(64) DEFAULT NULL, biography VARCHAR(1000) DEFAULT NULL, gender VARCHAR(1) DEFAULT NULL, locale VARCHAR(8) DEFAULT NULL, timezone VARCHAR(64) DEFAULT NULL, phone VARCHAR(64) DEFAULT NULL, facebook_uid VARCHAR(255) DEFAULT NULL, facebook_name VARCHAR(255) DEFAULT NULL, facebook_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', twitter_uid VARCHAR(255) DEFAULT NULL, twitter_name VARCHAR(255) DEFAULT NULL, twitter_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', gplus_uid VARCHAR(255) DEFAULT NULL, gplus_name VARCHAR(255) DEFAULT NULL, gplus_data LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:json)\', token VARCHAR(255) DEFAULT NULL, two_step_code VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C560D76192FC23A8 (username_canonical), UNIQUE INDEX UNIQ_C560D761A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_C560D761C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user_user_group (user_id INT NOT NULL, group_id INT NOT NULL, INDEX IDX_B3C77447A76ED395 (user_id), INDEX IDX_B3C77447FE54D947 (group_id), PRIMARY KEY(user_id, group_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeline__action (id INT AUTO_INCREMENT NOT NULL, verb VARCHAR(255) NOT NULL, status_current VARCHAR(255) NOT NULL, status_wanted VARCHAR(255) NOT NULL, duplicate_key VARCHAR(255) DEFAULT NULL, duplicate_priority INT DEFAULT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeline__action_component (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, component_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, text VARCHAR(255) DEFAULT NULL, INDEX IDX_6ACD1B169D32F035 (action_id), INDEX IDX_6ACD1B16E2ABAFFF (component_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeline__component (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, identifier LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', hash VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1B2F01CDD1B862B8 (hash), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timeline__timeline (id INT AUTO_INCREMENT NOT NULL, action_id INT DEFAULT NULL, subject_id INT DEFAULT NULL, context VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_FFBC6AD59D32F035 (action_id), INDEX IDX_FFBC6AD523EDC87 (subject_id), INDEX context_idx (context), INDEX type_idx (type), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE page_page_block ADD CONSTRAINT FK_EE7A596AC4663E4 FOREIGN KEY (page_id) REFERENCES page (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_page_block ADD CONSTRAINT FK_EE7A596A6972852C FOREIGN KEY (page_block_id) REFERENCES page_block (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE page_block ADD CONSTRAINT FK_E59A68F4472B783A FOREIGN KEY (gallery) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE page_block ADD CONSTRAINT FK_E59A68F4EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADEA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD472B783A FOREIGN KEY (gallery) REFERENCES media__gallery (id)');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C5414E7AF8F FOREIGN KEY (gallery_id) REFERENCES media__gallery (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE media__gallery_media ADD CONSTRAINT FK_80D4C541EA9FDD75 FOREIGN KEY (media_id) REFERENCES media__media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fos_user_user_group ADD CONSTRAINT FK_B3C77447FE54D947 FOREIGN KEY (group_id) REFERENCES fos_user_group (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B169D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__action_component ADD CONSTRAINT FK_6ACD1B16E2ABAFFF FOREIGN KEY (component_id) REFERENCES timeline__component (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD59D32F035 FOREIGN KEY (action_id) REFERENCES timeline__action (id)');
        $this->addSql('ALTER TABLE timeline__timeline ADD CONSTRAINT FK_FFBC6AD523EDC87 FOREIGN KEY (subject_id) REFERENCES timeline__component (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE page_page_block DROP FOREIGN KEY FK_EE7A596AC4663E4');
        $this->addSql('ALTER TABLE page_page_block DROP FOREIGN KEY FK_EE7A596A6972852C');
        $this->addSql('ALTER TABLE page_block DROP FOREIGN KEY FK_E59A68F4472B783A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD472B783A');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C5414E7AF8F');
        $this->addSql('ALTER TABLE page_block DROP FOREIGN KEY FK_E59A68F4EA9FDD75');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADEA9FDD75');
        $this->addSql('ALTER TABLE media__gallery_media DROP FOREIGN KEY FK_80D4C541EA9FDD75');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447FE54D947');
        $this->addSql('ALTER TABLE fos_user_user_group DROP FOREIGN KEY FK_B3C77447A76ED395');
        $this->addSql('ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B169D32F035');
        $this->addSql('ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD59D32F035');
        $this->addSql('ALTER TABLE timeline__action_component DROP FOREIGN KEY FK_6ACD1B16E2ABAFFF');
        $this->addSql('ALTER TABLE timeline__timeline DROP FOREIGN KEY FK_FFBC6AD523EDC87');
        $this->addSql('DROP TABLE form_data_request');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE page_page_block');
        $this->addSql('DROP TABLE page_block');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE thread');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE media__gallery');
        $this->addSql('DROP TABLE media__gallery_media');
        $this->addSql('DROP TABLE media__media');
        $this->addSql('DROP TABLE fos_user_group');
        $this->addSql('DROP TABLE fos_user_user');
        $this->addSql('DROP TABLE fos_user_user_group');
        $this->addSql('DROP TABLE timeline__action');
        $this->addSql('DROP TABLE timeline__action_component');
        $this->addSql('DROP TABLE timeline__component');
        $this->addSql('DROP TABLE timeline__timeline');
    }
}
