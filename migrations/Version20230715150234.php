<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230715150234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD bith_date VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE post CHANGE additional_info additional_info VARCHAR(30000) DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD posts VARCHAR(20000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP bith_date');
        $this->addSql('ALTER TABLE post CHANGE additional_info additional_info MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP posts');
    }
}
