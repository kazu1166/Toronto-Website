<?php 
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

$status = "";  // status holder for displaying an error message

if ($_SESSION['admin'] == true) {
    header("Location: post.php"); // redirect to favorite page when logged in
    exit;
}

// check user's login
if (isset($_POST['login'])) {

    // get user input
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // search matching record in database
    $sql = "select * from users where username = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
      ['name' => $name]);

    // check if there are same data existing in the database
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($users && password_verify($password, $users['password']) && $users['email'] == $email && $users['role'] == 'admin') {

        $_SESSION['name'] = $name; // Store User Name
        $_SESSION['loggedin'] = true; // store login status
        $_SESSION['admin'] = true;
        $_SESSION['user_id'] = $users['id'];

        header("Location: post.php"); // redirect to favorite page when logged in
        exit;

    } else {
        $status = "入力が誤っています。";  // Set error message
    }
}
?>

<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Admin page of Kazu in Toronto">
    <title>Admin | Kazu in Toronto</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header_footer.css" />
    <link rel="stylesheet" href="css/admin.css" />
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

        <section class="post">
            <h1>管理人ページ</h1>
            <div class="form-container">
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="form-row">
                        <label for="name">　ユーザー名　:</label>
                        <input class="form" type="text" id="name" name="name" required><br><br>
                    </div>
                    <div class="form-row">
                        <label for="email">メールアドレス:</label>
                        <input class="form" type="email" id="email" name="email" required><br><br>
                    </div>
                    <div class="form-row">
                        <label for="password">　パスワード　:</label>
                        <input class="form" type="password" id="password" name="password" required><br><br>
                    </div>
                    <div class="form-row">
                        <input class="button" type="submit" value="ログイン" name="login">
                        <input class="button" type="reset" value="リセット">
                    </div>
                </form>
            </div>

            <div class="message">
                <?php echo $status ?> <!-- display the error message -->
            </div>
        </section>
    </main>

    <?php include_once "templates/footer.php";   // add footer template ?> 
