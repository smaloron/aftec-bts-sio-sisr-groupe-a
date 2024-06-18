CREATE DATABASE IF NOT EXISTS aftec DEFAULT CHARACTER SET "utf8";

USE aftec;

CREATE TABLE IF NOT EXISTS persons(
    id INT UNSIGNED AUTO_INCREMENT,
    person_name VARCHAR(30) NOT NULL,
    gender VARCHAR(10) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO persons (person_name, gender) VALUES
('Dorothea Lange', 'féminin'),
('André Kertesz', 'masculin'),
('Sabine Weiss', 'féminin'),
('Isadora Duncan', 'féminin'),
('Isaac Asimov', 'masculin');