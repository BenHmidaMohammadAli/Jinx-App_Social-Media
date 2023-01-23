<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221206132908 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E564DD9267');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C64DD9267');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E52F43A116');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C2F43A116');
        $this->addSql('ALTER TABLE achat DROP FOREIGN KEY FK_26A9845612F7FB51');
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E512F7FB51');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA712F7FB51');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, status TINYINT(1) NOT NULL, role_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, role_id INT DEFAULT NULL, group_created_id INT DEFAULT NULL, group_linked_id INT DEFAULT NULL, game_to_buy_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, gender VARCHAR(255) NOT NULL, etude VARCHAR(255) NOT NULL, about_me VARCHAR(255) NOT NULL, mf VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649D60322AC (role_id), UNIQUE INDEX UNIQ_8D93D649892D7FF6 (group_created_id), INDEX IDX_8D93D6499665CD05 (group_linked_id), INDEX IDX_8D93D649BE8F5EE6 (game_to_buy_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_event (user_id INT NOT NULL, event_id INT NOT NULL, INDEX IDX_D96CF1FFA76ED395 (user_id), INDEX IDX_D96CF1FF71F7E88B (event_id), PRIMARY KEY(user_id, event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_game (user_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_59AA7D45A76ED395 (user_id), INDEX IDX_59AA7D45E48FD905 (game_id), PRIMARY KEY(user_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649892D7FF6 FOREIGN KEY (group_created_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6499665CD05 FOREIGN KEY (group_linked_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649BE8F5EE6 FOREIGN KEY (game_to_buy_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_event ADD CONSTRAINT FK_D96CF1FF71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_game ADD CONSTRAINT FK_59AA7D45E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE developer DROP FOREIGN KEY FK_65FB8B9A7A45358C');
        $this->addSql('ALTER TABLE event_gamer DROP FOREIGN KEY FK_C93FAA8B2F43A116');
        $this->addSql('ALTER TABLE event_gamer DROP FOREIGN KEY FK_C93FAA8B71F7E88B');
        $this->addSql('ALTER TABLE gamer DROP FOREIGN KEY FK_88241BA77A45358C');
        $this->addSql('ALTER TABLE gamer_game DROP FOREIGN KEY FK_F70F2EF0E48FD905');
        $this->addSql('ALTER TABLE gamer_game DROP FOREIGN KEY FK_F70F2EF02F43A116');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE developer');
        $this->addSql('DROP TABLE event_gamer');
        $this->addSql('DROP TABLE gamer');
        $this->addSql('DROP TABLE gamer_game');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP INDEX IDX_26A9845612F7FB51 ON achat');
        $this->addSql('ALTER TABLE achat DROP sponsor_id');
        $this->addSql('DROP INDEX IDX_F65593E512F7FB51 ON annonce');
        $this->addSql('DROP INDEX IDX_F65593E564DD9267 ON annonce');
        $this->addSql('DROP INDEX IDX_F65593E52F43A116 ON annonce');
        $this->addSql('ALTER TABLE annonce ADD user_id INT DEFAULT NULL, DROP gamer_id, DROP sponsor_id, DROP developer_id');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_F65593E5A76ED395 ON annonce (user_id)');
        $this->addSql('DROP INDEX IDX_3BAE0AA712F7FB51 ON event');
        $this->addSql('ALTER TABLE event CHANGE sponsor_id creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA761220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA761220EA6 ON event (creator_id)');
        $this->addSql('DROP INDEX IDX_232B318C64DD9267 ON game');
        $this->addSql('ALTER TABLE game CHANGE developer_id developper_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CDA42B93 FOREIGN KEY (developper_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_232B318CDA42B93 ON game (developper_id)');
        $this->addSql('ALTER TABLE `group` ADD creator_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `group` ADD CONSTRAINT FK_6DC044C561220EA6 FOREIGN KEY (creator_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_6DC044C561220EA6 ON `group` (creator_id)');
        $this->addSql('DROP INDEX IDX_D87F7E0C2F43A116 ON test');
        $this->addSql('ALTER TABLE test CHANGE gamer_id tester_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C979A21C1 FOREIGN KEY (tester_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0C979A21C1 ON test (tester_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE annonce DROP FOREIGN KEY FK_F65593E5A76ED395');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA761220EA6');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CDA42B93');
        $this->addSql('ALTER TABLE `group` DROP FOREIGN KEY FK_6DC044C561220EA6');
        $this->addSql('ALTER TABLE test DROP FOREIGN KEY FK_D87F7E0C979A21C1');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, adresse_mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE developer (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etude VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE NOT NULL, about_me VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero_tel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation DATE NOT NULL, INDEX IDX_65FB8B9A7A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE event_gamer (event_id INT NOT NULL, gamer_id INT NOT NULL, INDEX IDX_C93FAA8B71F7E88B (event_id), INDEX IDX_C93FAA8B2F43A116 (gamer_id), PRIMARY KEY(event_id, gamer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gamer (id INT AUTO_INCREMENT NOT NULL, groupe_id INT DEFAULT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_naissance DATE NOT NULL, gender VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, etude VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero_tel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation DATE NOT NULL, INDEX IDX_88241BA77A45358C (groupe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE gamer_game (gamer_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_F70F2EF02F43A116 (gamer_id), INDEX IDX_F70F2EF0E48FD905 (game_id), PRIMARY KEY(gamer_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, photo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, pays VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ville VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mat_fiscal VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, adresse_mail VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, mdp VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, numero_tel VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, specialite VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE developer ADD CONSTRAINT FK_65FB8B9A7A45358C FOREIGN KEY (groupe_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE event_gamer ADD CONSTRAINT FK_C93FAA8B2F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE event_gamer ADD CONSTRAINT FK_C93FAA8B71F7E88B FOREIGN KEY (event_id) REFERENCES event (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gamer ADD CONSTRAINT FK_88241BA77A45358C FOREIGN KEY (groupe_id) REFERENCES `group` (id)');
        $this->addSql('ALTER TABLE gamer_game ADD CONSTRAINT FK_F70F2EF0E48FD905 FOREIGN KEY (game_id) REFERENCES game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gamer_game ADD CONSTRAINT FK_F70F2EF02F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D60322AC');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649892D7FF6');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499665CD05');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649BE8F5EE6');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FFA76ED395');
        $this->addSql('ALTER TABLE user_event DROP FOREIGN KEY FK_D96CF1FF71F7E88B');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45A76ED395');
        $this->addSql('ALTER TABLE user_game DROP FOREIGN KEY FK_59AA7D45E48FD905');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_event');
        $this->addSql('DROP TABLE user_game');
        $this->addSql('ALTER TABLE achat ADD sponsor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE achat ADD CONSTRAINT FK_26A9845612F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('CREATE INDEX IDX_26A9845612F7FB51 ON achat (sponsor_id)');
        $this->addSql('DROP INDEX IDX_F65593E5A76ED395 ON annonce');
        $this->addSql('ALTER TABLE annonce ADD sponsor_id INT DEFAULT NULL, ADD developer_id INT DEFAULT NULL, CHANGE user_id gamer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E52F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E564DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id)');
        $this->addSql('ALTER TABLE annonce ADD CONSTRAINT FK_F65593E512F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('CREATE INDEX IDX_F65593E512F7FB51 ON annonce (sponsor_id)');
        $this->addSql('CREATE INDEX IDX_F65593E564DD9267 ON annonce (developer_id)');
        $this->addSql('CREATE INDEX IDX_F65593E52F43A116 ON annonce (gamer_id)');
        $this->addSql('DROP INDEX IDX_3BAE0AA761220EA6 ON event');
        $this->addSql('ALTER TABLE event CHANGE creator_id sponsor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA712F7FB51 FOREIGN KEY (sponsor_id) REFERENCES sponsor (id)');
        $this->addSql('CREATE INDEX IDX_3BAE0AA712F7FB51 ON event (sponsor_id)');
        $this->addSql('DROP INDEX IDX_232B318CDA42B93 ON game');
        $this->addSql('ALTER TABLE game CHANGE developper_id developer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C64DD9267 FOREIGN KEY (developer_id) REFERENCES developer (id)');
        $this->addSql('CREATE INDEX IDX_232B318C64DD9267 ON game (developer_id)');
        $this->addSql('DROP INDEX UNIQ_6DC044C561220EA6 ON `group`');
        $this->addSql('ALTER TABLE `group` DROP creator_id');
        $this->addSql('DROP INDEX IDX_D87F7E0C979A21C1 ON test');
        $this->addSql('ALTER TABLE test CHANGE tester_id gamer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE test ADD CONSTRAINT FK_D87F7E0C2F43A116 FOREIGN KEY (gamer_id) REFERENCES gamer (id)');
        $this->addSql('CREATE INDEX IDX_D87F7E0C2F43A116 ON test (gamer_id)');
    }
}
