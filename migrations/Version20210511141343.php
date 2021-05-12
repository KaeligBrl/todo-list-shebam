<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210511141343 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE task2 (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, subject VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_518314919395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task2_status (task2_id INT NOT NULL, status_id INT NOT NULL, INDEX IDX_D63C1D1FC08F1269 (task2_id), INDEX IDX_D63C1D1F6BF700BD (status_id), PRIMARY KEY(task2_id, status_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE task2 ADD CONSTRAINT FK_518314919395C3F3 FOREIGN KEY (customer_id) REFERENCES tache (id)');
        $this->addSql('ALTER TABLE task2_status ADD CONSTRAINT FK_D63C1D1FC08F1269 FOREIGN KEY (task2_id) REFERENCES task2 (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE task2_status ADD CONSTRAINT FK_D63C1D1F6BF700BD FOREIGN KEY (status_id) REFERENCES status (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task2_status DROP FOREIGN KEY FK_D63C1D1FC08F1269');
        $this->addSql('DROP TABLE task2');
        $this->addSql('DROP TABLE task2_status');
    }
}
