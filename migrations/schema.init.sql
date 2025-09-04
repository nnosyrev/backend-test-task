CREATE TABLE IF NOT EXISTS products
(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uuid VARCHAR(36) NOT NULL COMMENT 'UUID товара',
    category VARCHAR(255) NOT NULL COMMENT 'Категория товара',
    is_active TINYINT DEFAULT 1 NOT NULL COMMENT 'Флаг активности',
    name VARCHAR(255) NOT NULL COMMENT 'Название товара',
    description TEXT COMMENT 'Описание товара',
    thumbnail VARCHAR(255) COMMENT 'Ссылка на картинку',
    price DECIMAL(10, 2) NOT NULL COMMENT 'Цена'
)
DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
COMMENT 'Товары';

CREATE UNIQUE INDEX uuid_unique_key ON products (uuid);
