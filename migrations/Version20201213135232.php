<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201213135232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBEFE6CCE');
        $this->addSql('ALTER TABLE post CHANGE post_image post_image VARCHAR(255) NOT NULL');
        $this->addSql('CREATE FULLTEXT INDEX IDX_FAB8C3B39776190DB9A19060FDED88F ON post (post_name, post_category, post_user_pseudo)');
        $this->addSql('DROP INDEX idx_5a8a6c8dbefe6cce ON post');
        $this->addSql('CREATE INDEX IDX_FAB8C3B3BEFE6CCE ON post (post_user_id_id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBEFE6CCE FOREIGN KEY (post_user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_FAB8C3B39776190DB9A19060FDED88F ON Post');
        $this->addSql('ALTER TABLE Post DROP FOREIGN KEY FK_FAB8C3B3BEFE6CCE');
        $this->addSql('ALTER TABLE Post CHANGE post_image post_image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX idx_fab8c3b3befe6cce ON Post');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DBEFE6CCE ON Post (post_user_id_id)');
        $this->addSql('ALTER TABLE Post ADD CONSTRAINT FK_FAB8C3B3BEFE6CCE FOREIGN KEY (post_user_id_id) REFERENCES user (id)');
    }
}
