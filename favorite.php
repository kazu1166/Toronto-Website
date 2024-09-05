<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

$status = "";  // status holder for displaying an error message


?>

<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Favorite page of Kazu in Toronto">
        <title>Favorite | Kazu in Toronto</title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/header_footer.css" />
        <link rel="stylesheet" href="css/favorite.css" />
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
                <h1>お気に入り</h1>
                <?php if (isset($_SESSION['loggedin'])): ?>
                    <h2>ようこそ <?php echo $_SESSION['name'] ?>さん</h2>
                <?php endif; ?>

                <p class="description">お気に入りページ。ただいま編集中。</p>
            </div>
            

        </main>

        <?php include_once "templates/footer.php";   // add footer template ?> 
