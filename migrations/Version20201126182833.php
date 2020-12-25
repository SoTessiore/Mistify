<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201126182833 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, comment_user_id_id INT NOT NULL, comment_post_id_id INT NOT NULL, comment_content LONGTEXT NOT NULL, INDEX IDX_9474526C1F67EF2F (comment_user_id_id), INDEX IDX_9474526C6ABE9898 (comment_post_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE download (id INT AUTO_INCREMENT NOT NULL, download_user_id_id INT NOT NULL, download_post_id_id INT NOT NULL, INDEX IDX_781A8270A4445C72 (download_user_id_id), INDEX IDX_781A8270D19D2BC5 (download_post_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE likes (id INT AUTO_INCREMENT NOT NULL, likes_user_id_id INT NOT NULL, likes_post_id_id INT DEFAULT NULL, INDEX IDX_49CA4E7D5033ED80 (likes_user_id_id), INDEX IDX_49CA4E7D25EA9A37 (likes_post_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, post_user_id_id INT NOT NULL, post_name VARCHAR(255) NOT NULL, post_description LONGTEXT NOT NULL, post_category VARCHAR(255) NOT NULL, post_download_link VARCHAR(255) NOT NULL, post_image VARCHAR(255) NOT NULL, post_nb_likes INT DEFAULT NULL, post_nb_coms INT DEFAULT NULL, INDEX IDX_5A8A6C8DBEFE6CCE (post_user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_pseudo VARCHAR(30) NOT NULL, user_password VARCHAR(30) NOT NULL, user_mail VARCHAR(100) NOT NULL, user_born DATE NOT NULL, user_avatar VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C1F67EF2F FOREIGN KEY (comment_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C6ABE9898 FOREIGN KEY (comment_post_id_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE download ADD CONSTRAINT FK_781A8270A4445C72 FOREIGN KEY (download_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE download ADD CONSTRAINT FK_781A8270D19D2BC5 FOREIGN KEY (download_post_id_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D5033ED80 FOREIGN KEY (likes_user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE likes ADD CONSTRAINT FK_49CA4E7D25EA9A37 FOREIGN KEY (likes_post_id_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DBEFE6CCE FOREIGN KEY (post_user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C6ABE9898');
        $this->addSql('ALTER TABLE download DROP FOREIGN KEY FK_781A8270D19D2BC5');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D25EA9A37');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C1F67EF2F');
        $this->addSql('ALTER TABLE download DROP FOREIGN KEY FK_781A8270A4445C72');
        $this->addSql('ALTER TABLE likes DROP FOREIGN KEY FK_49CA4E7D5033ED80');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DBEFE6CCE');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE download');
        $this->addSql('DROP TABLE likes');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE user');
    }
}
