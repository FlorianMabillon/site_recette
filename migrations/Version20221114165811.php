<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221114165811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE step (id INT AUTO_INCREMENT NOT NULL, step_recipe_id INT NOT NULL, text VARCHAR(500) NOT NULL, INDEX IDX_43B9FE3C84E5DBDF (step_recipe_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE step ADD CONSTRAINT FK_43B9FE3C84E5DBDF FOREIGN KEY (step_recipe_id) REFERENCES recipe (id)');
        $this->addSql('ALTER TABLE comment ADD comment_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C541DB185 FOREIGN KEY (comment_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_9474526C541DB185 ON comment (comment_user_id)');
        $this->addSql('ALTER TABLE mark ADD mark_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE mark ADD CONSTRAINT FK_6674F271C6FC452C FOREIGN KEY (mark_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6674F271C6FC452C ON mark (mark_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE step DROP FOREIGN KEY FK_43B9FE3C84E5DBDF');
        $this->addSql('DROP TABLE step');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C541DB185');
        $this->addSql('DROP INDEX IDX_9474526C541DB185 ON comment');
        $this->addSql('ALTER TABLE comment DROP comment_user_id');
        $this->addSql('ALTER TABLE mark DROP FOREIGN KEY FK_6674F271C6FC452C');
        $this->addSql('DROP INDEX IDX_6674F271C6FC452C ON mark');
        $this->addSql('ALTER TABLE mark DROP mark_user_id');
    }
}
