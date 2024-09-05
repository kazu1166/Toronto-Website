<!-- HTML code for footer -->
 
        <footer>
            <div class="left-side"></div>

            <div class="center-side">
                <nav>
                    <a href="admin.php"><img src="images/maple.png" alt="maple"></a>
                    <ul>
                    <li><a href="index.php">ホーム</a></li>
                    <li><a href="trip.php">旅程</a></li>
                    <li><a href="attractions.php">観光地</a></li>
                    <li><a href="restaurants.php">レストラン</a></li>
                    <li><a href="niagara.php">ナイアガラ</a></li>
            <!--    <li><a href="english.php">英語学習</a></li>  -->
                    <li><a href="blog.php">ブログ</a></li>
                    <li><a href="get_lat_lng.php">APP</a></li>
                    <?php
                    if (!isset($_SESSION['loggedin'])) {  # for when user logged in
                        echo '<li><a href="login.php">ログイン</a></li>';
                    }
                    ?>
                    <?php
                    if (isset($_SESSION['loggedin'])) {  # for when user logged in
                        echo '<li><a href="favorite.php">お気に入り</a></li>';
                        echo '<li><a href="logout.php">ログアウト</a></li>';
                    }
                    ?>
                </ul>
                </nav>
            </div>

            <div class="right-side"></div>
        </footer>
        <script src="js/header.js"></script>
        <script src="js/text_size.js"></script>
        <script src="js/zoom_images.js"></script>
        <!--
        <script src="js/text_space.js"></script>
        -->
    </body>
</html>