<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// 記事の取得
$sql = "SELECT posts.id, posts.title, posts.created_at, categories.name AS category
        FROM posts LEFT JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.id desc";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Blog page of Kazu in Toronto">
        <title>Blog | Kazu in Toronto</title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/header_footer.css" />
        <link rel="stylesheet" href="css/blog.css" />
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
                <h1>ブログ</h1>
                <p class="description">カナダでの生活について書いていきます。</p>
            </div>

            <section>
                <h2>記事一覧</h2>
                <ul>
                    <?php foreach ($posts as $post): ?>
                    <li>
                        <span class="category"><?php echo htmlspecialchars($post['category']) ?: 'その他'; ?></span>
                        <?php echo htmlspecialchars($post['created_at']); ?><br>
                        <a href="blog_article.php?id=<?php echo $post['id']; ?>">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </section>
        </main>
        <?php include_once "templates/footer.php";   // add footer template ?> 
