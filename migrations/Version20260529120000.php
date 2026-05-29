<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260529120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Ajout des metadonnees de file asynchrone pour les telechargements PDF';
    }

    public function up(Schema $schema): void
    {
        $this->addSql("ALTER TABLE file ADD status VARCHAR(20) DEFAULT 'queued' NOT NULL, ADD size INT DEFAULT NULL, ADD error_message LONGTEXT DEFAULT NULL");
        $this->addSql("UPDATE file SET status = 'done' WHERE status IS NULL OR status = ''");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE file DROP status, DROP size, DROP error_message');
    }
}
