<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $address = escapeshellarg($_POST['address']);  // 引数全体をシングルクォートで囲み、内部のシングルクォートを適切にエスケープ
                                                  // 'example; rm -rf /' -> 'example\; rm -rf /'
    $command = "/usr/local/bin/python3 /Applications/XAMPP/xamppfiles/htdocs/PHP201/Portforios/Toronto_Website/python/get_lat_lng.py " . $address;
    //$command = "/usr/bin/python3 /var/www/html/Toronto_Website/python/get_lat_lng.py " . $address; for server
    $output = shell_exec($command);// PHPスクリプト内から外部のシェルコマンドやプログラムを実行する


    if ($output) {
        // 緯度と経度を分割して取得
        list($lat, $lng) = explode(",", $output);
        $addressName = htmlspecialchars($_POST['name']);
        $address = htmlspecialchars($_POST['address']);

    } else {
        $error = "Could not retrieve the location.";
    }

}

?>

<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Geo app page of Kazu in Toronto">
        <title>Geo app | Kazu in Toronto</title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/header_footer.css" />
        <link rel="stylesheet" href="css/get_lat_lng.css" />
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
                <h1>Geo Application</h1>
                <p class="description">Get Latitude and Longitude!</p>
            </div>

            <section class="form">
                <h2>Enter Address to Get Latitude and Longitude</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div>
                        <label for="name">Name(Optional): </label>
                        <input class="form" id="name" type="text" name="name">
                    </div>

                    <div>
                        <label for="address">Address: </label>
                        <input class="form" id="address" type="text" name="address" required>
                    </div>

                    <input class="button" type="submit">
                </form>
            </section>

            <section class="result">
                <?php if (isset($output) && $output) { ?>
                    <p><span>Name: </span><?php echo $addressName; ?></p>
                    <p><span>Address: </span><?php echo $address; ?></p>
                    <p><span>Latitude: </span><?php echo $lat; ?></p>
                    <p><span>Longitude: </span><?php echo $lng; ?></p>
                    
                <?php } elseif (isset($error)) { ?>
                    <p><?php echo $error; ?></p>

                <?php } ?>
            </section>
            

        </main>

        <?php include_once "templates/footer.php";   // add footer template ?> 