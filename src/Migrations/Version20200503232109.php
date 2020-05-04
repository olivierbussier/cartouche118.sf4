<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200503232109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, nom VARCHAR(255) NOT NULL, adresse1 VARCHAR(255) NOT NULL, adresse2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, bp VARCHAR(255) DEFAULT NULL, region VARCHAR(255) DEFAULT NULL, INDEX IDX_C35F081619EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog (id INT AUTO_INCREMENT NOT NULL, posted_at DATETIME NOT NULL, position INT NOT NULL, title VARCHAR(255) NOT NULL, headline LONGTEXT DEFAULT NULL, content LONGTEXT DEFAULT NULL, type VARCHAR(32) NOT NULL, link VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie_produit (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT NOT NULL, nom VARCHAR(255) NOT NULL, tva NUMERIC(10, 2) NOT NULL, INDEX IDX_76264285670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, prenom VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) DEFAULT NULL, full_name VARCHAR(255) DEFAULT NULL, additional VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, deleted TINYINT(1) NOT NULL, organization VARCHAR(255) DEFAULT NULL, prefix VARCHAR(255) DEFAULT NULL, suffix VARCHAR(255) DEFAULT NULL, titre VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client_client (client_source INT NOT NULL, client_target INT NOT NULL, INDEX IDX_92E24FE6A2C34C0 (client_source), INDEX IDX_92E24FE613C9644F (client_target), PRIMARY KEY(client_source, client_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_at DATETIME NOT NULL, reference VARCHAR(255) NOT NULL, prix_ht NUMERIC(10, 2) NOT NULL, prix_ttc NUMERIC(10, 2) NOT NULL, eco_ht NUMERIC(10, 2) NOT NULL, eco_ttc NUMERIC(10, 2) NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, nom VARCHAR(255) NOT NULL, label VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_E7927C7419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adresse VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligne_commande (id INT AUTO_INCREMENT NOT NULL, produit_id INT NOT NULL, commande_id INT NOT NULL, created_at DATETIME NOT NULL, quantite NUMERIC(10, 2) NOT NULL, remise_type VARCHAR(255) NOT NULL, remise NUMERIC(10, 2) NOT NULL, INDEX IDX_3170B74BF347EFB (produit_id), INDEX IDX_3170B74B82EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE marque (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, created_at DATETIME NOT NULL, text LONGTEXT DEFAULT NULL, INDEX IDX_CFBDFA1419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorie_produit_id INT NOT NULL, marque_id INT NOT NULL, fournisseur_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prix_ht NUMERIC(10, 2) NOT NULL, marge NUMERIC(10, 2) NOT NULL, code VARCHAR(255) NOT NULL, caract1 VARCHAR(255) DEFAULT NULL, caract2 VARCHAR(255) DEFAULT NULL, caract3 VARCHAR(255) DEFAULT NULL, INDEX IDX_29A5EC2791FDB457 (categorie_produit_id), INDEX IDX_29A5EC274827B9B2 (marque_id), INDEX IDX_29A5EC27670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE remises_client (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, produit_id INT NOT NULL, remise NUMERIC(10, 2) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_DE4CF29219EB6921 (client_id), INDEX IDX_DE4CF292F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, adherent_id INT DEFAULT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_B63E2EC725F06C53 (adherent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taxe (id INT AUTO_INCREMENT NOT NULL, categorie_produit_id INT NOT NULL, nom VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, montant NUMERIC(10, 2) NOT NULL, INDEX IDX_56322FE991FDB457 (categorie_produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telephone (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, nom VARCHAR(255) NOT NULL, label VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) NOT NULL, INDEX IDX_450FF01019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081619EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE categorie_produit ADD CONSTRAINT FK_76264285670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE client_client ADD CONSTRAINT FK_92E24FE6A2C34C0 FOREIGN KEY (client_source) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client_client ADD CONSTRAINT FK_92E24FE613C9644F FOREIGN KEY (client_target) REFERENCES client (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE email ADD CONSTRAINT FK_E7927C7419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74BF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE ligne_commande ADD CONSTRAINT FK_3170B74B82EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2791FDB457 FOREIGN KEY (categorie_produit_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC274827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE remises_client ADD CONSTRAINT FK_DE4CF29219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE remises_client ADD CONSTRAINT FK_DE4CF292F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE roles ADD CONSTRAINT FK_B63E2EC725F06C53 FOREIGN KEY (adherent_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE taxe ADD CONSTRAINT FK_56322FE991FDB457 FOREIGN KEY (categorie_produit_id) REFERENCES categorie_produit (id)');
        $this->addSql('ALTER TABLE telephone ADD CONSTRAINT FK_450FF01019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2791FDB457');
        $this->addSql('ALTER TABLE taxe DROP FOREIGN KEY FK_56322FE991FDB457');
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081619EB6921');
        $this->addSql('ALTER TABLE client_client DROP FOREIGN KEY FK_92E24FE6A2C34C0');
        $this->addSql('ALTER TABLE client_client DROP FOREIGN KEY FK_92E24FE613C9644F');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE email DROP FOREIGN KEY FK_E7927C7419EB6921');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1419EB6921');
        $this->addSql('ALTER TABLE remises_client DROP FOREIGN KEY FK_DE4CF29219EB6921');
        $this->addSql('ALTER TABLE telephone DROP FOREIGN KEY FK_450FF01019EB6921');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74B82EA2E54');
        $this->addSql('ALTER TABLE categorie_produit DROP FOREIGN KEY FK_76264285670C757F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27670C757F');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC274827B9B2');
        $this->addSql('ALTER TABLE ligne_commande DROP FOREIGN KEY FK_3170B74BF347EFB');
        $this->addSql('ALTER TABLE remises_client DROP FOREIGN KEY FK_DE4CF292F347EFB');
        $this->addSql('ALTER TABLE roles DROP FOREIGN KEY FK_B63E2EC725F06C53');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE blog');
        $this->addSql('DROP TABLE categorie_produit');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE client_client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE email');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE ligne_commande');
        $this->addSql('DROP TABLE marque');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE remises_client');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE taxe');
        $this->addSql('DROP TABLE telephone');
        $this->addSql('DROP TABLE user');
    }
}
