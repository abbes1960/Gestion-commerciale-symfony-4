<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191126144852 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, libelle VARCHAR(50) NOT NULL, responsable VARCHAR(50) NOT NULL, adresse VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, tel VARCHAR(50) NOT NULL, portable VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, matfisc VARCHAR(50) NOT NULL, cin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numc VARCHAR(50) NOT NULL, datecomm DATE NOT NULL, observation VARCHAR(50) NOT NULL, totht VARCHAR(50) NOT NULL, tottva VARCHAR(50) NOT NULL, totttc VARCHAR(50) NOT NULL, INDEX IDX_6EEAA67D19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compteur (id INT AUTO_INCREMENT NOT NULL, numcom INT NOT NULL, numl VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, base0 VARCHAR(50) NOT NULL, base1 VARCHAR(50) NOT NULL, tva1 VARCHAR(50) NOT NULL, base2 VARCHAR(50) NOT NULL, tva2 VARCHAR(50) NOT NULL, base3 VARCHAR(50) NOT NULL, tva3 VARCHAR(50) NOT NULL, totht VARCHAR(50) NOT NULL, totrem VARCHAR(50) NOT NULL, tottva VARCHAR(50) NOT NULL, timbre VARCHAR(50) NOT NULL, tottc VARCHAR(50) NOT NULL, rs VARCHAR(50) NOT NULL, montrs VARCHAR(5) NOT NULL, net VARCHAR(50) NOT NULL, INDEX IDX_FE86641019EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fornisseur (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(50) NOT NULL, libelle VARCHAR(50) NOT NULL, responsable VARCHAR(50) NOT NULL, adresse VARCHAR(50) NOT NULL, ville VARCHAR(50) NOT NULL, tel VARCHAR(50) NOT NULL, portable VARCHAR(50) NOT NULL, email VARCHAR(50) NOT NULL, matfisc VARCHAR(50) NOT NULL, cin VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lcommande (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, numc VARCHAR(50) NOT NULL, pv VARCHAR(50) NOT NULL, qte VARCHAR(50) NOT NULL, tva VARCHAR(50) NOT NULL, lig VARCHAR(50) NOT NULL, INDEX IDX_57961F0AF347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, numl VARCHAR(50) NOT NULL, observation VARCHAR(50) NOT NULL, totht VARCHAR(50) NOT NULL, tottva VARCHAR(50) NOT NULL, totttc VARCHAR(50) NOT NULL, dateliv VARCHAR(50) NOT NULL, INDEX IDX_A60C9F1F19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE llivraison (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, numl VARCHAR(50) NOT NULL, pv VARCHAR(50) NOT NULL, qte VARCHAR(50) NOT NULL, tva VARCHAR(50) NOT NULL, lig INT NOT NULL, INDEX IDX_68540739F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, famille_id INT NOT NULL, libelle VARCHAR(50) NOT NULL, pa DOUBLE PRECISION NOT NULL, pv DOUBLE PRECISION NOT NULL, tva INT NOT NULL, stock INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC2797A77B84 (famille_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reglement (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, modereg VARCHAR(50) NOT NULL, montant VARCHAR(50) NOT NULL, numpiece VARCHAR(50) NOT NULL, echeance VARCHAR(50) NOT NULL, INDEX IDX_EBE4C14C19EB6921 (client_id), INDEX IDX_EBE4C14C7F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(50) NOT NULL, login VARCHAR(50) NOT NULL, pwd VARCHAR(50) NOT NULL, role VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE facture ADD CONSTRAINT FK_FE86641019EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE lcommande ADD CONSTRAINT FK_57961F0AF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE llivraison ADD CONSTRAINT FK_68540739F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC2797A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE reglement ADD CONSTRAINT FK_EBE4C14C7F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D19EB6921');
        $this->addSql('ALTER TABLE facture DROP FOREIGN KEY FK_FE86641019EB6921');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F19EB6921');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C19EB6921');
        $this->addSql('ALTER TABLE reglement DROP FOREIGN KEY FK_EBE4C14C7F2DEE08');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC2797A77B84');
        $this->addSql('ALTER TABLE lcommande DROP FOREIGN KEY FK_57961F0AF347EFB');
        $this->addSql('ALTER TABLE llivraison DROP FOREIGN KEY FK_68540739F347EFB');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE compteur');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE fornisseur');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE lcommande');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE llivraison');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reglement');
        $this->addSql('DROP TABLE user');
    }
}
