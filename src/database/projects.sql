USE aftec;

CREATE TABLE IF NOT EXISTS projects (
    id SMALLINT UNSIGNED AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);

INSERT INTO projects (name) VALUES
('Les douze travaux'), ('Etudes'), ('Voyage à Corfu');

ALTER TABLE tasks ADD COLUMN project_id SMALLINT UNSIGNED;


ALTER TABLE tasks ADD CONSTRAINT task_to_project 
FOREIGN KEY(project_id) REFERENCES projects(id);


UPDATE tasks SET project_id=1 WHERE id=1;
UPDATE tasks SET project_id=1 WHERE id=2;
