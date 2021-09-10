<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210906141926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844F6203804');
        $this->addSql('ALTER TABLE quote DROP FOREIGN KEY FK_6B71CBF46BF700BD');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB256BF700BD');
        $this->addSql('ALTER TABLE task2 DROP FOREIGN KEY FK_518314916BF700BD');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP INDEX IDX_FE38F844F6203804 ON appointment');
        $this->addSql('ALTER TABLE appointment DROP statut_id');
        $this->addSql('DROP INDEX IDX_6B71CBF46BF700BD ON quote');
        $this->addSql('ALTER TABLE quote DROP status_id, DROP comment');
        $this->addSql('DROP INDEX IDX_527EDB256BF700BD ON task');
        $this->addSql('ALTER TABLE task DROP status_id, DROP comment');
        $this->addSql('DROP INDEX IDX_518314916BF700BD ON task2');
        $this->addSql('ALTER TABLE task2 DROP status_id, DROP comment');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appointment ADD statut_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844F6203804 FOREIGN KEY (statut_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_FE38F844F6203804 ON appointment (statut_id)');
        $this->addSql('ALTER TABLE quote ADD status_id INT DEFAULT NULL, ADD comment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF46BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_6B71CBF46BF700BD ON quote (status_id)');
        $this->addSql('ALTER TABLE task ADD status_id INT DEFAULT NULL, ADD comment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB256BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_527EDB256BF700BD ON task (status_id)');
        $this->addSql('ALTER TABLE task2 ADD status_id INT DEFAULT NULL, ADD comment VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314916BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('CREATE INDEX IDX_518314916BF700BD ON task2 (status_id)');
    }
}
