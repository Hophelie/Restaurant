<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220109131736 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_products ADD commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande_products ADD CONSTRAINT FK_659A42C082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_659A42C082EA2E54 ON commande_products (commande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_products DROP FOREIGN KEY FK_659A42C082EA2E54');
        $this->addSql('DROP INDEX IDX_659A42C082EA2E54 ON commande_products');
        $this->addSql('ALTER TABLE commande_products DROP commande_id');
    }
}
