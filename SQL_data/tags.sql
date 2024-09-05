CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

delete from tags where id = 16;



select * from tags;

SET SQL_SAFE_UPDATES = 0;
SET SQL_SAFE_UPDATES = 1;

