drop table restaurants;

use toronto_web;

CREATE TABLE restaurants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    cuisine_type VARCHAR(100),
    highlights VARCHAR(255),
    recommended_dish VARCHAR(255),
    price_range VARCHAR(30),
    address VARCHAR(255),
    nearest_station VARCHAR(100),
    travel_time_king VARCHAR(50),
    taxi_time_king VARCHAR(50),
    section VARCHAR(50),
    sub_section varchar(50),
	google_map varchar(255),
	latitude decimal(10,7),
	longitude decimal(10,7)
);

-- canadian-restaurants
INSERT INTO restaurants (name, cuisine_type, highlights, recommended_dish, price_range, address, nearest_station, travel_time_king, taxi_time_king, section, sub_section, google_map, latitude, longitude) VALUES
('Canoe', 'カナダ料理', 'カナダ産の新鮮な食材を使ったモダンカナディアン料理で有名。特にトロントの美しい景色を一望できるロケーションが魅力。', 'ルーモア（鹿肉）、カナディアンロブスター', '$$$$ ($80-$120)', '66 Wellington St W, Toronto, ON M5K 1H6', 'King駅', '徒歩5分', '約3分', 'カナダ料理', '高級レストラン', 'https://maps.app.goo.gl/bxuUBq21Ksh3Xp1XA', 43.6474755, -79.3811794),
('STK Toronto', 'カナダ料理', '高級ステーキハウスで、ロブスターやシーザーカクテルなどのカナダらしいメニューが楽しめる。モダンなインテリアが特徴的。', 'ロブスター、シーザーカクテル', '$$$$ ($80-$120)', '153 Yorkville Ave, Toronto, ON', 'Bay駅', '徒歩20分', '約8分', 'カナダ料理', '高級レストラン', 'https://maps.app.goo.gl/hvBJKYe7pm714Uzk6', 43.6703907, -79.39423649999999),
('Richmond Station', 'カナダ料理', '地元産の食材を使ったシンプルで丁寧なカナダ料理が特徴。アットホームな雰囲気の中で、季節ごとのメニューを楽しめる。', 'ステーションバーガー、パンローストチキン', '$$$ ($50-$80)', '1 Richmond St W, Toronto, ON M5H 3W4', 'Queen駅', '徒歩7分', '約5分', 'カナダ料理', '高級レストラン', 'https://maps.app.goo.gl/2zVgExQHkWVyqixT9', 43.6513982, -79.3792848),
('Maple Leaf Tavern', 'カナダ料理', 'トロントのローカルに人気のカジュアルなカナダ料理レストラン。特にグリルドミートやプーティンが有名。', 'ステーキフリット、クラシックプーティン、ピーミールベーコン', '$$ ($30-$50)', '955 Gerrard St E, Toronto, ON M4M 1Z4', 'Gerrard St E at De Grassi St', 'サブウェイとバスで約30分', '約15分', 'カナダ料理', 'カジュアルレストラン・ダイナー', 'https://maps.app.goo.gl/ACgyohRarWVqnBLU6', 43.6680988, -79.3397459),
('The Blake House', 'カナダ料理', '歴史ある建物で、クラシックなカナダ料理をカジュアルに楽しめる。落ち着いた雰囲気で、特にハンバーガーとローストターキーのクランベリーソースがけがおすすめ。', 'ステーキ、フィッシュ＆チップス、ハンバーガー、ローストターキー', '$$ ($30-$50)', '449 Jarvis St, Toronto, ON M4Y 2G8', 'Wellesley駅', '徒歩25分', '約10分', 'カナダ料理', 'カジュアルレストラン・ダイナー', 'https://maps.app.goo.gl/wniwgyfkPB2U8sXr7', 43.6644988, -79.3771555),
('The Senator Restaurant', 'カナダ料理', 'トロントで最も歴史のあるダイナーの一つで、1930年代のクラシックな雰囲気をそのまま残す。内装やメニューも、昔ながらのダイナーのスタイルを踏襲しており、時間を超えた伝統的なカナダ料理を楽しむことができる。', 'ピーミールベーコン、クラシックバーガー', '$$ ($20-$40)', '249 Victoria St, Toronto, ON', 'Dundas駅', '徒歩10分', '約5分', 'カナダ料理', 'カジュアルレストラン・ダイナー', 'https://maps.app.goo.gl/4BYcwdm3wV9RpRQp9', 43.655749, -79.37899209999999),
('The Carbon Bar', 'カナダ料理', 'BBQ料理を提供するレストラン。特にグリルドミートが人気。', 'モントリオール風スモークドビーフ', '$$ ($20-$40)', '99 Queen St E, Toronto, ON M5C 1S1', 'Queen駅', '徒歩15分', '約7分', 'カナダ料理', 'カジュアルレストラン・ダイナー', 'https://maps.app.goo.gl/stU4ApddqQczUEdy7', 43.6531521, -79.37485989999999),
('Pearl Diver', 'カナダ料理', '新鮮なシーフードを提供するレストラン。特にロブスターが人気で、カジュアルな雰囲気でシーフード料理が楽しめる。', 'ロブスター、オイスター', '$$ ($20-$40)', '100 Adelaide St E, Toronto, ON M5C 1K9', 'King駅', '徒歩8分', '約5分', 'カナダ料理', 'カジュアルレストラン・ダイナー', 'https://maps.app.goo.gl/seqPkYr9pJvx83K76', 43.65157689999999, -79.3737766),
('Queen Street Warehouse', 'カナダ料理', '手軽に楽しめるカナダ料理が特徴のカジュアルパブ。リーズナブルな価格でさまざまな料理が楽しめる。', 'パブスタイルの定番料理', '$ ($10-$20)', '232 Queen St W, Toronto, ON M5V 1Z6', 'Osgoode駅', '徒歩12分', '約7分', 'カナダ料理', 'カジュアルレストラン・ダイナー', 'https://maps.app.goo.gl/KBCgEZNTbXULgcN27', 43.6503253, -79.3902045),
('Buster''s Sea Cove - St. Lawrence Market', 'カナダ料理', 'セントローレンスマーケット内で新鮮なシーフード料理を提供。ロブスターロールが特に人気。', 'ロブスターロール', '$$ ($20-$40)', '93 Front St E, Toronto, ON M5E 1C3', 'King駅', '徒歩8分', '約5分', 'カナダ料理', 'セントローレンスマーケット', 'https://maps.app.goo.gl/J9RvFWBuXFYwoTSQ6', 43.6486879, -79.3715454),
('Carousel Bakery', 'カナダ料理', 'トロントの名物「ピーミールベーコンサンドイッチ」で有名。セントローレンスマーケット内にあり、多くの観光客が訪れる。', 'ピーミールベーコンサンドイッチ', '$ ($10-$20)', '93 Front St E, Toronto, ON', 'King駅', '徒歩8分', '約5分', 'カナダ料理', 'セントローレンスマーケット', 'https://maps.app.goo.gl/UY9bZeaFY8grnH3J8', 43.6486879, -79.3715454),
('Smoke''s Poutinerie', 'カナダ料理', 'プーティン専門チェーン店で、クラシックなプーティンやバリエーション豊かなトッピングが楽しめる。', 'クラシックプーティン', '$ ($10-$20)', '218 Adelaide St W, Toronto, ON', 'St. Andrew駅', '徒歩10分', '約5分', 'カナダ料理', '専門店', 'https://maps.app.goo.gl/DeHCSSBZF7wkebVBA', 43.6485525, -79.3877564),
('When The Pig Came Home Delicatessen', 'カナダ料理', 'スモークミートサンドウィッチが名物のデリカッセン。トロントで人気のあるスモークドミートが楽しめる。', 'モントリオール風スモークドビーフサンドイッチ', '$ ($10-$20)', '384 Keele St, Toronto, ON M6P 2K8', 'Keele駅', '徒歩10分', '約5分', 'カナダ料理', '専門店', 'https://maps.app.goo.gl/kuoFMcqTZ7oRbc3N8', 43.6657595, -79.4648277),
('Burger''s Priest', 'カナダ料理', 'トロントで有名なハンバーガーチェーンで、クラシックなハンバーガーを提供。肉の質と焼き加減にこだわったハンバーガーが特徴的。', 'クラシックハンバーガー', '$ ($10-$20)', '212 Adelaide St W, Toronto, ON', 'St. Andrew駅', '徒歩8分', '約5分', 'カナダ料理', '専門店', 'https://maps.app.goo.gl/smgxUTWpnjeLxAfM7', 43.6485688, -79.3874419),
('Tim Hortons', 'カナダ料理', 'カナダを代表するコーヒーとドーナツのチェーン店で、カナダの生活文化を象徴する存在。全国に展開する店舗では、手軽にコーヒーや軽食を楽しむことができる。', 'コーヒー (Double Double)、ティムビッツ、サンドイッチ、クロワッサンドーナツ', '$ ($5-$15)', '66 Wellington St W, Toronto, ON M5K 1A1', 'King駅', '徒歩5分', '約3分', 'カナダ料理', 'カフェ', 'https://maps.app.goo.gl/P8Z4X8Gk8SLdp4eR9', 43.6474755, -79.3811794),
('BeaverTails Toronto Waterfront', 'カナダ料理', 'カナダならではのスイーツであるビーバーテイルを提供。観光客にも人気。', 'クラシックビーバーテイル', '$ ($5-$15)', '181 Bay St., Toronto, ON M5J 2T3', 'Union駅', '徒歩10分', '約7分', 'カナダ料理', 'カフェ', 'https://maps.app.goo.gl/rsvvPAYnzo6qFamDA', 43.6469877, -79.3791303),
('Wanda''s Pie in the Sky', 'カナダ料理', '地元で愛されるベーカリーカフェで、メープルシロップやカナダ産ベリーを使ったパイやタルトが楽しめる。', 'メープルピーカンパイ、バタータルト、フルーツタルト', '$ ($5-$15)', '287 Augusta Ave, Toronto, ON M5T 2M2', 'Spadina駅', '徒歩15分', '約10分', 'カナダ料理', 'カフェ', 'https://maps.app.goo.gl/QpViTxJA6kmLSkYp6', 43.6560323, -79.40243389999999),
('Soma Chocolatemaker', 'カナダ料理', 'カナダ産カカオを使用したチョコレートやホットチョコレートを楽しめるお店。', 'ホットチョコレート、トリュフチョコレート', '$ ($5-$20)', '32 Tank House Ln, Toronto, ON M5A 3C4', 'King駅', '徒歩20分', '約10分', 'カナダ料理', 'カフェ', 'https://maps.app.goo.gl/StXbxewwJ6C6Y7uu6', 43.6506615, -79.35826569999999),
('Balzac''s Coffee Roasters', 'カナダ料理', 'ディスティラリーディストリクト内で人気のカフェ。カナダの文化や歴史を感じるレトロな雰囲気の中で、コーヒーやペストリーを楽しめる。', 'メープルシロップクッキー、カナディアンペストリー', '$ ($5-$15)', '1 Trinity St, Toronto, ON M5A 3C4', 'King駅', '徒歩20分', '約10分', 'カナダ料理', 'カフェ', 'https://maps.app.goo.gl/UFSt7uyK7abMhMUS9', 43.6497616, -79.359118);

