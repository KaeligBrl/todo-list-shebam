<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511141944 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE task2_status');
        $this->addSql('ALTER TABLE task2 DROP FOREIGN KEY FK_518314919395C3F3');
        $this->addSql('DROP INDEX IDX_518314919395C3F3 ON task2');
        $this->addSql('ALTER TABLE task2 DROP customer_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task2_status (task2_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_D63C1D1FC08F1269 (task2_id), INDEX IDX_D63C1D1F6BF700BD (status_id), PRIMARY KEY(task2_id, status_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE task2_status ADD CONSTRAINT FK_D63C1D1F6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2_status ADD CONSTRAINT FK_D63C1D1FC08F1269 FOREIGN KEY (task2_id) REFERENCES task2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2 ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314919395C3F3 FOREIGN KEY (customer_id) REFERENCES tache (id)');
        $this->addSql('CREATE INDEX IDX_518314919395C3F3 ON task2 (customer_id)');
    }
}
