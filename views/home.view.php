<?php
require('../models/post.model.php');
$postDb = new PostDb;

$posts = $postDb->displayPost();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <form action="../Router.php" method="post">
            <input type="hidden" name="action" value="create_post">
            <label for="post_title">Title</label>
            <input type="text" name="post_title">
            <label for="post_body">Body</label>
            <textarea name="post_body"></textarea>
            <button>Post</button>
        </form>
    </div>
    <div style="margin-top: 25px;">
        <?php
            if (!empty($posts)) {
                foreach ($posts as $post) :?>
                    <div style="padding: 25px;">
                        <?= htmlspecialchars($post['post_title'])?>
                        <br>
                        <?= htmlspecialchars($post['post_body'])?>
                    </div>
                <?php endforeach;
            } else {
                echo "No posts found.";
            }
        ?>
    </div>
</body>
</html>