-- international-restaurants
INSERT INTO restaurants (name, cuisine_type, highlights, recommended_dish, price_range, address, nearest_station, travel_time_king, taxi_time_king, section, sub_section, google_map, latitude, longitude) VALUES
('Joso''s', 'クロアチア料理', 'クロアチア系海鮮料理を提供。新鮮な魚介類を使った料理が特徴的。', 'シーフード盛り合わせ、グリルドフィッシュ', '$$$ ($50-$80)', '202 Davenport Rd, Toronto, ON M5R 1J2', 'Bay駅', 'サブウェイで約15分', '約10分', '多国籍料理', NULL, 'https://maps.app.goo.gl/gTPqyy8AVxhVAGHp6', 43.6750277, -79.3960737),
('Quetzal', 'メキシコ料理', 'メキシコ料理を提供するレストラン。グリルで焼いた料理が特徴。', 'グリルドミート、タコス', '$$$ ($50-$70)', '419 College St, Toronto, ON M5T 1T1', 'Bathurst駅', 'サブウェイで約20分', '約15分', '多国籍料理', NULL, 'https://maps.app.goo.gl/jjDMeSMh2PEXWXAEA', 43.65633810000001, -79.4068264),
('El Trompo', 'メキシコ料理', 'トロントのメキシコ人コミュニティから高い評価を受ける本格的なメキシコ料理店。特にタコスが有名で、現地の味を忠実に再現。', 'タコス・アル・パストー、グァカモーレ', '$$ ($20-$30)', '277 Augusta Ave, Toronto, ON M5T 2L4', 'Spadina駅', 'サブウェイで約15分', '約12分', '多国籍料理', NULL, 'https://maps.app.goo.gl/c9Ra12ADTetgpoZz9', 43.6559148, -79.4023148),
('Rhum Corner', 'カリブ料理（ハイチ料理）', 'トロントで人気のあるカリブ料理レストラン。ハイチ料理を提供し、特にグリオ（揚げ豚肉）とピクリーズ（スパイシーなピクルス）が人気。', 'グリオ、ピクリーズ', '$$ ($15-$30)', '926 Dundas St W, Toronto, ON M6J 1W3', 'Ossington駅', '徒歩15分', '約12分', '多国籍料理', NULL, 'https://maps.app.goo.gl/B4fdkkHsAPdcCTYM7', 43.6510137, -79.4131985),
('Rasta Pasta', 'ジャマイカ料理', 'ジャマイカ料理を提供。パスタやカリブ風の料理が楽しめる。', 'ラスタパスタ、オックステール', '$$ ($15-$30)', '61 Kensington Ave, Toronto, ON M5T 2K1', 'St. Patrick駅', 'サブウェイで約15分', '約10分', '多国籍料理', NULL, 'https://maps.app.goo.gl/jYKeRoPoGZnQu8Fs7', 43.6542918, -79.4004187),
('Lebanese Garden', 'レバノン料理', 'レバノン料理を提供。ホムスやシャワルマが人気。', 'ホムス、シャワルマ', '$$ ($20-$30)', '366 College St, Toronto, ON M5T 1S6', 'Queen''s Park駅', 'サブウェイで約10分', '約8分', '多国籍料理', NULL, 'https://maps.app.goo.gl/f9Ze1mA7YedDD8T69', 43.6573562, -79.404602),
('Pita lite Shawarma', '中東料理', '中東料理のシャワルマを提供するレストラン。ボリューム満点のサンドイッチが人気。', 'シャワルマ', '$$ ($15-$25)', '175 Bloor St E unit -N3, Toronto, ON M4W 3R8', 'Bloor-Yonge駅', '徒歩10分', '約5分', '多国籍料理', NULL, 'https://maps.app.goo.gl/1NSfrhSnG78tT9EX6', 43.6707052, -79.3825177),
('Chef Mustafa', 'トルコ料理', 'トルコ料理を提供するレストラン。伝統的なトルコ料理が楽しめる。', 'ケバブ、トルコ風ピザ', '$$ ($20-$30)', '516 Danforth Ave, Toronto, ON M4K 1P6', 'Chester駅', '徒歩5分', '約3分', '多国籍料理', NULL, 'https://maps.app.goo.gl/iAZBUugvi1wSRQQw7', 43.67834570000001, -79.34863589999999),
('Square Boy', 'ギリシャ料理', 'ギリシャ料理を提供するカジュアルなレストラン。手作りハンバーガーも人気。', 'ギロ、ハンバーガー', '$$ ($10-$20)', '875 Danforth Ave, Toronto, ON M4J 1L8', 'Pape駅', '徒歩5分', '約3分', '多国籍料理', NULL, 'https://maps.app.goo.gl/fQNMVALLqpCq3DaP7', 43.6798058, -79.3393921);

