<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210323175124 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_proposition (id INT AUTO_INCREMENT NOT NULL, question_event_id INT NOT NULL, fish_id INT DEFAULT NULL, description_answer LONGTEXT NOT NULL, image_answer VARCHAR(255) NOT NULL, is_correct TINYINT(1) NOT NULL, fish_quantity INT NOT NULL, INDEX IDX_6C3537012FF5887 (question_event_id), INDEX IDX_6C353708311A1E2 (fish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bot (id INT AUTO_INCREMENT NOT NULL, name_bot VARCHAR(64) NOT NULL, difficulty VARCHAR(64) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `event` (id INT AUTO_INCREMENT NOT NULL, board_id INT NOT NULL, name_event VARCHAR(64) NOT NULL, description_event LONGTEXT NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_3BAE0AA7E7EC5785 (board_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fish (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, family VARCHAR(64) NOT NULL, quantity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fish_event (id INT NOT NULL, fish_id INT NOT NULL, fish_quality INT NOT NULL, INDEX IDX_5561F8D78311A1E2 (fish_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, board_id INT NOT NULL, mode VARCHAR(255) NOT NULL, nb_players INT NOT NULL, is_pending TINYINT(1) NOT NULL, global_turn INT NOT NULL, INDEX IDX_232B318CE7EC5785 (board_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game_bot (game_id INT NOT NULL, bot_id INT NOT NULL, INDEX IDX_1A4517D4E48FD905 (game_id), INDEX IDX_1A4517D492C1C487 (bot_id), PRIMARY KEY(game_id, bot_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE map (id INT AUTO_INCREMENT NOT NULL, price INT NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question_event (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE special_event (id INT NOT NULL, is_blooked TINYINT(1) NOT NULL, is_goal TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE token (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, game_id INT DEFAULT NULL, price_token INT NOT NULL, image_token VARCHAR(255) NOT NULL, color VARCHAR(64) DEFAULT NULL, INDEX IDX_5F37A13B71F7E88B (event_id), INDEX IDX_5F37A13BE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(64) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_fish (user_id INT NOT NULL, fish_id INT NOT NULL, INDEX IDX_45F508FAA76ED395 (user_id), INDEX IDX_45F508FA8311A1E2 (fish_id), PRIMARY KEY(user_id, fish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_map (user_id INT NOT NULL, map_id INT NOT NULL, INDEX IDX_78BBCB30A76ED395 (user_id), INDEX IDX_78BBCB3053C55F64 (map_id), PRIMARY KEY(user_id, map_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_token (user_id INT NOT NULL, token_id INT NOT NULL, INDEX IDX_BDF55A63A76ED395 (user_id), INDEX IDX_BDF55A6341DEE7B9 (token_id), PRIMARY KEY(user_id, token_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_game (user_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_59AA7D45A76ED395 (user_id), INDEX IDX_59AA7D45E48FD905 (game_id), PRIMARY KEY(user_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_proposition ADD CONSTRAINT FK_6C3537012FF5887 FOREIGN KEY (question_event_id) REFERENCES question_event (id)');
        $this->addSql('ALTER TABLE answer_proposition ADD CONSTRAINT FK_6C353708311A1E2 FOREIGN KEY (fish_id) REFERENCES fish (id)');
        $this->addSql('ALTER TABLE `event` ADD CONSTRAINT FK_3BAE0AA7E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id)');
        $this->addSql('ALTER TABLE fish_event ADD CONSTRAINT FK_5561F8D78311A1E2 FOREIGN KEY (fish_id) REFERENCES fish (id)');
        $this->addSql('ALTER TABLE fish_event ADD CONSTRAINT FK_5561F8D7BF396750 FOREIGN KEY (id) REFERENCES `event` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CE7EC5785 FOREIGN KEY (board_id) REFERENCES board (id)');
        $this->addSql('ALTER TABLE game_bot ADD CONSTRAINT FK_1A4517D4E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game_bot ADD CONSTRAINT FK_1A4517D492C1C487 FOREIGN KEY (bot_id) REFERENCES bot (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_event ADD CONSTRAINT FK_B451BA3BF396750 FOREIGN KEY (id) REFERENCES `event` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE special_event ADD CONSTRAINT FK_9790A4E6BF396750 FOREIGN KEY (id) REFERENCES `event` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13B71F7E88B FOREIGN KEY (event_id) REFERENCES `event` (id)');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE user_fish ADD CONSTRAINT FK_45F508FAA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_fish ADD CONSTRAINT FK_45F508FA8311A1E2 FOREIGN KEY (fish_id) REFERENCES fish (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_map ADD CONSTRAINT FK_78BBCB30A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_map ADD CONSTRAINT FK_78BBCB3053C55F64 FOREIGN KEY (map_id) REFERENCES map (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_token ADD CONSTRAINT FK_BDF55A63A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_token ADD CONSTRAINT FK_BDF55A6341DEE7B9 FOREIGN KEY (token_id) REFERENCES token (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `event` DROP FOREIGN KEY FK_3BAE0AA7E7EC5785');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CE7EC5785');
        $this->addSql('ALTER TABLE game_bot DROP FOREIGN KEY FK_1A4517D492C1C487');
        $this->addSql('ALTER TABLE fish_event DROP FOREIGN KEY FK_5561F8D7BF396750');
        $this->addSql('ALTER TABLE question_event DROP FOREIGN KEY FK_B451BA3BF396750');
        $this->addSql('ALTER TABLE special_event DROP FOREIGN KEY FK_9790A4E6BF396750');
        $this->addSql('ALTER TABLE token DROP FOREIGN KEY FK_5F37A13B71F7E88B');
        $this->addSql('ALTER TABLE answer_proposition DROP FOREIGN KEY FK_6C353708311A1E2');
        $this->addSql('ALTER TABLE fish_event DROP FOREIGN KEY FK_5561F8D78311A1E2');
        $this->addSql('ALTER TABLE user_fish DROP FOREIGN KEY FK_45F508FA8311A1E2');
        $this->addSql('ALTER TABLE game_bot DROP FOREIGN KEY FK_1A4517D4E48FD905');
        $this->addSql('ALTER TABLE token DROP FOREIGN KEY FK_5F37A13BE48FD905');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45E48FD905');
        $this->addSql('ALTER TABLE user_map DROP FOREIGN KEY FK_78BBCB3053C55F64');
        $this->addSql('ALTER TABLE answer_proposition DROP FOREIGN KEY FK_6C3537012FF5887');
        $this->addSql('ALTER TABLE user_token DROP FOREIGN KEY FK_BDF55A6341DEE7B9');
        $this->addSql('ALTER TABLE user_fish DROP FOREIGN KEY FK_45F508FAA76ED395');
        $this->addSql('ALTER TABLE user_map DROP FOREIGN KEY FK_78BBCB30A76ED395');
        $this->addSql('ALTER TABLE user_token DROP FOREIGN KEY FK_BDF55A63A76ED395');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45A76ED395');
        $this->addSql('DROP TABLE answer_proposition');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE bot');
        $this->addSql('DROP TABLE `event`');
        $this->addSql('DROP TABLE fish');
        $this->addSql('DROP TABLE fish_event');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE game_bot');
        $this->addSql('DROP TABLE map');
        $this->addSql('DROP TABLE question_event');
        $this->addSql('DROP TABLE special_event');
        $this->addSql('DROP TABLE token');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_fish');
        $this->addSql('DROP TABLE user_map');
        $this->addSql('DROP TABLE user_token');
        $this->addSql('DROP TABLE user_game');
    }
}
