<!-- codes for index page -->

<?php
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// get destinations data
$sql = "select * from locations";
$stmt = $pdo->prepare($sql);

// data for locations
$stmt->execute();
$locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- HTML content for index page -->
<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Itinerary page | Kazu in Toronto">
    <title>Itinerary | Kazu in Toronto</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header_footer.css" />
    <link rel="stylesheet" href="css/trip.css" />
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
        const toronto = { lat: 43.50000, lng: -79.379015 };
        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 9,
            center: toronto
        });

        const locations = <?php echo json_encode(
            $locations, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;

        let counter = 1;

        locations.forEach((location) => {
            let marker = new google.maps.Marker({
                position: { lat: parseFloat(location.latitude), lng: parseFloat(location.longitude) },
                map: map,
                title: location.name,
                label: {
                    text: counter.toString(),  
                    color: 'white',            
                    fontSize: '14px',          
                    fontWeight: 'bold'
                }
            });
        
            const infoWindow = new google.maps.InfoWindow({
                content: `<h3>${location.name}</h3><p>${location.description}</p>
                <a href="${location.google_map}" target="_blank">${location.address}</a>`,
            });
            marker.addListener('click', () => {
                infoWindow.open(map, marker);
            });

            /**
            marker.addListener('click', () => {
            infoWindow.open({
                anchor: marker,  // マーカーに固定
                map,
                shouldFocus: false
                });
            });
            */
            
            counter++;
        });
    }
    // initialize map when the page is reloaded
    window.onload = function() {
        initMap();
    };
    </script>
</head>
<body>
    <?php
    $page_nav = [
        'TOP' => [
            'link' => '#trip'
        ],
        'フライト' => [
            'link' => '#flight',
            'sublinks' => [
                '日本
→ トロント' => '#japan',
                'トロント
→ ニューヨーク' => '#toronto',
                'ニューヨーク
→ 日本' => '#nyc'
            ]
        ],
        '旅程' => [
            'link' => '#itinerary'
        ],
        '位置情報' => [
            'link' => '#destination'
        ]
    ];
    include_once "templates/header.php"; // add header template
    ?>  

    <main id="trip">
        <div class="secret">
            <p></p>
        </div>

        <div class="heading">
            <h1>旅程</h1>
            <p class="description">人任せではなく、予定はしっかり確認しよう！</p>
        </div>

        <section id="flight">
            <h2>フライト・宿泊情報</h2>

            <div id="japan">
                <h3>日本 → トロント フライト</h3>
                <table>
                    <tr>
                        <th>月日</th>
                        <th>時間</th>
                        <th>空港</th>
                        <th>航空会社</th>
                        <th>便</th>
                    </tr>
                    <tr>
                        <td>9/12</td>
                        <td>17:40</td>
                        <td>Tokyo / Haneda Airport</td>
                        <td>Air Canada</td>
                        <td>AC002</td>
                    </tr>
                    <tr>
                        <td>9/12</td>
                        <td>17:10</td>
                        <td>Toronto / Lester B Pearson Intl</td>
                        <td>Air Canada</td>
                        <td>AC002</td>
                    </tr>
                </table>
                <a href="https://www.skygate.co.jp/skygserv/SkygateServlet">エアトリサイト</a>
            </div>

            <div>
                <h3>トロント 宿泊場所</h3>
                <ul>
                    <li>ホテル：ホテル ヴィクトリア</li>
                    <li>住所：56 Yonge St, Toronto, ON M5E 1G5, Canada</li>
                    <li>宿泊期間：3部屋　12日～17日（5泊）</li>
                </ul>
                <a href="https://www.agoda.com/ja-jp/account/bookings.html">アゴダ予約確認</a>
            </div>
        
            <div id="toronto">
                <h3>トロント → ニューヨーク フライト</h3>
                <table>
                    <tr>
                        <th>月日</th>
                        <th>時間</th>
                        <th>空港</th>
                        <th>航空会社</th>
                        <th>便</th>
                    </tr>
                    <tr>
                        <td>9/17</td>
                        <td>10:15</td>
                        <td>Toronto Pearson International Airport (YYZ)</td>
                        <td>Delta Air Lines</td>
                        <td>DL5447</td>
                    </tr>
                    <tr>
                        <td>9/17</td>
                        <td>12:03</td>
                        <td>LaGuardia Airport (LGA)</td>
                        <td>Delta Air Lines</td>
                        <td>DL5447</td>
                    </tr>
                </table>
                <a href="https://ja.delta.com/my-trips/search">デルタエアライン航空会社公式サイト</a>
            </div>

            <div>
                <h3>ニューヨーク宿泊場所</h3>
                <a href="https://www.agoda.com/ja-jp/account/bookings.html">アゴダ予約確認</a>
            </div>

            <div id="nyc">
                <h3>ニューヨーク → 日本 フライト</h3>
                <table>
                    <tr>
                        <th>月日</th>
                        <th>時間</th>
                        <th>空港</th>
                        <th>航空会社</th>
                        <th>便</th>
                    </tr>
                    <tr>
                        <td>9/22</td>
                        <td>13:50</td>
                        <td>New York / John F Kennedy Intl</td>
                        <td>ANA</td>
                        <td>NH109</td>
                    </tr>
                    <tr>
                        <td>9/23</td>
                        <td>17:15</td>
                        <td>Tokyo / Haneda Airport</td>
                        <td>ANA</td>
                        <td>NH109</td>
                    </tr>
                </table>
                <a href="https://www.skygate.co.jp/skygserv/SkygateServlet">エアトリサイト</a>
            </div>
        </section>

        <section id="itinerary">
            <h2>大まかな旅程</h2>
            <ul>
                <li>9/12(木)　17:20 トロント着</li>
                <li>9/13(金)　ナイアガラ観光（和徳）</li>
                <li>9/14(土)　市内観光（和徳）</li>
                <li>9/15(日)　市内観光（和徳）</li>
                <li>9/16(月)　市内観光　のんびり</li>
                <li>9/17(火)　10:15 トロント発 →<br>                     12:03 ニューヨーク着</li>
                <li>9/18(水)　日本語ツアー</li>
                <li>9/19(木)　のんびり（自由行動）</li>
                <li>9/20(金)　市内観光（自由行動）</li>
                <li>9/21(土)　市内観光</li>
                <li>9/22(日)　13:50 ニューヨーク発</li>
                <li>(現地時間)</li>
            </ul>
        </section>

        <section id="destination">
            <h2>主な行き先一覧（トロント）</h2>
            <div class="locations-wrapper">
                <div class="locations">
                    <?php $counter = 1; 
                    foreach ($locations as $location): ?>
                        <div class="location">
                            <h3><?php echo $counter. '. '. htmlspecialchars($location['name']); ?></h3>
                            <ul>
                                <li>説明: <?php echo htmlspecialchars($location['description']); ?></li>
                                <li>住所: <a href="<?php echo htmlspecialchars($location['google_map']); ?>" target="_blank">
                                    <?php echo htmlspecialchars($location['address']); ?></a></li>
                            </ul>
                        </div>
                    <?php $counter++;
                    endforeach; ?>
                </div>
                <div id="map"></div>
            </div>
        </section>      
    </main>
    
    <?php include_once "templates/footer.php";   // add footer template ?> 
