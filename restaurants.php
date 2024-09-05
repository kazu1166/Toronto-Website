<!-- codes for restaurants page -->

<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// get restaurants data
$sql = "select * from restaurants where section = :section";
$stmt = $pdo->prepare($sql);

// data for Canadian restaurants
$stmt->execute(['section' => 'canadian-restaurants']);
$canadian_restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for International restaurants
$stmt->execute(['section' => 'international-restaurants']);
$international_restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for Fusion restaurants
$stmt->execute(['section' => 'fusion-restaurants']);
$fusion_restaurants = $stmt->fetchAll(PDO::FETCH_ASSOC);

// get hotel data
$sql = "select * from locations where name = :name";
$stmt = $pdo->prepare($sql);

// data for Canadian restaurants
$stmt->execute(['name' => 'ホテル ヴィクトリア']);
$hotel = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!-- HTML content for restaurants page -->
<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Restaurants page | Kazu in Toronto">
        <title>Restaurants | Kazu in Toronto</title>
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

        <!-- JS for display google map 　need to write here to use restaurants data -->
        <script>
        function initMap() {
            const toronto = { lat: 43.65700, lng: -79.386015 };
            const map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: toronto
            });

            const restaurants = <?php echo json_encode(
               array_merge($canadian_restaurants, $international_restaurants, $fusion_restaurants), JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

            let counter = 1;

            restaurants.forEach((restaurant) => {
                let marker = new google.maps.Marker({
                    position: { lat: parseFloat(restaurant.latitude), lng: parseFloat(restaurant.longitude) },
                    map: map,
                    title: restaurant.name,
                    label: {
                        text: counter.toString(),  
                        color: 'white',            
                        fontSize: '14px',          
                        fontWeight: 'bold'
                    }
                });
            
                const infoWindow = new google.maps.InfoWindow({
                    content: `<h3>${restaurant.name}</h3><p>${restaurant.highlights}</p>
                    <a href="${restaurant.google_map}" target="_blank">${restaurant.address}</a>`
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
                'link' => '#restaurant'
            ],
            'カナダ料理' => [
               'link' => '#canadian-restaurants',
            ],
            '多国籍料理' => [
               'link' => '#international-restaurants'
            ],
            'フュージョン料理' => [
               'link' => '#fusion-restaurants'
            ],
            'MAP' => [
               'link' => '#map'
            ]
        ];
        include_once "templates/header.php"; // add header template
        ?>  

        <main id="restaurant">
            <div class="secret">
                <p></p>
            </div>

            <div class="heading">
                <h1>おすすめレストラン</h1>
                <p class="description">トロントでオススメのレストランをまとめました。カナダ料理、多国籍料理、フュージョン料理の3項目に分けて紹介します。</p>
            </div>

            <section id="canadian-restaurants">
                <h2>カナダ料理レストラン</h2>
                <?php $counter = 1;
                foreach ($canadian_restaurants as $restaurant): ?>
                    <div class="restaurant">
                        <h3><?php echo $counter. '. '. htmlspecialchars($restaurant['name']); ?></h3>
                        <ul>
                            <li><span>おすすめポイント: </span><br><?php echo htmlspecialchars($restaurant['highlights']); ?></li>
                            <li><span>おすすめメニュー: </span><br><?php echo htmlspecialchars($restaurant['recommended_dish']); ?></li>
                            <li><span>価格帯: </span><?php echo htmlspecialchars($restaurant['price_range']); ?></li>
            <!--        </ul>
                        <details>
                            <summary>位置情報</summary>
                            <ul>  -->
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($restaurant['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($restaurant['address']); ?></a></li>
                                <li><span>最寄駅: </span><?php echo htmlspecialchars($restaurant['nearest_station']); ?></li>
                        <!--    <li><span>King駅から所要時間: </span><php echo htmlspecialchars($restaurant['travel_time_king']); ?></li> -->
                        <!--    <li><span>King駅からタクシー: </span><php echo htmlspecialchars($restaurant['taxi_time_king']); ?></li> -->
                            </ul>
                        </details>
                    </div>
                    <?php $counter++; 
                endforeach; ?>
            </section>

            <section id="international-restaurants">
                <h2>多国籍料理レストラン</h2>
                <?php foreach ($international_restaurants as $restaurant): ?>
                    <div class="restaurant">
                        <h3><?php echo $counter. '. '. htmlspecialchars($restaurant['name']); ?></h3>
                        <ul>
                            <li><span>おすすめポイント: </span><br><?php echo htmlspecialchars($restaurant['highlights']); ?></li>
                            <li><span>おすすめメニュー: </span><br><?php echo htmlspecialchars($restaurant['recommended_dish']); ?></li>
                            <li><span>価格帯: </span><?php echo htmlspecialchars($restaurant['price_range']); ?></li>
            <!--        </ul>
                        <details>
                            <summary>位置情報</summary>
                            <ul>  -->
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($restaurant['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($restaurant['address']); ?></a></li>
                                <li><span>最寄駅: </span><?php echo htmlspecialchars($restaurant['nearest_station']); ?></li>
                        <!--    <li><span>King駅から所要時間: </span><php echo htmlspecialchars($restaurant['travel_time_king']); ?></li> -->
                        <!--    <li><span>King駅からタクシー: </span><php echo htmlspecialchars($restaurant['taxi_time_king']); ?></li> -->
                            </ul>
                        </details>
                    </div>
                    <?php $counter++; 
                endforeach; ?>
            </section>

            <section id="fusion-restaurants">
                <h2>フュージョン料理レストラン</h2>
                <?php foreach ($fusion_restaurants as $restaurant): ?>
                    <div class="restaurant">
                        <h3><?php echo $counter. '. '. htmlspecialchars($restaurant['name']); ?></h3>
                        <ul>
                            <li><span>おすすめポイント: </span><br><?php echo htmlspecialchars($restaurant['highlights']); ?></li>
                            <li><span>おすすめメニュー: </span><br><?php echo htmlspecialchars($restaurant['recommended_dish']); ?></li>
                            <li><span>価格帯: </span><?php echo htmlspecialchars($restaurant['price_range']); ?></li>
            <!--        </ul>
                        <details>
                            <summary>位置情報</summary>
                            <ul>  -->
                                <li><span>住所: </span><a href="<?php echo htmlspecialchars($restaurant['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($restaurant['address']); ?></a></li>
                                <li><span>最寄駅: </span><?php echo htmlspecialchars($restaurant['nearest_station']); ?></li>
                        <!--    <li><span>King駅から所要時間: </span><php echo htmlspecialchars($restaurant['travel_time_king']); ?></li> -->
                        <!--    <li><span>King駅からタクシー: </span><php echo htmlspecialchars($restaurant['taxi_time_king']); ?></li> -->
                            </ul>
                        </details>
                    </div>
                    <?php $counter++; 
                endforeach; ?>
            </section>

            <section id="map" style="height: 500px; width: 100%; margin-bottom: 20px;"></section>
        </main>

        <?php include_once "templates/footer.php";   // add footer template ?> 
