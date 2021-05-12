<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511151538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task2 ADD customer_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314919395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('CREATE INDEX IDX_518314919395C3F3 ON task2 (customer_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task2 DROP FOREIGN KEY FK_518314919395C3F3');
        $this->addSql('DROP INDEX IDX_518314919395C3F3 ON task2');
        $this->addSql('ALTER TABLE task2 DROP customer_id');
    }
}
