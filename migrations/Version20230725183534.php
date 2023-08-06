<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230725183534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD userid_id INT DEFAULT NULL, CHANGE additional_info additional_info VARCHAR(30000) DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D58E0A285 FOREIGN KEY (userid_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D58E0A285 ON post (userid_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D58E0A285');
        $this->addSql('DROP INDEX IDX_5A8A6C8D58E0A285 ON post');
        $this->addSql('ALTER TABLE post DROP userid_id, CHANGE additional_info additional_info MEDIUMTEXT DEFAULT NULL');
    }
}