-- fusion-restaurants
INSERT INTO restaurants (name, cuisine_type, highlights, recommended_dish, price_range, address, nearest_station, travel_time_king, taxi_time_king, section, sub_section, google_map, latitude, longitude) VALUES
('Byblos', '東地中海・北アフリカ料理', '東地中海と北アフリカの伝統的な料理を提供するエレガントなレストラン。トルコ風ピザやラムリブが特に人気。', 'ラムリブ、トリュフピデ', '$$$ ($50-$80)', '11 Duncan St, Toronto, ON M5H 3G6', 'St. Andrew駅', '徒歩8分', '約5分', 'フュージョン料理', NULL, 'https://maps.app.goo.gl/7Lz5wzH762WVk7Uw6', 43.64753, -79.3880145),
('Baro', 'ラテンアメリカとアジア料理の融合', 'ラテンアメリカとアジアの味を融合させたクリエイティブな料理。活気ある雰囲気と共にユニークなフュージョン料理を堪能できる。', 'セビーチェトリオ、アジアンタコス', '$$$ ($50-$70)', '485 King St W, Toronto, ON M5V 1K4', 'King駅', '徒歩15分', '約7分', 'フュージョン料理', NULL, 'https://maps.app.goo.gl/tLNmTToKTnxnoECN8', 43.6447938, -79.3969271),
('Rasa', '多国籍', '世界中の料理をベースに、創造的で季節感のあるフュージョン料理を提供。多様な料理の組み合わせを楽しめる。', '鴨の胸肉のグリル、シーフードパエリア', '$$$ ($40-$60)', '196 Robert St, Toronto, ON M5S 2K8', 'Spadina駅', '徒歩15分', '約10分', 'フュージョン料理', NULL, 'https://maps.app.goo.gl/6kaD5go1fQMYTC1VA', 43.6628642, -79.4041013),
('Patois', 'カリブ海とアジア料理の融合', 'カリブ海とアジア料理を融合させたユニークな料理が特徴。ジャークチキンとアジア風のサイドディッシュの組み合わせが人気。', 'ジャークチキンチャーハン、キムチパティ', '$$ ($20-$40)', '794 Dundas St W, Toronto, ON M6J 1V1', 'Bathurst駅', '徒歩10分', '約7分', 'フュージョン料理', NULL, 'https://maps.app.goo.gl/kk5euZCwrh6dK7iVA', 43.651977, -79.4081965),
('Chubby''s Jamaican Kitchen', 'ジャマイカ料理とカナダ料理の融合', 'ジャマイカの伝統的な料理にカナダの要素を取り入れたフュージョン料理。プーティンやトロピカルフルーツを使った料理が楽しめる。', 'ジャークチキンプーティン、トロピカルフルーツサラダ', '$$ ($20-$40)', '104 Portland St, Toronto, ON M5V 2N2', 'King駅', '徒歩15分', '約7分', 'フュージョン料理', NULL, 'https://maps.app.goo.gl/kcCCdio6GgUhUJJv7', 43.6453433, -79.40071999999999);


