CREATE DATABASE IF NOT EXISTS nvworkflow;

USE nvworkflow;

CREATE TABLE IF NOT EXISTS admin (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY UNIQUE,
    name VARCHAR(100),
    lastname VARCHAR(100),
    email VARCHAR(200) UNIQUE,
    password VARCHAR(200),
    image VARCHAR(200),
    token VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS company (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    fantasy_name VARCHAR(100) NOT NULL,
    prefix VARCHAR(200) UNIQUE NOT NULL,
    cnpj VARCHAR(14) NOT NULL,
    image VARCHAR(200)
);

CREATE TABLE IF NOT EXISTS users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id INT(20) UNSIGNED,
    name VARCHAR(40),
    lastname VARCHAR(100),
    email VARCHAR(200),
    password VARCHAR(200),
    image VARCHAR(200),
    token VARCHAR(200),
    authorizations VARCHAR(200),
    FOREIGN KEY (company_id) REFERENCES company(id)
);

CREATE TABLE IF NOT EXISTS os (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    company_id INT UNSIGNED,
    user_id INT UNSIGNED,
    entry_obs TEXT,
    entry_date DATETIME,
    current_state VARCHAR(50),
    current_obs VARCHAR(500),
    delivery_obs TEXT,
    delivery_date DATETIME,
    technician VARCHAR(200),
    FOREIGN KEY (company_id) REFERENCES company(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS os_images (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    os_id INT UNSIGNED,
    image VARCHAR(200),
    image_date DATETIME,
    FOREIGN KEY (os_id) REFERENCES os(id)
);

CREATE TABLE IF NOT EXISTS os_videos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    os_id INT UNSIGNED,
    video VARCHAR(200),
    video_date DATETIME,
    FOREIGN KEY (os_id) REFERENCES os(id)
)