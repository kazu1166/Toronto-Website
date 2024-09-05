use toronto_web;

CREATE TABLE attractions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50),
    highlights TEXT,
    activities TEXT,
    price_range VARCHAR(50),
    duration VARCHAR(50),
    address VARCHAR(255),
    nearest_station VARCHAR(100),
    travel_time_king VARCHAR(50),
    travel_time_bloor_yonge VARCHAR(50),
    taxi_time_king VARCHAR(50)
);

INSERT INTO attractions (name, category, highlights, activities, price_range, duration, address, nearest_station, travel_time_king, travel_time_bloor_yonge, taxi_time_king)
VALUES 
-- 見る
('CNタワー', '見る', 'トロントのランドマークで、世界有数の高さを誇るタワー。ガラスの床や展望デッキからの景色が圧巻。', '展望デッキ、エッジウォーク、回転レストラン「360」での食事', '$40-$75', '2-3時間', '290 Bremner Blvd, Toronto, ON M5V 3L9', 'Union駅（徒歩10分）', '徒歩10分', 'サブウェイで約15分', '約5分'),
('カサ・ロマ', '見る', 'トロント唯一の城で、ヨーロッパの宮殿のような雰囲気が魅力的。豪華なインテリアや庭園が見どころ。', '城内見学、庭園散策、ガイドツアー', '$30-$40', '2-3時間', '1 Austin Terrace, Toronto, ON M5R 1X8', 'Dupont駅（徒歩10分）', 'サブウェイで約20分', 'サブウェイで約10分', '約15分'),
('ネイサン・フィリップス・スクエア', '見る', 'トロント市庁舎前に広がる広場で、四季折々のイベントが開催される。冬にはスケートリンク、夏には噴水が人気。', 'スケートリンク、イベント観覧、写真撮影', '入場無料', '1-2時間', '100 Queen St W, Toronto, ON M5H 2N2', 'Queen駅（徒歩5分）', '徒歩10分', 'サブウェイで約10分', '約5分'),
('ダンダス・スクエア', '見る', 'トロントのタイムズスクエアとも呼ばれる賑やかな広場で、イベントやライブが頻繁に行われる。', 'イベント観覧、ショッピング、写真撮影', '入場無料', '1-2時間', '1 Dundas St E, Toronto, ON M5B 2R8', 'Dundas駅（徒歩1分）', 'サブウェイで約5分', 'サブウェイで約3分', '約7分'),

-- 買い物する
('イートンセンター', '買い物する', 'トロント最大のショッピングモールで、国内外のブランドショップが多数入っている。', 'ショッピング、レストランでの食事', '入場無料', '2-4時間', '220 Yonge St, Toronto, ON M5B 2H1', 'Dundas駅（徒歩3分）', 'サブウェイで約5分', 'サブウェイで約3分', '約7分'),
('セント・ローレンス・マーケット', '買い物する', 'トロント市民に愛される歴史ある市場で、新鮮な食材やお土産、カナダ産の特産品が購入できる。フードコートも充実。', '食材やお土産のショッピング、フードコートでの食事', '入場無料', '1-2時間', '93 Front St E, Toronto, ON M5E 1C3', 'King駅（徒歩10分）', '徒歩10分', 'サブウェイで約15分', '約5分'),
('ケンジントンマーケット', '買い物する', '多国籍な雰囲気が漂うマーケットで、ヴィンテージショップやインディペンデントのカフェが立ち並び、ユニークな体験ができる。', 'ショッピング、カフェでの休憩、ストリートアート巡り', '入場無料', '2-3時間', 'Kensington Ave, Toronto, ON M5T 2J7', 'Spadina駅（徒歩15分）', 'サブウェイで約20分', 'サブウェイで約25分', '約15分'),

-- 散策する
('トロントアイランド', '散策する', '都会の喧騒から離れてリラックスできる場所。ビーチや公園、展望ポイントからトロントのスカイラインを楽しめます。', 'サイクリング、ピクニック、ビーチでのんびり、ボートレンタル', 'フェリー往復 $8-$11', '3-5時間', '9 Queens Quay W, Toronto, ON M5J 2H3（フェリー乗り場）', 'Union駅（徒歩10分）', '徒歩10分', 'サブウェイで約15分', '約5分'),
('ディスティラリー地区', '散策する', '19世紀の建物が立ち並ぶ歴史的地区で、アートギャラリーやカフェ、ショップが充実。特にクリスマスマーケットが人気。', 'ショッピング、アートギャラリー巡り、レストランでの食事', '入場無料', '1-3時間', '55 Mill St, Toronto, ON M5A 3C4', 'King St E at Parliament St（徒歩5分）', '徒歩10分', 'サブウェイで約20分', '約10分');

ALTER TABLE attractions ADD COLUMN google_map VARCHAR(255);

UPDATE attractions SET google_map = 'https://maps.app.goo.gl/rD9Nk38B6k4Nkhqj7' WHERE name = 'CNタワー';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/durywfqhwShNGLzz5' WHERE name = 'カサ・ロマ';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/qetybpxhkFZaeeue8' WHERE name = 'ネイサン・フィリップス・スクエア';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/E2dW55EbKFYiZVrm9' WHERE name = 'ダンダス・スクエア';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/8N4k9V92GgeQKbCb6' WHERE name = 'イートンセンター';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/seaMyoYo6doRpvou6' WHERE name = 'セント・ローレンス・マーケット';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/fooYhPjtLHzURAiT7' WHERE name = 'ケンジントンマーケット';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/vXGVc1DfgC5DPmzE6' WHERE name = 'トロントアイランド';
UPDATE attractions SET google_map = 'https://maps.app.goo.gl/ZXc2c8Bqphdnja449' WHERE name = 'ディスティラリー地区';


SET SQL_SAFE_UPDATES = 0;
SET SQL_SAFE_UPDATES =1;

ALTER TABLE attractions
ADD COLUMN latitude DECIMAL(10, 7),
ADD COLUMN longitude DECIMAL(10, 7);

select name, address from attractions;

UPDATE attractions SET latitude = 43.642429, longitude = -79.3869824 WHERE name = 'CNタワー';
UPDATE attractions SET latitude = 43.67804230000001, longitude = -79.4094106 WHERE name = 'カサ・ロマ';
UPDATE attractions SET latitude = 43.6534249, longitude = -79.3840823 WHERE name = 'ネイサン・フィリップス・スクエア';
UPDATE attractions SET latitude = 43.6562208, longitude = -79.38063939999999 WHERE name = 'ダンダス・スクエア';
UPDATE attractions SET latitude = 43.6539681, longitude = -79.3801225 WHERE name = 'イートンセンター';
UPDATE attractions SET latitude = 43.6486879, longitude = -79.3715454 WHERE name = 'セント・ローレンス・マーケット';
UPDATE attractions SET latitude = 43.6532548, longitude = -79.4001303 WHERE name = 'ケンジントンマーケット';
UPDATE attractions SET latitude = 43.6404493, longitude = -79.37501999999999 WHERE name = 'トロントアイランド';
UPDATE attractions SET latitude = 43.6503312, longitude = -79.3598142 WHERE name = 'ディスティラリー地区';