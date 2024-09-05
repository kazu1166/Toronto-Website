use toronto_web;

CREATE TABLE english (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    highlights TEXT,
    content TEXT,
    url VARCHAR(255)
);

INSERT INTO english (name, category, highlights, content, url)
VALUES 
();

drop table english;