UPDATE restaurants SET nearest_station = 'King駅（徒歩5分）', travel_time_king = '徒歩5分', taxi_time_king = '約3分' WHERE name = 'Canoe';

UPDATE restaurants SET nearest_station = 'Bay駅（徒歩8分）', travel_time_king = 'サブウェイで約15分', taxi_time_king = '約7分' WHERE name = 'STK Toronto';

UPDATE restaurants SET nearest_station = 'Queen駅（徒歩3分）', travel_time_king = 'サブウェイで約7分', taxi_time_king = '約5分' WHERE name = 'Richmond Station';

UPDATE restaurants SET nearest_station = 'Bay駅（徒歩8分）', travel_time_king = 'サブウェイで約15分', taxi_time_king = '約10分' WHERE name = 'Joso''s';

UPDATE restaurants SET nearest_station = 'Bathurst駅（徒歩10分）', travel_time_king = 'サブウェイで約20分', taxi_time_king = '約15分' WHERE name = 'Quetzal';

UPDATE restaurants SET nearest_station = 'Spadina駅（徒歩10分）', travel_time_king = 'サブウェイで約15分', taxi_time_king = '約10分' WHERE name = 'El Trompo';

UPDATE restaurants SET nearest_station = 'Ossington駅（徒歩10分）', travel_time_king = 'サブウェイで約20分', taxi_time_king = '約15分' WHERE name = 'Rhum Corner';

