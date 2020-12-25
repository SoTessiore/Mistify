<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210153353 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD post_user_pseudo VARCHAR(255) NOT NULL, CHANGE post_nb_likes post_nb_likes INT DEFAULT NULL, CHANGE post_nb_coms post_nb_coms INT DEFAULT NULL, CHANGE post_nb_downloads post_nb_downloads INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP post_user_pseudo, CHANGE post_nb_likes post_nb_likes INT DEFAULT 0 NOT NULL, CHANGE post_nb_coms post_nb_coms INT DEFAULT 0 NOT NULL, CHANGE post_nb_downloads post_nb_downloads INT DEFAULT 0 NOT NULL');
    }
}
