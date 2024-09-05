<?php
session_start();

$status = "";  // status holder for displaying an error message

include_once "config/dbconfig.php"; // データベース接続

$sql = "SELECT * FROM categories";
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM tags";
$stmt = $pdo->query($sql);
$tags = $stmt->fetchAll(PDO::FETCH_ASSOC);


// ユーザーがログインしているか確認
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['admin'] !== true) {
    header("Location: admin.php"); // ログインページへリダイレクト
    exit;
}


if (isset($_POST['post'])) {
    // フォームからのデータを取得
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category'] !== "" ? $_POST['category'] : null;
    $tag_ids = !empty($_POST['tags']) ? $_POST['tags'] : [];

    $user_id = $_SESSION['user_id'];

    // Check new categories and tags
    include_once 'templates/check_categories_tags.php';

    // データベースに新規投稿を挿入
    $sql = "INSERT INTO posts (title, content, user_id, category_id) VALUES (:title, :content, :user_id, :category_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        [
            'title' => $title,
            'content' => $content,
            'user_id' => $user_id,
            'category_id' => $category_id
        ]);

    // 挿入した投稿のIDを取得
    $post_id = $pdo->lastInsertId();

    if (!empty($tag_ids)) {

        // 投稿とタグの関係を挿入
        foreach ($tag_ids as $tag_id) {

            if ($tag_id) {

                $sql = "INSERT INTO post_tags (post_id, tag_id) VALUES (:post_id, :tag_id)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(
                    [
                        'post_id' => $post_id,
                        'tag_id' => $tag_id
                    ]);
            }
        }
    }

    header("Location: blog_article.php?id=$post_id"); // 投稿を表示するページへリダイレクト
    exit;
    
}

?>

<!-- HTML Form -->
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Post page of Kazu in Toronto">
    <title>Post | Kazu in Toronto</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header_footer.css" />
    <link rel="stylesheet" href="css/post.css" />
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
        <section>
            <h1>新しいブログ投稿を作成</h1>

            <div class="form-container">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label for="title">タイトル:</label><br>
                    <input class="form" type="text" id="title" name="title" required><br><br>

                    <label for="content">内容:</label><br>
                    <textarea id="content" name="content" rows="10" required></textarea><br><br>

                    <label for="category">カテゴリ選択:</label><br>
                    <select id="category" name="category">
                        <option value="" selected>なし</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label for="new_category">新しいカテゴリを追加（カテゴリは1つのみ選択）:</label><br>
                    <input class="form" type="text" id="new_category" name="new_category"><br><br>

                    <label for="tags">タグ選択:</label><br>
                    <select id="tags" name="tags[]" multiple>
                        <option value="" selected>なし</option>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label for="new_tags">新しいタグを追加（カンマで区切って複数追加）:</label><br>
                    <input class="form" type="text" id="new_tags" name="new_tags"><br><br>

                    <input class="button" type="submit" value="投稿" name="post">
                    <input class="button" type="reset" value="リセット">
                </form>
            </div>

            <div class="message">
                <?php echo $status ?> <!-- display the error message -->
            </div>
        </section>
    </main>
    
    <?php include_once "templates/footer.php";   // add footer template ?> 