UPDATE restaurants SET nearest_station = 'Spadina駅（徒歩10分）', travel_time_king = 'サブウェイで約15分', taxi_time_king = '約10分' WHERE name = 'Rasta Pasta';

UPDATE restaurants SET nearest_station = 'Bathurst駅（徒歩10分）', travel_time_king = 'サブウェイで約20分', taxi_time_king = '約15分' WHERE name = 'Lebanese Garden';

UPDATE restaurants SET nearest_station = 'Bloor-Yonge駅（徒歩5分）', travel_time_king = 'サブウェイで約15分', taxi_time_king = '約10分' WHERE name = 'Pita lite Shawarma';

UPDATE restaurants SET nearest_station = 'Pape駅（徒歩10分）', travel_time_king = 'サブウェイで約25分', taxi_time_king = '約20分' WHERE name = 'Chef Mustafa';

UPDATE restaurants SET nearest_station = 'Donlands駅（徒歩10分）', travel_time_king = 'サブウェイで約25分', taxi_time_king = '約20分' WHERE name = 'Square Boy';

UPDATE restaurants SET nearest_station = 'St. Andrew駅（徒歩5分）', travel_time_king = 'サブウェイで約10分', taxi_time_king = '約5分' WHERE name = 'Byblos';

UPDATE restaurants SET nearest_station = 'St. Andrew駅（徒歩10分）', travel_time_king = 'サブウェイで約15分', taxi_time_king = '約10分' WHERE name = 'Baro';

