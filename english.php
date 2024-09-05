<!-- codes for english page -->

<!-- PHP content for english page -->
<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// get english content data
$sql = "select * from english where category = :category";
$stmt = $pdo->prepare($sql);

// data for web sites
$stmt->execute(['category' => 'web']);
$web_sites = $stmt->fetchAll(PDO::FETCH_ASSOC);

// data for YouTube videos
$stmt->execute(['category' => 'YouTube']);
$youtube_videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!-- HTML content for english page -->
<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="English | Kazu in Toronto">
        <title>English | Kazu in Toronto</title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/header_footer.css" />
        <link rel="stylesheet" href="css/english.css" />
        <link rel="icon" href="images/maple.png">

        <!-- Google Translate Script -->
        <script type="text/javascript">
            function googleTranslateElementInit() {
                new google.translate.TranslateElement({pageLanguage: 'ja', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
            }
        </script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    </head>
    <body>
        <?php
        $page_nav = [
            'TOP' => [
            'link' => '#'
            ]
        ];
        include_once "templates/header.php"; // add header template
        ?>  

        <main>
            <div class="secret">
                <p></p>
            </div>

            <div class="heading">
                <h1>英語コンテンツ</h1>
                <p class="description">英語学習におすすめのコンテンツを紹介します。<br>ただいま編集中。</p>
            </div>

            <section class="web-sites">
                <h2>Webサイト</h2>
                <?php foreach ($web_sites as $content): ?>
                    <div class="content">
                        <h3><?php echo htmlspecialchars($content['name']); ?></h3>
                        <ul>
                            <li><span>オススメポイント:</span><br> <?php echo htmlspecialchars($content['highlights']); ?></li>
                            <li><span>学習内容:</span> <?php echo htmlspecialchars($content['content']); ?></li>
                            <li><span>価格帯:</span> <?php echo htmlspecialchars($content['price_range']); ?></li>
                            <li><span>URL:</span> <a href="<?php echo htmlspecialchars($content['url']); ?>" target="_blank"><?php echo htmlspecialchars($content['url']); ?></a></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </section>

            <section class="youtube-videos">
                <h2>YouTube</h2>
                <?php foreach ($youtube_videos as $content): ?>
                    <div class="content">
                        <h3><?php echo htmlspecialchars($content['name']); ?></h3>
                        <ul>
                            <li><span>オススメポイント:</span><br> <?php echo htmlspecialchars($content['highlights']); ?></li>
                            <li><span>学習内容:</span> <?php echo htmlspecialchars($content['content']); ?></li>
                            <li><span>価格帯:</span> <?php echo htmlspecialchars($content['price_range']); ?></li>
                            <li><span>URL:</span> <a href="<?php echo htmlspecialchars($content['url']); ?>" target="_blank"><?php echo htmlspecialchars($content['url']); ?></a></li>
                        </ul>
                    </div>
                <?php endforeach; ?>
            </section>

        </main>

        <?php include_once "templates/footer.php";   // add footer template ?> 
