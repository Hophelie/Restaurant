<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102122821 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_products ADD produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande_products ADD CONSTRAINT FK_659A42C0F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('CREATE INDEX IDX_659A42C0F347EFB ON commande_products (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_products DROP FOREIGN KEY FK_659A42C0F347EFB');
        $this->addSql('DROP INDEX IDX_659A42C0F347EFB ON commande_products');
        $this->addSql('ALTER TABLE commande_products DROP produit_id');
    }
}