UPDATE restaurants SET nearest_station = 'Spadina駅（徒歩10分）', travel_time_king = 'サブウェイで約20分', taxi_time_king = '約15分' WHERE name = 'Rasa';

UPDATE restaurants SET nearest_station = 'Ossington駅（徒歩10分）', travel_time_king = 'サブウェイで約20分', taxi_time_king = '約15分' WHERE name = 'Patois';

UPDATE restaurants SET nearest_station = 'St. Andrew駅（徒歩15分）', travel_time_king = 'サブウェイで約20分', taxi_time_king = '約15分' WHERE name = 'Chubby''s Jamaican Kitchen';



-- 閉店しているレストランを削除
DELETE FROM restaurants WHERE name = 'Ritz Caribbean Foods';
-- 列を追加
ALTER TABLE restaurants ADD COLUMN highlights VARCHAR(255) AFTER cuisine_type;
-- データを変更
UPDATE restaurants SET latitude = 43.6474755, longitude = -79.3811794 WHERE name = 'Canoe';
update restaurants set section = "fusion-restaurants" where section = "フュージョン料理";
update restaurants set address = "181 Bay St., Toronto, ON M5J 2T3", latitude = 43.6469877, longitude = -79.3791303 where name = "Tim Hortons"; 

show columns from restaurants;
select * from restaurants;

-- switch safe update mode 
SET SQL_SAFE_UPDATES = 0;
SET SQL_SAFE_UPDATES = 1;

