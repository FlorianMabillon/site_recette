<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115170427 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD comment_recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB0A64342 FOREIGN KEY (comment_recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_9474526CB0A64342 ON comment (comment_recipe_id)');
        $this->addSql('ALTER TABLE mark ADD mark_recipe_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE mark ADD CONSTRAINT FK_6674F27175B3E006 FOREIGN KEY (mark_recipe_id) REFERENCES recipe (id)');
        $this->addSql('CREATE INDEX IDX_6674F27175B3E006 ON mark (mark_recipe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB0A64342');
        $this->addSql('DROP INDEX IDX_9474526CB0A64342 ON comment');
        $this->addSql('ALTER TABLE comment DROP comment_recipe_id');
        $this->addSql('ALTER TABLE mark DROP FOREIGN KEY FK_6674F27175B3E006');
        $this->addSql('DROP INDEX IDX_6674F27175B3E006 ON mark');
        $this->addSql('ALTER TABLE mark DROP mark_recipe_id');
    }
}
