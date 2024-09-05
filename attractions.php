<!-- codes for attractions page -->

<!-- PHP content for attractions page -->
<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// get attractions data
$sql = "select * from attractions where category = :category";
$stmt = $pdo->prepare($sql);

// data for Looking
$stmt->execute(['category' => '見る']);
$attractions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for Shopping
$stmt->execute(['category' => '買い物する']);
$shopping = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for Walking
$stmt->execute(['category' => '散策する']);
$walking = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        <title>Attractions | Kazu in Toronto</title>
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
            const toronto = { lat: 43.66000, lng: -79.379015 };
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: toronto
            });

            const attractions = <?php echo json_encode(
                array_merge($attractions, $shopping, $walking), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

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
                'link' => '#attraction'
            ],
            '見る' => [
               'link' => '#looking',
            ],
            '買い物' => [
               'link' => '#shopping'
            ],
            '散策' => [
                'link' => '#walking'
            ],
            'MAP' => [
               'link' => '#map'
            ]
        ];
        include_once "templates/header.php"; // add header template
        ?>  

        <main id="attraction">
            <div class="secret">
                <p></p>
            </div>

            <div class="heading">
                <h1>おすすめ観光地</h1>
                <p class="description">トロント市内でオススメの観光地をまとめました。見る・買い物する・散策するの3項目に分けて紹介します。</p>
            </div>
            
            <section class="attractions">
                <h2 id="looking">見る</h2>
                <?php $counter = 1; 
                foreach ($attractions as $attraction): ?>
                    <div class="attraction">
                        <h3><?php echo $counter. '. '. htmlspecialchars($attraction['name']); ?></h3>
                        <ul>
                            <li><span class="point">ポイント: </span><br> <?php echo htmlspecialchars($attraction['highlights']); ?></li>
                            <li><span>アクティビティ: </span><br> <?php echo htmlspecialchars($attraction['activities']); ?></li>
                            <li><span>価格帯: </span><?php echo htmlspecialchars($attraction['price_range']); ?></li>
                            <li><span>所要時間: </span><?php echo htmlspecialchars($attraction['duration']); ?></li>
                <!--        </ul>
                        <details>
                            <summary>位置情報</summary>
                            <ul>  -->
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($attraction['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['address']); ?></a></li>
                                <li><span>最寄駅: </span><?php echo htmlspecialchars($attraction['nearest_station']); ?></li>
                        <!--    <li><span>King駅から所要時間: </span><php echo htmlspecialchars($attraction['travel_time_king']); ?></li> -->
                        <!--    <li><span>King駅からタクシー: </span><php echo htmlspecialchars($attraction['taxi_time_king']); ?></li> -->
                            </ul>
                        </details>
                    </div>
                    <?php $counter++;
                endforeach; ?>
            </section>

            <section lass="shopping">
                <h2 id="shopping">買い物する</h2>
                <?php foreach ($shopping as $attraction): ?>
                    <div class="attraction">
                        <h3><?php echo $counter. '. '. htmlspecialchars($attraction['name']); ?></h3>
                        <ul>
                            <li><span class="point">ポイント: </span><br> <?php echo htmlspecialchars($attraction['highlights']); ?></li>
                            <li><span>アクティビティ: </span><br> <?php echo htmlspecialchars($attraction['activities']); ?></li>
                            <li><span>価格帯: </span><?php echo htmlspecialchars($attraction['price_range']); ?></li>
                            <li><span>所要時間: </span><?php echo htmlspecialchars($attraction['duration']); ?></li>
            <!--        </ul>
                        <details>
                            <summary>位置情報</summary>
                            <ul>  -->
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($attraction['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['address']); ?></a></li>
                                <li><span>最寄駅: </span><?php echo htmlspecialchars($attraction['nearest_station']); ?></li>
                        <!--    <li><span>King駅から所要時間: </span><php echo htmlspecialchars($attraction['travel_time_king']); ?></li> -->
                        <!--    <li><span>King駅からタクシー: </span><php echo htmlspecialchars($attraction['taxi_time_king']); ?></li>  -->
                            </ul>
                        </details>
                        </ul>
                    </div>
                    <?php $counter++;
                endforeach; ?>
            </section>

            <section lass="walking">
                <h2 id="walking">散策する</h2>
                <?php foreach ($walking as $attraction): ?>
                    <div class="attraction">
                        <h3><?php echo $counter. '. '. htmlspecialchars($attraction['name']); ?></h3>
                        <ul>
                            <li><span class="point">ポイント: </span><br> <?php echo htmlspecialchars($attraction['highlights']); ?></li>
                            <li><span>アクティビティ: </span><br> <?php echo htmlspecialchars($attraction['activities']); ?></li>
                            <li><span>価格帯: </span><?php echo htmlspecialchars($attraction['price_range']); ?></li>
                            <li><span>所要時間: </span><?php echo htmlspecialchars($attraction['duration']); ?></li>
            <!--        </ul>
                        <details>
                            <summary>位置情報</summary>
                            <ul>  -->
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($attraction['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($attraction['address']); ?></a></li>
                                <li><span>最寄駅: </span><?php echo htmlspecialchars($attraction['nearest_station']); ?></li>
                        <!--    <li><span>King駅から所要時間: </span><php echo htmlspecialchars($attraction['travel_time_king']); ?></li> -->
                        <!--    <li><span>King駅からタクシー: </span><php echo htmlspecialchars($attraction['taxi_time_king']); ?></li> -->
                            </ul>
                        </details>
                    </div>
                    <?php $counter++;
                endforeach; ?>
            </section>

            <section id="map" style="height: 500px; width: 100%; margin-bottom: 20px;"></section>
        </main>

        <?php include_once "templates/footer.php";   // add footer template ?> 
