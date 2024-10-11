<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241004145032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, subject VARCHAR(100) NOT NULL, hoursappointment DATETIME NOT NULL, position INT DEFAULT NULL, nextweek TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_user (appointment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9E501E88E5B533F9 (appointment_id), INDEX IDX_9E501E88A76ED395 (user_id), PRIMARY KEY(appointment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, archived TINYINT(1) DEFAULT NULL, INDEX IDX_81398E098DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea_bam (id INT AUTO_INCREMENT NOT NULL, subject VARCHAR(255) DEFAULT NULL, object VARCHAR(255) DEFAULT NULL, waiting_return TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea_bam_user (idea_bam_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_2FAB78CF618839B (idea_bam_id), INDEX IDX_2FAB78CA76ED395 (user_id), PRIMARY KEY(idea_bam_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projects (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, object VARCHAR(255) NOT NULL, sub_object1 VARCHAR(255) DEFAULT NULL, sub_object2 VARCHAR(255) DEFAULT NULL, sub_object3 VARCHAR(255) DEFAULT NULL, position INT DEFAULT NULL, p1 TINYINT(1) DEFAULT NULL, p2 TINYINT(1) DEFAULT NULL, nextweek TINYINT(1) DEFAULT NULL, done TINYINT(1) DEFAULT NULL, INDEX IDX_527EDB259395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_user (task_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE2042328DB60186 (task_id), INDEX IDX_FE204232A76ED395 (user_id), PRIMARY KEY(task_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waiting_return (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, object VARCHAR(255) NOT NULL, sub_object1 VARCHAR(255) DEFAULT NULL, sub_object2 VARCHAR(255) DEFAULT NULL, sub_object3 VARCHAR(255) DEFAULT NULL, nextweek TINYINT(1) DEFAULT NULL, position INT DEFAULT NULL, INDEX IDX_D6C0CFAD9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waiting_return_user (waiting_return_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_30E2F7FC60E702E4 (waiting_return_id), INDEX IDX_30E2F7FCA76ED395 (user_id), PRIMARY KEY(waiting_return_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment_user ADD CONSTRAINT FK_9E501E88E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_user ADD CONSTRAINT FK_9E501E88A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE idea_bam_user ADD CONSTRAINT FK_2FAB78CF618839B FOREIGN KEY (idea_bam_id) REFERENCES idea_bam (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE idea_bam_user ADD CONSTRAINT FK_2FAB78CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB259395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE2042328DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE204232A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE waiting_return ADD CONSTRAINT FK_D6C0CFAD9395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE waiting_return_user ADD CONSTRAINT FK_30E2F7FC60E702E4 FOREIGN KEY (waiting_return_id) REFERENCES waiting_return (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE waiting_return_user ADD CONSTRAINT FK_30E2F7FCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment_user DROP FOREIGN KEY FK_9E501E88E5B533F9');
        $this->addSql('ALTER TABLE appointment_user DROP FOREIGN KEY FK_9E501E88A76ED395');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098DB60186');
        $this->addSql('ALTER TABLE idea_bam_user DROP FOREIGN KEY FK_2FAB78CF618839B');
        $this->addSql('ALTER TABLE idea_bam_user DROP FOREIGN KEY FK_2FAB78CA76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB259395C3F3');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE2042328DB60186');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE204232A76ED395');
        $this->addSql('ALTER TABLE waiting_return DROP FOREIGN KEY FK_D6C0CFAD9395C3F3');
        $this->addSql('ALTER TABLE waiting_return_user DROP FOREIGN KEY FK_30E2F7FC60E702E4');
        $this->addSql('ALTER TABLE waiting_return_user DROP FOREIGN KEY FK_30E2F7FCA76ED395');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE appointment_user');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE idea_bam');
        $this->addSql('DROP TABLE idea_bam_user');
        $this->addSql('DROP TABLE projects');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_user');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE waiting_return');
        $this->addSql('DROP TABLE waiting_return_user');
    }
}
