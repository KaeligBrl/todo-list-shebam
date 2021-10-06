<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005152351 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task2_user DROP FOREIGN KEY FK_A378A1F6C08F1269');
        $this->addSql('DROP TABLE task2');
        $this->addSql('DROP TABLE task2_user');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task2 (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, object VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, archived TINYINT(1) DEFAULT NULL, position INT DEFAULT NULL, sub_object1 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, sub_object2 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, sub_object3 VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, p1 TINYINT(1) DEFAULT NULL, p2 TINYINT(1) DEFAULT NULL, INDEX IDX_518314919395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE task2_user (task2_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A378A1F6C08F1269 (task2_id), INDEX IDX_A378A1F6A76ED395 (user_id), PRIMARY KEY(task2_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314919395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE task2_user ADD CONSTRAINT FK_A378A1F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2_user ADD CONSTRAINT FK_A378A1F6C08F1269 FOREIGN KEY (task2_id) REFERENCES task2 (id) ON DELETE CASCADE');
    }
}
