<?php 

if (!empty($_POST['category']) && !empty($_POST['new_category'])) {
    $status = "カテゴリーを選択するか、新しいカテゴリーを追加するか、どちらか一方を選んでください。";

} else {

    // 新しいカテゴリが入力された場合、それを追加
    if (!empty($_POST['new_category'])) {
        $new_category = $_POST['new_category'];

        // 既存のカテゴリをチェック
        $sql = "SELECT id FROM categories WHERE name = :name";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $new_category]);
        $existing_category = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing_category) {
            $new_category_id = $existing_category['id'];

        } else {
            // 新しいカテゴリをデータベースに追加
            $sql = "INSERT INTO categories (name) VALUES (:name)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $new_category]);
        
        }

        // 新しいカテゴリのIDを取得
        $new_category_id = $pdo->lastInsertId();

        // 新しいカテゴリIDを使用
        $category_id = $new_category_id;
    }

    // 新しいタグが入力された場合、それを追加
    if (!empty($_POST['new_tags'])) {
        $new_tags = explode(',', $_POST['new_tags']);

        foreach ($new_tags as $new_tag) {
            $new_tag = trim($new_tag);

            // 既存のタグをチェック
            $sql = "SELECT id FROM tags WHERE name = :name";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['name' => $new_tag]);
            $existing_tag = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existing_tag) {
                $new_tag_id = $existing_tag['id'];
            } else {
                // 新しいタグをデータベースに追加
                $sql = "INSERT INTO tags (name) VALUES (:name)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['name' => $new_tag]);
                $new_tag_id = $pdo->lastInsertId();
            }

            // 新しいタグIDを配列に追加
            $tag_ids[] = $new_tag_id;
        }
    }
}

?>