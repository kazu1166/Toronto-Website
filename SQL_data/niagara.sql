CREATE TABLE niagara (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    highlights TEXT,
    price_range VARCHAR(50),
    duration VARCHAR(50),
    address VARCHAR(255),
    map_link VARCHAR(255),
    latitude DECIMAL(9,6),
    longitude DECIMAL(9,6),
    web_link VARCHAR(255)
);
