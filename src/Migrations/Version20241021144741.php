<?php

declare(strict_types=1);

namespace GriffePhotos\OptionDependencyPlugin\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241021144741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE GriffePhotos_option_dependency (id INT AUTO_INCREMENT NOT NULL, parentOption_id INT NOT NULL, parentOptionValue_id INT NOT NULL, childOption_id INT NOT NULL, INDEX IDX_828EBF8C9438767D (parentOption_id), INDEX IDX_828EBF8CD2587498 (parentOptionValue_id), INDEX IDX_828EBF8C81F2A708 (childOption_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE GriffePhotos_option_dependency ADD CONSTRAINT FK_828EBF8C9438767D FOREIGN KEY (parentOption_id) REFERENCES sylius_product_option (id)');
        $this->addSql('ALTER TABLE GriffePhotos_option_dependency ADD CONSTRAINT FK_828EBF8CD2587498 FOREIGN KEY (parentOptionValue_id) REFERENCES sylius_product_option_value (id)');
        $this->addSql('ALTER TABLE GriffePhotos_option_dependency ADD CONSTRAINT FK_828EBF8C81F2A708 FOREIGN KEY (childOption_id) REFERENCES sylius_product_option (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE GriffePhotos_option_dependency DROP FOREIGN KEY FK_828EBF8C9438767D');
        $this->addSql('ALTER TABLE GriffePhotos_option_dependency DROP FOREIGN KEY FK_828EBF8CD2587498');
        $this->addSql('ALTER TABLE GriffePhotos_option_dependency DROP FOREIGN KEY FK_828EBF8C81F2A708');
        $this->addSql('DROP TABLE GriffePhotos_option_dependency');
    }
}
