<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220102121949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_products (id INT AUTO_INCREMENT NOT NULL, commande_id INT NOT NULL, quantite INT NOT NULL, INDEX IDX_659A42C082EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_products ADD CONSTRAINT FK_659A42C082EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE commande ADD restaurant_id INT NOT NULL, ADD user_commande_id INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D2BF1E7C1 FOREIGN KEY (user_commande_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67DB1E7706E ON commande (restaurant_id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D2BF1E7C1 ON commande (user_commande_id)');
        $this->addSql('ALTER TABLE produit ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_29A5EC27B1E7706E ON produit (restaurant_id)');
        $this->addSql('ALTER TABLE user ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B1E7706E ON user (restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE commande_products');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DB1E7706E');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D2BF1E7C1');
        $this->addSql('DROP INDEX IDX_6EEAA67DB1E7706E ON commande');
        $this->addSql('DROP INDEX IDX_6EEAA67D2BF1E7C1 ON commande');
        $this->addSql('ALTER TABLE commande DROP restaurant_id, DROP user_commande_id');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27B1E7706E');
        $this->addSql('DROP INDEX IDX_29A5EC27B1E7706E ON produit');
        $this->addSql('ALTER TABLE produit DROP restaurant_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B1E7706E');
        $this->addSql('DROP INDEX IDX_8D93D649B1E7706E ON user');
        $this->addSql('ALTER TABLE user DROP restaurant_id');
    }
}
