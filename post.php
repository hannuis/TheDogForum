<?php
    require 'partials/header.php';
    require 'script/inc/get/postHandler.inc.php';
?>

<main>
    <div id="wrapper">
        <section id="post">
            <div id="main-content">
                <h2></h2>
                <div class="post-content">
                    <?php 
                        getPost();
                    
                        if (isset($_SESSION['userId'])) {
                           echo '
                            <div id="comment-form">
                                <h3>Kommentera</h3>
                                <form action="script/inc/set/createComment.inc.php?id=' .$_GET['id'] .'" method="POST">
                                    <textarea name="comment" placeholder="Write your comment here..."></textarea><br>
                                    <button type="submit" name="create-comment-submit">Send</button>
                                </form>
                            </div>
                            <div id="like">
                                <a href="script/inc/set/createLike.inc.php?id=' .$_GET['id'] .'">
                                    <img src="./img/heart-outline.jpg">Gilla inlägg
                                </a>
                            </div>';
                        }
                        else {
                            echo '<div class="not-logged-in-msg"><p>Please log in to post a comment</p></div>';
                        }
                    
                        getComments();
                        getLikes();
                    ?>
                </div>
            </div>
            <div class="aside-content">
                <div class="top-content">
                    <h3>Senaste</h3>
                    <?php 
                        getLatest();
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
    require 'partials/footer.php';
?>