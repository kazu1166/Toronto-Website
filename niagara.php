<!-- codes for attractions page -->

<!-- PHP content for attractions page -->
<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// get niagara data
$sql = "select * from niagara where category = :category";
$stmt = $pdo->prepare($sql);

// data for Looking
$stmt->execute(['category' => 'Niagara Falls']);
$falls = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for Shopping
$stmt->execute(['category' => 'Niagara-on-the-Lake']);
$onTheLake = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for Walking
$stmt->execute(['category' => 'Transportation']);
$transportation = $stmt->fetchAll(PDO::FETCH_ASSOC);

// get hotel data
$sql = "select * from locations where name = :name";
$stmt = $pdo->prepare($sql);

// data for Canadian restaurants
$stmt->execute(['name' => 'ホテル ヴィクトリア']);
$hotel = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!-- HTML content for attractions page -->
<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Attractions | Kazu in Toronto">
        <title>Niagara falls | Kazu in Toronto</title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/header_footer.css" />
        <link rel="stylesheet" href="css/attractions_restaurants.css" />
        <link rel="icon" href="images/maple.png">

        <!-- Google Translate Script -->
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'ja', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


        <!-- API for google map -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLA-y_KIn9AEARY-0tvo18SRsctgVx67Q" async defer></script>

        <!-- JS for display google map  need to write here to use restaurants data -->
        <script>
        function initMap() {
            const niagara = { lat: 43.16000, lng: -79.079015 };
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 11,
                center: niagara
            });

            const attractions = <?php echo json_encode(
                array_merge($falls, $onTheLake, $transportation), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

            let counter = 1;

            attractions.forEach((attraction) => {
                let marker = new google.maps.Marker({
                    position: { lat: parseFloat(attraction.latitude), lng: parseFloat(attraction.longitude) },
                    map: map,
                    title: attraction.name,
                    label: {
                        text: counter.toString(),  
                        color: 'white',            
                        fontSize: '14px',          
                        fontWeight: 'bold'
                    }
                });
            
                const infoWindow = new google.maps.InfoWindow({
                    content: `<h3>${attraction.name}</h3><p>${attraction.highlights}</p>
                    <a href="${attraction.google_map}" target="_blank">${attraction.address}</a>`
                });
            
                marker.addListener('click', () => {
                    infoWindow.open(map, marker);
                });
                counter++;
            });

            // Add marker for the hotel
            const hotel = <?php echo json_encode(
                $hotel, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

            const hotelMarker = new google.maps.Marker({
                position: { lat: parseFloat(hotel.latitude), lng: parseFloat(hotel.longitude) },
                map: map,
                title: hotel.name,
                icon: {
                    url: 'http://maps.google.com/mapfiles/ms/icons/orange-dot.png',
                    labelOrigin: new google.maps.Point(16, 32)
                }
            });
        
            const hotelInfoWindow = new google.maps.InfoWindow({
                content: `<h3>${hotel.name}</h3><p>${hotel.description}</p>
                <a href="${hotel.google_map}" target="_blank">${hotel.address}</a>`
            });
        
            hotelMarker.addListener('click', () => {
                hotelInfoWindow.open(map, hotelMarker);
            });
            
        }
        // initialize map when the page is reloaded
        window.onload = initMap;
        </script>
    </head>
    <body>
        <?php
        $page_nav = [
            'TOP' => [
                'link' => '#niagara'
            ],
            'ナイアガラの滝' => [
               'link' => '#falls',
            ],
            'オン・ザ・レイク' => [
               'link' => '#onTheLake'
            ],
            '交通' => [
                'link' => '#transportation'
            ],
            'MAP' => [
               'link' => '#map'
            ],
            'プラン' => [
               'link' => '#plan'
            ]
        ];
        include_once "templates/header.php"; // add header template
        ?>  

        <main id="niagara">
            <div class="secret">
                <p></p>
            </div>

            <div class="heading">
                <h1>ナイアガラ観光地</h1>
                <p class="description">ナイアガラの観光地をまとめました。</p>
            </div>
            
            <section class="attractions">
                <h2 id="falls">ナイアガラの滝</h2>
                <?php $counter = 1; 
                foreach ($falls as $attraction): ?>
                    <div class="attraction">
                        <h3><?php echo $counter. '. '. htmlspecialchars($attraction['name']); ?></h3>
                        <ul>
                            <?php if (!empty($attraction['highlights'])): ?>
                                <li><span class="point">ポイント: </span><br> <?php echo htmlspecialchars($attraction['highlights']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['price_range'])): ?>
                                <li><span>価格帯: </span><?php echo htmlspecialchars($attraction['price_range']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['duration'])): ?>
                                <li><span>所要時間: </span><?php echo htmlspecialchars($attraction['duration']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['address']) && !empty($attraction['map_link'])): ?>
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($attraction['map_link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['address']); ?></a></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['web_link'])): ?>
                                <li><span>WEBサイト: </span><a href="<?php echo htmlspecialchars($attraction['web_link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['name']); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php $counter++;
                endforeach; ?>
            </section>

            <section class="onTheLake">
                <h2 id="onTheLake">オン・ザ・レイク</h2>
                <?php foreach ($onTheLake as $attraction): ?>
                    <div class="attraction">
                        <h3><?php echo $counter. '. '. htmlspecialchars($attraction['name']); ?></h3>
                        <ul>
                            <?php if (!empty($attraction['highlights'])): ?>
                                <li><span class="point">ポイント: </span><br> <?php echo htmlspecialchars($attraction['highlights']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['price_range'])): ?>
                                <li><span>価格帯: </span><?php echo htmlspecialchars($attraction['price_range']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['duration'])): ?>
                                <li><span>所要時間: </span><?php echo htmlspecialchars($attraction['duration']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['address']) && !empty($attraction['map_link'])): ?>
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($attraction['map_link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['address']); ?></a></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['web_link'])): ?>
                                <li><span>WEBサイト: </span><a href="<?php echo htmlspecialchars($attraction['web_link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['name']); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php $counter++;
                endforeach; ?>
            </section>

            <section class="transportation">
                <h2 id="transportation">交通</h2>
                <?php foreach ($transportation as $attraction): ?>
                    <div class="attraction">
                        <h3><?php echo $counter. '. '. htmlspecialchars($attraction['name']); ?></h3>
                        <ul>
                            <?php if (!empty($attraction['highlights'])): ?>
                                <li><span class="point">ポイント: </span><br> <?php echo htmlspecialchars($attraction['highlights']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['price_range'])): ?>
                                <li><span>価格帯: </span><?php echo htmlspecialchars($attraction['price_range']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['duration'])): ?>
                                <li><span>所要時間: </span><?php echo htmlspecialchars($attraction['duration']); ?></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['address']) && !empty($attraction['map_link'])): ?>
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($attraction['map_link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['address']); ?></a></li>
                            <?php endif; ?>
                            
                            <?php if (!empty($attraction['web_link'])): ?>
                                <li><span>WEBサイト: </span><a href="<?php echo htmlspecialchars($attraction['web_link']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['name']); ?></a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <?php $counter++;
                endforeach; ?>
            </section>

            <section id="map" style="height: 500px; width: 100%; margin-bottom: 20px;"></section>

            <section id="plan">
                <div>
                    <h2>ナイアガラ観光プラン</h2>
                    <ul>
                        <li>移動はメガバスを<a href="https://ca.megabus.com/journey-planner/basket" target="_blank">予約</a></li>
                        <li>5人で約$120</li>
                        
                        <br>
                        <li><span class="time">        7:00      </span> ホテル出発</li>
                        <li class="detail">                             ユニオンバスターミナルまで徒歩で移動（徒歩約10分）</li>
                        <li><span class="time">        7:30      </span> ユニオンバスターミナル出発</li>
                        <li class="detail">                             朝食はバスの中で食べておく</li>
                        <li><span class="time">        9:20      </span> テーブル・ロック・バスターミナル到着</li>
                        <li class="detail">                             ナイアガラクルーズの乗船場所へ徒歩で移動（徒歩約15分）</li>
                        <li><span class="time">10:00 - 11:00</span> ナイアガラクルーズ</li>
                        <li class="detail">                             事前にクルーズは予約しておくと決まった時間に乗れるがバスの遅延もあり得るか　運行時間 9:30 AM - 8:30 PM </li>
                        <li class="detail">                             <a href="https://www.cityexperiences.com/ja/niagara-ca/city-cruises/voyage-to-the-falls-boat-tour/" target="_blank">クルーズ予約</a></li>
                        <li><span class="time">11:00 - 12:00</span> クリフトンヒル散策</li>
                        <li><span class="time">12:00 - 13:00</span> レインボーブリッジを渡る</li>
                        <li><span class="time">13:30 - 15:00</span> Table Rock House Restaurantでランチ</li>
                        <li class="detail">                             滝に近い商業施設に入っていて評価も高い。アイスワインも楽しめる。</li>
                        <li class="detail">                             <a href="https://www.enoteca.co.jp/article/archives/17026/?srsltid=AfmBOop0VrDiY9M7UQrvdNj1qfggV7FX6W9eqpmrGLpl5FvMnXjpwmiD" target="_blank">アイスワインとは？</a></li>
                        <li class="detail">                             <a href="https://maps.app.goo.gl/eH6Wyaao1UanTXa38" target="_blank">13:30の予約がまだ空いている</a></l>
                        <li><span class="time">15:15 - 16:15</span> Journey Behind the Falls体験</li>
                        <li class="detail">                             開場時間 9:00-20:00</li>
                        <li><span class="time">16:30 - 19:30</span> Fallsview Casino Resort</li>
                        <li class="detail">                             Falls Incline Railwayを使うことでテーブルロックからショートカットできる</li>
                        <li><span class="time">19:30 - 20:00</span> 滝のライトアップを鑑賞</li>
                        <li><span class="time">20:00 - 20:15</span> テーブル・ロック・バスターミナルへ移動</li>
                        <li class="detail">                             カジノへ行く前にバス停を確認しておく。</li>
                        <li><span class="time">       20:15     </span> メガバスでトロントへ戻る</li>
                        <li><span class="time">       22:30     </span> ユニオンバスターミナル到着</li>
                        
                        <br>
                        <li>この日の夕食はFallsview Casino Resortで済ませるか買っておいたものを食べる</li>
                        <li>滝のライトアップを待たず、早く帰るのもあり</li>
                    </ul>
                </div>

                <div>
                    <h3>ナイアガラオンザレイクへ行く場合</h3>
                    <ul>
                        <li><a href="https://niagara.shinylittlestar.com/notl/" target="_blank">ナイアガラオンザレイクの紹介</a></li>

                        <br>
                        <li><span class="time">11:10 - 11:40</span> ナイアガラ・オン・ザ・レイクへ移動（Lift）</li>
                        <li class="detail">                             滝周辺からナイアガラ・オン・ザ・レイクまで、Liftで約30分</li>
                        <li class="detail">                             Liftを利用。5人なので大きい車を呼ぶ必要あり。予約可能。</li>
                        <li><span class="time">12:00 - 14:30</span> ワイナリーツアーとランチ</li>
                        <li class="detail">                             Peller Estates Winery: <a href="https://www.mywinecountry.com/on/peller-greatest-winery-tour.html#2024-9-13|5|520524" target="_blank">ツアー申し込み</a></li>
                        <li class="detail">                             Inniskillin Wines: <a href="https://www.inniskillin.com/visit-us/niagara-estate-experiences/" target="_blank">ツアー申し込み</a></li>
                        <li><span class="time">14:30 - 14:45</span> 市街地までLiftで移動</li>
                        <li><span class="time">14:45 - 16:30</span> ナイアガラ・オン・ザ・レイクの町を散策・観光</li>
                        <li><span class="time">16:30 - 17:00</span> ナイアガラの滝へ戻る（Lift）</li>
                        <li class="detail">                             ナイアガラ・オン・ザ・レイクから Fallsview Casino Resortへ、Liftで約35分</li>

                        <br>
                        <li>Lift 交通費: 約 $150</li>
                        <li>ワイナリーツアー参加費: 1人約 $40</li>
                        <li>ワイナリーツアーだけして滝へ戻る選択肢もある</li>
                        <li>オンザレイクへ行く場合は
    ・クリフトンヒル（少し見れるかも）
    ・レインボーブリッジ
    ・ジャーニービハインドザフォール
の観光は省略。</li>
                        <li>移動時間が結構厳しいのでメガバスの出発時間を1時間早めることも可能。その場合クルーズが9:30からになり、30分スケジュールが前倒しになるが、現地到着からしばらく待たないといけない</li>
                    </ul>
                </div>
    
            </section>
        </main>

        <?php include_once "templates/footer.php";   // add footer template ?> 
