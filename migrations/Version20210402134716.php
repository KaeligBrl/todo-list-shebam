<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402134716 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quote (id INT AUTO_INCREMENT NOT NULL, status_id INT DEFAULT NULL, enterprise VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_6B71CBF46BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quote_user (quote_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_1F7489C3DB805178 (quote_id), INDEX IDX_1F7489C3A76ED395 (user_id), PRIMARY KEY(quote_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quote ADD CONSTRAINT FK_6B71CBF46BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE quote_user ADD CONSTRAINT FK_1F7489C3DB805178 FOREIGN KEY (quote_id) REFERENCES quote (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quote_user ADD CONSTRAINT FK_1F7489C3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quote_user DROP FOREIGN KEY FK_1F7489C3DB805178');
        $this->addSql('DROP TABLE quote');
        $this->addSql('DROP TABLE quote_user');
    }
}
