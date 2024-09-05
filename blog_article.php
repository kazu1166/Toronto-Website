<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// Get 'post_id'
if (isset($_GET['id'])) {
    $_SESSION['post_id'] = $_GET['id'];
}
$post_id = $_SESSION['post_id'];

// Get the article data
$sql = "SELECT posts.title, posts.content, posts.created_at, posts.updated_at, categories.name AS category, tags.name AS tags FROM posts
        LEFT JOIN categories ON posts.category_id = categories.id
        LEFT JOIN post_tags ON posts.id = post_tags.post_id
        LEFT JOIN tags ON post_tags.tag_id = tags.id
        WHERE posts.id = :post_id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['post_id' => $post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Get tags data for this article
$sql = "SELECT tags.id, tags.name
        FROM tags JOIN post_tags ON tags.id = post_tags.tag_id
        WHERE post_tags.post_id = :post_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['post_id' => $post_id]);
$current_tags = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Get comments data for this article
$sql = "SELECT comments.content, comments.created_at, users.username
        FROM comments JOIN users ON comments.user_id = users.id
        WHERE comments.post_id = :post_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['post_id' => $post_id]);
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM categories";
$stmt = $pdo->query($sql);
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT * FROM tags";
$stmt = $pdo->query($sql);
$tags = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Post new comment
if (isset($_POST['submit_comment'])) {
    $comment_content = $_POST['comment_content'];

    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'post_id' => $post_id,
        'user_id' => $_SESSION['user_id'],
        'content' => $comment_content
    ]);

    header("Location: blog_article.php?id=$post_id"); // Reload this page and display new comment
    exit;
}
    
// Update article
if (isset($_POST['update'])) {

    // Get data from update form
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category_id = $_POST['category'];
    $tag_ids = $_POST['tags'];

    // Check new categories and tags
    include_once "templates/check_categories_tags.php";

        // Update article data
        $sql = "UPDATE posts SET title = :title, content = :content, category_id = :category_id WHERE id = :post_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(
            [
                'title' => $title,
                'content' => $content,
                'category_id' => $category_id,
                'post_id' => $post_id
            ]);

        // Update post_tags data
        $sql = "DELETE FROM post_tags WHERE post_id = :post_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['post_id' => $post_id]);

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

        header("Location: blog_article.php?id=$post_id"); // Reload this page and display updated article
        exit;
}

if (isset($_POST['delete'])) {
    $delete_post_id = $_POST['delete_post_id'];

    // 関連するコメントとタグの関連付けを削除
    $sql = "DELETE FROM comments WHERE post_id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['post_id' => $delete_post_id]);

    $sql = "DELETE FROM post_tags WHERE post_id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['post_id' => $delete_post_id]);

    // 記事を削除
    $sql = "DELETE FROM posts WHERE id = :post_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['post_id' => $delete_post_id]);

    header("Location: blog.php"); // 削除後にブログリストにリダイレクト
    exit;
}


?>

<!DOCTYPE html>
<html lang="jp">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Blog article page of Kazu in Toronto">
        <title><?php echo htmlspecialchars($post['title']); ?></title>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/header_footer.css" />
        <link rel="stylesheet" href="css/blog_article.css" />
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
            ],
            '記事一覧' => [
                'link' => 'blog.php'
            ]
        ];
        include_once "templates/header.php"; // add header template
        ?> 

    <main>
        <div class="secret">
            <p></p>
        </div>

        <section id="article">
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>
            <div>カテゴリ: <?php echo htmlspecialchars($post['category']); ?></div>
            <div>タグ:
              <?php foreach ($current_tags as $tag_name)
                echo htmlspecialchars($tag_name['name']) . " "; ?>
            </div>
            <div>作成日時: <?php echo htmlspecialchars($post['created_at']); ?></div>
            <?php if ($post['updated_at'] != null): ?>
            <div>更新日時: <?php echo htmlspecialchars($post['updated_at']); ?></div>
            <?php endif; ?>
            <p class="content">
                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
            </p>
        </section>


        <section id="comment">
            <h2>コメント</h2>
            <ul>
                <?php foreach ($comments as $comment): ?>
                    <li>
                        <p><?php echo htmlspecialchars($comment['username']); ?> - <?php echo htmlspecialchars($comment['created_at']); ?></p>
                        <p class="content"><?php echo nl2br(htmlspecialchars($comment['content'])); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>


        <section id="comment-post">
        <?php if (isset($_SESSION['loggedin'])): ?>
            <h3>コメントを投稿する</h3>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <textarea name="comment_content" required></textarea>

                <input class="button" type="submit" value="投稿" name="submit_comment">
            </form>
          
        <?php else: ?>
            <p>コメントを投稿するには<a href="login.php">ログイン</a>してください。</p>
        <?php endif; ?>
        </section>


        <?php if (isset($_SESSION['loggedin']) && $_SESSION['admin'] == true): ?>
        <section id="edit">
            <h2>投稿の編集</h2>

            <div class="form-container">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <label for="title">タイトル:</label><br>
                    <input class="form" type="text" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br><br>

                    <label for="content">内容:</label><br>
                    <textarea id="content" name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

                    <label for="category">カテゴリ:</label><br>
                    <select id="category" name="category">
                        <option value="" >なし</option>
                        <?php foreach ($categories as $category): ?> 
                            <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $post['category_id']) ? 'selected' : ''; ?> >
                                <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label for="new_category">新しいカテゴリを追加（カテゴリは1つのみ選択）:</label><br>
                    <input class="form" type="text" id="new_category" name="new_category"><br><br>

                    <label for="tags">タグ:</label><br>
                    <select id="tags" name="tags[]" multiple>
                        <option value="" >なし</option>
                        <?php foreach ($tags as $tag): ?>
                            <option value="<?php echo $tag['id']; ?>" <?php echo in_array($tag['id'], array_column($current_tags, 'id')) ? 'selected' : ''; ?> >
                                <?php echo htmlspecialchars($tag['name']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br><br>

                    <label for="new_tags">新しいタグを追加（カンマで区切って複数追加）:</label><br>
                    <input class="form" type="text" id="new_tags" name="new_tags"><br><br>

                    <input class="button" type="submit" value="更新" name="update">
                    <input class="button" type="reset" value="リセット">

                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onsubmit="return confirm('本当にこの投稿を削除しますか？');">
                        <input type="hidden" name="delete_post_id" value="<?php echo $post_id; ?>">
                        <input class="button delete-button" type="submit" value="削除" name="delete">
                    </form>
                </form>
            </div>

            <div class="message">
                <?php echo $status ?> <!-- display the error message -->
            </div>
        </section>
        <?php endif; ?>


        <?php 
        
        ?>

    </main>

    <?php include_once "templates/footer.php";   // add footer template ?> 
