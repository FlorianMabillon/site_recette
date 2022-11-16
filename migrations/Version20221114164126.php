<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114164126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD ingredient_name VARCHAR(255) NOT NULL, ADD quantity VARCHAR(75) NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD recipe_name VARCHAR(255) NOT NULL, ADD number_person INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP ingredient_name, DROP quantity');
        $this->addSql('ALTER TABLE recipe DROP recipe_name, DROP number_person');
    }
}
