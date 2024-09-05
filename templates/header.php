<!-- HTML code for the header  -->

<header id="header">
    <div class="common-header">
        <div class="left-side">
            <a class="logo-link" href="index.php">
            <p class="logo-letter">Kazu in Toronto</p>
            </a>
        </div>

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

        <div class="right-side">
            <div id="google_translate_element"></div>
            <div>
                <button id="bigger-text-size">拡大</button>
                <button id="smaller-text-size">縮小</button>
                <button id="reset-text-size">デフォルト</button>
            </div>
        </div>
    </div>



    <!-- common header for mobile -->
    <div class="mobile common-header">
        <div class="left-side"></div>

        <div class="center-side">
            <a class="logo-link" href="index.php">
                <p class="logo-letter">Kazu in Toronto</p>
            </a>
        </div>

        <div class="right-side">
    <!--    <div id="google_translate_element"></div>
            <div>
                <button id="bigger-text-size">拡大</button>
                <button id="smaller-text-size">縮小</button>
                <button id="reset-text-size">デフォルト</button>
    -->
            </div>
        </div>
    </div>



    <!-- page header -->
    <?php if (isset($page_nav)): ?>
    <div class="page-header">
        <nav class="page-nav">
            <ul>
                <?php foreach ($page_nav as $name => $section): ?>
                    <li class="menu-item">
                        <?php if (isset($section['sublinks'])): ?>
                            <a href="<?php echo $section['link']; ?>"><?php echo $name; ?></a>
                            <ul class="sub-menu">
                                <?php foreach ($section['sublinks'] as $subname => $sublink): ?>
                                    <li><a href="<?php echo $sublink; ?>"><?php echo $subname; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo $section['link']; ?>"><?php echo $name; ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>



    <!-- page header for mobile -->
    <?php if ( (isset($_SESSION['loggedin'])) && $_SESSION['loggedin'] == true) {
            $page_link_mobile = [
                '他ページ' => [
                    'link' => '#',
                    'sublinks' => [
                        'ホーム' => 'index.php',
                        '旅程' => 'trip.php',
                        '観光地' => 'attractions.php',
                        'レストラン' => 'restaurants.php',
                        'ナイアガラ' => 'niagara.php',
                        //'英語' => 'english.php',
                        'ブログ' => 'blog.php',
                        'お気に入り' => 'favorite.php',
                        'APP' => 'get_lat_lng.php',
                        'ログアウト' => 'logout.php'
                    ]
                ]
            ];
        } else {
            $page_link_mobile = [
                '他ページ' => [
                    'link' => '#',
                    'sublinks' => [
                        'ホーム' => 'index.php',
                        '旅程' => 'trip.php',
                        '観光地' => 'attractions.php',
                        'レストラン' => 'restaurants.php',
                        'ナイアガラ' => 'niagara.php',
                        //'英語' => 'english.php',
                        'ブログ' => 'blog.php',
                        'APP' => 'get_lat_lng.php',
                        'ログイン' => 'login.php'
                    ]
                ]
            ];
        }
    ?>
    <?php $page_nav_mobile = array_merge_recursive($page_nav, $page_link_mobile); ?>

    <?php if (isset($page_nav)): ?>
    <div class="mobile page-header">
        <nav class="page-nav">
            <ul>
                <?php foreach ($page_nav_mobile as $name => $section): ?>
                    <li class="menu-item">
                        <?php if (isset($section['sublinks'])): ?>
                            <div><?php echo $name; ?></div>
                            <ul class="sub-menu">
                                <?php foreach ($section['sublinks'] as $subname => $sublink): ?>
                                    <li><a href="<?php echo $sublink; ?>"><?php echo $subname; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo $section['link']; ?>"><?php echo $name; ?></a>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
    <?php endif; ?>

</header>