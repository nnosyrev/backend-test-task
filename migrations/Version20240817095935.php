<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240817095935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT NOT NULL AUTO_INCREMENT, name VARCHAR(255) NOT NULL COMMENT \'Название категории\', description TEXT COMMENT \'Описание категории\', is_active TINYINT DEFAULT 1 NOT NULL COMMENT \'Флаг активности\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT \'Категории\'');
        $this->addSql('CREATE TABLE IF NOT EXISTS product (id INT NOT NULL AUTO_INCREMENT, uuid VARCHAR(36) NOT NULL COMMENT \'UUID товара\', category_id INT NOT NULL COMMENT \'Категория товара\', is_active TINYINT DEFAULT 1 NOT NULL COMMENT \'Флаг активности\', name VARCHAR(255) NOT NULL COMMENT \'Название товара\', description TEXT COMMENT \'Описание товара\', thumbnail VARCHAR(255) COMMENT \'Ссылка на картинку\', price DECIMAL(10, 2) NOT NULL COMMENT \'Цена\', INDEX IDX_31C154878BAC62AF (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT \'Товары\'');
        $this->addSql('CREATE UNIQUE INDEX IDX_461A3F1E549213EC ON products (uuid)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT IDX_31C154878BAC62AF FOREIGN KEY (category_id) REFERENCES category (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY IDX_31C154878BAC62AF');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE category');
    }
}
