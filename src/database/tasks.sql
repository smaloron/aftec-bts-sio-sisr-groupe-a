USE aftec;

CREATE TABLE IF NOT EXISTS tasks (
    id INT UNSIGNED AUTO_INCREMENT,
    taskname VARCHAR(50) NOT NULL,
    done TINYINT UNSIGNED NOT NULL DEFAULT 0,
    user_id INT UNSIGNED,
    PRIMARY KEY (id)
);

INSERT INTO tasks (taskname, user_id, done)
VALUES
('Voler les pommes du jardin des Espérides', 1, 0),
('Délivrer Thésée des enfers', 1, 0),
('Tuer l\'hydre de Lerne', 1, 0),
('Copier l'Internet sur ma clef usb', 2, 0),
('Prendre un café ce matin', 2, 1);