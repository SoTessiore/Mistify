<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201223205854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D25EA9A37');
        $this->addSql('DROP INDEX IDX_49CA4E7D25EA9A37 ON likes');
        $this->addSql('ALTER TABLE likes DROP likes_post_id_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE likes ADD likes_post_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D25EA9A37 FOREIGN KEY (likes_post_id_id) REFERENCES post (id)');
        $this->addSql('CREATE INDEX IDX_49CA4E7D25EA9A37 ON likes (likes_post_id_id)');
    }
}
