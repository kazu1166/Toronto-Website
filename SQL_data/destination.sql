use toronto_web;

CREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    address VARCHAR(255),
    latitude DECIMAL(10, 7),
    longitude DECIMAL(10, 7)
);

INSERT INTO locations (name, description, address, latitude, longitude) VALUES
('トロントピアソン空港', 'カナダ最大の国際空港であり、トロントの主要な玄関口です。', '6301 Silver Dart Dr, Mississauga, ON L5P 1B2, Canada', 43.6809609, -79.61164579999999),
('ユニオン駅', 'トロントの主要な鉄道駅であり、国内外への交通のハブとなっています。', '65 Front St W, Toronto, ON M5J 1E6, Canada', 43.6450676, -79.3812245),
('キング駅', 'トロント中心部にあるTTCの地下鉄駅で、金融街やショッピングエリアに近接しています。', '3 King St E, Toronto, ON M5C 3C9, Canada', 43.6491169, -79.3776397),
('ホテル ヴィクトリア (Hotel Victoria)', 'トロント中心部に位置する歴史的なホテルで、観光やビジネスに便利です。', '56 Yonge St, Toronto, ON M5E 1G5, Canada', 43.6480319, -79.37809229999999),
('ナイアガラの滝（カナダ側）', '世界的に有名な観光地で、カナダ側からは最も美しい景色を楽しめます。', '6650 Niagara Pkwy, Niagara Falls, ON L2E 3E8, Canada', 43.079585, -79.07850359999999);

ALTER TABLE locations ADD COLUMN google_map VARCHAR(255);

UPDATE locations SET google_map = 'https://maps.app.goo.gl/zsZnWGRm8XPvrYNv7' WHERE name = 'トロントピアソン空港';
UPDATE locations SET google_map = 'https://maps.app.goo.gl/dGeYtjHm5msnsat98' WHERE name = 'ユニオン駅';
UPDATE locations SET google_map = 'https://maps.app.goo.gl/yPiyT8nohTyqHTWa7' WHERE name = 'キング駅';
UPDATE locations SET google_map = 'https://maps.app.goo.gl/jZtgxpf89aA21USk8' WHERE name = 'ホテル ヴィクトリア (Hotel Victoria)';
UPDATE locations SET google_map = 'https://maps.app.goo.gl/2jnCphKZ738WzQtG7' WHERE name = 'ナイアガラの滝（カナダ側）';


select * from locations;

SET SQL_SAFE_UPDATES = 0;
SET SQL_SAFE_UPDATES =1;
