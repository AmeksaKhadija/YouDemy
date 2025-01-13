CREATE DATABASE Youdemy;


use Youdemy;


CREATE TABLE roles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    role_name VARCHAR(25) UNIQUE,
    role_description TEXT
)ENGINE=INNODB;

CREATE TABLE users(
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(30),
    lastname VARCHAR(30),
    email VARCHAR(50) UNIQUE,
    password VARCHAR(50),
    phone VARCHAR(20),
    status VARCHAR(30),
    role_id INT,
    Foreign Key (role_id) REFERENCES roles(id)
)ENGINE=INNODB;

CREATE TABLE categories(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR (50) UNIQUE,
    description TEXT
)ENGINE=INNODB;

CREATE TABLE tags(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name  VARCHAR(35) UNIQUE,
    description TEXT
)ENGINE=INNODB;

CREATE TABLE courses(
    id INT PRIMARY KEY AUTO_INCREMENT,
    titre VARCHAR(30),
    description_courte VARCHAR(255),
    description TEXT,
    contenu VARCHAR(255),
    categorie_id INT,
    enseignant_id INT,
    Foreign Key (categorie_id) REFERENCES categories(id),
    Foreign Key (enseignant_id) REFERENCES users(id)
)ENGINE=INNODB;

CREATE TABLE inscription (
    course_id INT,
    FOREIGN KEY (course_id) REFERENCES courses (id),
    etudiant_id INT,
    FOREIGN KEY (etudiant_id) REFERENCES users (id),
    PRIMARY KEY (course_id, etudiant_id)
) ENGINE = INNODB;


CREATE TABLE tag_course(
    course_id INT,
     FOREIGN KEY (course_id) REFERENCES courses(id),
    tag_id INT, 
     FOREIGN KEY  (tag_id) REFERENCES tags(id),
     PRIMARY KEY (course_id, tag_id)
)ENGINE=INNODB;

