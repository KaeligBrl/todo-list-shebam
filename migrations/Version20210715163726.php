<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210715163726 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INT AUTO_INCREMENT NOT NULL, statut_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, subject VARCHAR(100) NOT NULL, hoursappointment DATETIME NOT NULL, archived TINYINT(1) DEFAULT NULL, INDEX IDX_FE38F844F6203804 (statut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointment_user (appointment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9E501E88E5B533F9 (appointment_id), INDEX IDX_9E501E88A76ED395 (user_id), PRIMARY KEY(appointment_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE customer (id INT AUTO_INCREMENT NOT NULL, task_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, archived TINYINT(1) DEFAULT NULL, INDEX IDX_81398E098DB60186 (task_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, enterprise VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, archived TINYINT(1) DEFAULT NULL, INDEX IDX_6B71CBF46BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_user (quote_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1F7489C3DB805178 (quote_id), INDEX IDX_1F7489C3A76ED395 (user_id), PRIMARY KEY(quote_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, sub_subject1 VARCHAR(255) DEFAULT NULL, sub_subject2 VARCHAR(255) DEFAULT NULL, sub_subject3 VARCHAR(255) DEFAULT NULL, archived TINYINT(1) DEFAULT NULL, INDEX IDX_527EDB256BF700BD (status_id), INDEX IDX_527EDB259395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task_user (task_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_FE2042328DB60186 (task_id), INDEX IDX_FE204232A76ED395 (user_id), PRIMARY KEY(task_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task2 (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, sub_subject1 VARCHAR(255) DEFAULT NULL, sub_subject2 VARCHAR(255) DEFAULT NULL, sub_subject3 VARCHAR(255) DEFAULT NULL, archived TINYINT(1) DEFAULT NULL, INDEX IDX_518314916BF700BD (status_id), INDEX IDX_518314919395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task2_user (task2_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A378A1F6C08F1269 (task2_id), INDEX IDX_A378A1F6A76ED395 (user_id), PRIMARY KEY(task2_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844F6203804 FOREIGN KEY (statut_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE appointment_user ADD CONSTRAINT FK_9E501E88E5B533F9 FOREIGN KEY (appointment_id) REFERENCES appointment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointment_user ADD CONSTRAINT FK_9E501E88A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE customer ADD CONSTRAINT FK_81398E098DB60186 FOREIGN KEY (task_id) REFERENCES task (id)');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF46BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE quote_user ADD CONSTRAINT FK_1F7489C3DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote_user ADD CONSTRAINT FK_1F7489C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB259395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE2042328DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task_user ADD CONSTRAINT FK_FE204232A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314916BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314919395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE task2_user ADD CONSTRAINT FK_A378A1F6C08F1269 FOREIGN KEY (task2_id) REFERENCES task2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2_user ADD CONSTRAINT FK_A378A1F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment_user DROP FOREIGN KEY FK_9E501E88E5B533F9');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB259395C3F3');
        $this->addSql('ALTER TABLE task2 DROP FOREIGN KEY FK_518314919395C3F3');
        $this->addSql('ALTER TABLE quote_user DROP FOREIGN KEY FK_1F7489C3DB805178');
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844F6203804');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF46BF700BD');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256BF700BD');
        $this->addSql('ALTER TABLE task2 DROP FOREIGN KEY FK_518314916BF700BD');
        $this->addSql('ALTER TABLE customer DROP FOREIGN KEY FK_81398E098DB60186');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE2042328DB60186');
        $this->addSql('ALTER TABLE task2_user DROP FOREIGN KEY FK_A378A1F6C08F1269');
        $this->addSql('ALTER TABLE appointment_user DROP FOREIGN KEY FK_9E501E88A76ED395');
        $this->addSql('ALTER TABLE quote_user DROP FOREIGN KEY FK_1F7489C3A76ED395');
        $this->addSql('ALTER TABLE reset_password_request DROP FOREIGN KEY FK_7CE748AA76ED395');
        $this->addSql('ALTER TABLE task_user DROP FOREIGN KEY FK_FE204232A76ED395');
        $this->addSql('ALTER TABLE task2_user DROP FOREIGN KEY FK_A378A1F6A76ED395');
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE appointment_user');
        $this->addSql('DROP TABLE customer');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_user');
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE task');
        $this->addSql('DROP TABLE task_user');
        $this->addSql('DROP TABLE task2');
        $this->addSql('DROP TABLE task2_user');
        $this->addSql('DROP TABLE user');
    }
}
