<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511142611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task2_user (task2_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A378A1F6C08F1269 (task2_id), INDEX IDX_A378A1F6A76ED395 (user_id), PRIMARY KEY(task2_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task2_user ADD CONSTRAINT FK_A378A1F6C08F1269 FOREIGN KEY (task2_id) REFERENCES task2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2_user ADD CONSTRAINT FK_A378A1F6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2 ADD status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314916BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_518314916BF700BD ON task2 (status_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE task2_user');
        $this->addSql('ALTER TABLE task2 DROP FOREIGN KEY FK_518314916BF700BD');
        $this->addSql('DROP INDEX IDX_518314916BF700BD ON task2');
        $this->addSql('ALTER TABLE task2 DROP status_id');
    }
}
