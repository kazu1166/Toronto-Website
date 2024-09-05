<!-- codes for favorite page -->

<?php
session_start(); // use session to store the login status

include_once "config/dbconfig.php"; // database connection

// check user's login
if (isset($_POST['login'])) {

    // get user input
    $name = $_POST['name'];
    $password = $_POST['password'];

    // search matching record in database
    $sql = "select * from users where username = :name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['name' => $name]);

    // check if there are same data existing in the database
    $users = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($users && password_verify($password, $users['password'])) {

        $_SESSION['name'] = $name; // Store User Name
        $_SESSION['loggedin'] = true; // store login status

        header("Location: favorite.php"); // redirect to favorite page when logged in
        exit;

    } else {
        $login_error = "誤ったユーザーネームとパスワードです。";  // Set error message
    }
}

// check user's registration
if (isset($_POST['register'])) {

    // get user input
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // search matching username and email record in database
    $sql = "select * from users where username = :name OR email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        [
            'name' => $name,
            'email' => $email
        ]);

    // check if there are same data existing in the database
    if ($stmt->rowCount() > 0) {
        $register_error = "このユーザーネームまたはメールアドレスは既に使用されています。";  // Set error message
    
    } else {
        // hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "insert into users (username, password, email) values (:name, :password, :email)";   // Insert new data
        $stmt = $pdo->prepare($sql); 
        $stmt->execute(
            [
                'name' => $name,
                'password' => $hashedPassword,
                'email' => $email  // ハッシュ化しない
            ]
        );

        $_SESSION['loggedin'] = true; // store login status
        $_SESSION['name'] = $name; // Store User Name

        $sql = "SELECT * FROM users WHERE username = :name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['user_id'] = $user['id']; // Store User ID

        header("Location: favorite.php"); // redirect to favorite page when logged in
        exit;
    }
}

?>

<!-- HTML content for favorite page -->
<!DOCTYPE html>
<html lang="jp">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Login page of Kazu in Toronto">
    <title>Login | Kazu in Toronto</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&family=M+PLUS+Rounded+1c&family=Noto+Serif+JP&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/header_footer.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="icon" href="images/maple.png">

    <!-- Google Translate Script -->
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'ja', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    </head>
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
            <h1>ログイン</h1>
      

        <!-- forms section displayed only when not logged in -->
        <?php if (!isset($_SESSION['loggedin'])): ?>
            <p class="description">ユーザー登録することでコメント機能やお気に入り機能を使うことができます。</p>
        </div>
            
            <section id="login">
                <h2>ログインはこちら:</h2>

                <!-- Login Form -->
                <div class="form-container">
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="form-row">
                            <label for="name">ユーザーネーム:</label>
                            <input class="form" type="text" id="name" name="name" required><br><br>
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
                <?php if ($login_error): ?>
                    <div class="error">
                        <?php echo $login_error; ?><!-- display the error message -->
                    </div>
                <?php endif; ?>
                </div>  
            </section>

            <section>
                <h2>新規登録はこちら:</h2>
                <!-- Registration Form -->
                <div class="form-container"> 
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                        <div class="form-row">
                            <label for="name">ユーザーネーム:</label>
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
                            <input class="button" type="submit" value="新規登録" name="register">
                            <input class="button" type="reset" value="リセット">
                        </div>
                    </form>
                </div>
                <div class="message">
                <?php if ($register_error): ?>
                    <div class="error">
                        <?php echo $register_error; ?><!-- display the error message -->
                    </div>
                <?php else: ?>
                    <div class="default">
                        <?php echo "<p>メアドは適当でOK。</p>" ?>
                    </div>
                <?php endif; ?>
                </div>
            </section>
               
        <?php endif; ?>
    </main>

<?php include_once "templates/footer.php";   // add footer template ?> 
