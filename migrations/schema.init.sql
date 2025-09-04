
CREATE TABLE IF NOT EXISTS category
(
    id INT NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'Название категории',
    description TEXT COMMENT 'Описание категории',
    is_active TINYINT DEFAULT 1 NOT NULL COMMENT 'Флаг активности',
    PRIMARY KEY(id)
)
DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
COMMENT 'Категории';

--

CREATE TABLE IF NOT EXISTS product
(
    id INT NOT NULL AUTO_INCREMENT,
    uuid VARCHAR(36) NOT NULL COMMENT 'UUID товара',
    category_id INT NOT NULL COMMENT 'Категория товара',
    is_active TINYINT DEFAULT 1 NOT NULL COMMENT 'Флаг активности',
    name VARCHAR(255) NOT NULL COMMENT 'Название товара',
    description TEXT COMMENT 'Описание товара',
    thumbnail VARCHAR(255) COMMENT 'Ссылка на картинку',
    price DECIMAL(10, 2) NOT NULL COMMENT 'Цена',
    INDEX IDX_31C154878BAC62AF (category_id),
    PRIMARY KEY(id)
)
DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
COMMENT 'Товары';

CREATE UNIQUE INDEX uuid_unique_key ON products (uuid);
ALTER TABLE product ADD CONSTRAINT IDX_31C154878BAC62AF FOREIGN KEY (category_id) REFERENCES category (id)
