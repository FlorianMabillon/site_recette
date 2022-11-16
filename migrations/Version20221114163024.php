<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114163024 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient ADD ingredient_recipe_id INT NOT NULL');
        $this->addSql('ALTER TABLE ingredient ADD CONSTRAINT FK_6BAF787053AA0A63 FOREIGN KEY (ingredient_recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_6BAF787053AA0A63 ON ingredient (ingredient_recipe_id)');
        $this->addSql('ALTER TABLE recipe ADD recipe_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137EB8ADDD5 FOREIGN KEY (recipe_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137EB8ADDD5 ON recipe (recipe_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ingredient DROP FOREIGN KEY FK_6BAF787053AA0A63');
        $this->addSql('DROP INDEX IDX_6BAF787053AA0A63 ON ingredient');
        $this->addSql('ALTER TABLE ingredient DROP ingredient_recipe_id');
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137EB8ADDD5');
        $this->addSql('DROP INDEX IDX_DA88B137EB8ADDD5 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP recipe_user_id');
    }
}
