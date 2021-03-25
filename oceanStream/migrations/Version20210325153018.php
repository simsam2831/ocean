<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210325153018 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answer_proposition_question_event (answer_proposition_id INT NOT NULL, question_event_id INT NOT NULL, INDEX IDX_C51A0F54A14B30FB (answer_proposition_id), INDEX IDX_C51A0F5412FF5887 (question_event_id), PRIMARY KEY(answer_proposition_id, question_event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE answer_proposition_question_event ADD CONSTRAINT FK_C51A0F54A14B30FB FOREIGN KEY (answer_proposition_id) REFERENCES answer_proposition (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer_proposition_question_event ADD CONSTRAINT FK_C51A0F5412FF5887 FOREIGN KEY (question_event_id) REFERENCES question_event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE answer_proposition DROP FOREIGN KEY FK_6C3537012FF5887');
        $this->addSql('DROP INDEX IDX_6C3537012FF5887 ON answer_proposition');
        $this->addSql('ALTER TABLE answer_proposition DROP question_event_id');
        $this->addSql('ALTER TABLE bot ADD is_bot_controlled TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE event ADD location INT NOT NULL');
        $this->addSql('ALTER TABLE fish_event CHANGE fish_quality fish_quantity INT NOT NULL');
        $this->addSql('ALTER TABLE game DROP INDEX IDX_232B318CE7EC5785, ADD UNIQUE INDEX UNIQ_232B318CE7EC5785 (board_id)');
        $this->addSql('ALTER TABLE game ADD mode VARCHAR(255) NOT NULL, ADD nb_players INT NOT NULL, ADD is_pending TINYINT(1) NOT NULL, ADD global_turn INT NOT NULL');
        $this->addSql('ALTER TABLE question_event ADD category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE token DROP FOREIGN KEY FK_5F37A13BE48FD905');
        $this->addSql('DROP INDEX IDX_5F37A13BE48FD905 ON token');
        $this->addSql('ALTER TABLE token ADD family VARCHAR(64) NOT NULL, ADD is_selected TINYINT(1) NOT NULL, DROP game_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE answer_proposition_question_event');
        $this->addSql('ALTER TABLE answer_proposition ADD question_event_id INT NOT NULL');
        $this->addSql('ALTER TABLE answer_proposition ADD CONSTRAINT FK_6C3537012FF5887 FOREIGN KEY (question_event_id) REFERENCES question_event (id)');
        $this->addSql('CREATE INDEX IDX_6C3537012FF5887 ON answer_proposition (question_event_id)');
        $this->addSql('ALTER TABLE bot DROP is_bot_controlled');
        $this->addSql('ALTER TABLE `event` DROP location');
        $this->addSql('ALTER TABLE fish_event CHANGE fish_quantity fish_quality INT NOT NULL');
        $this->addSql('ALTER TABLE game DROP INDEX UNIQ_232B318CE7EC5785, ADD INDEX IDX_232B318CE7EC5785 (board_id)');
        $this->addSql('ALTER TABLE game DROP mode, DROP nb_players, DROP is_pending, DROP global_turn');
        $this->addSql('ALTER TABLE question_event DROP category');
        $this->addSql('ALTER TABLE token ADD game_id INT DEFAULT NULL, DROP family, DROP is_selected');
        $this->addSql('ALTER TABLE token ADD CONSTRAINT FK_5F37A13BE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('CREATE INDEX IDX_5F37A13BE48FD905 ON token (game_id)');
    }
}
