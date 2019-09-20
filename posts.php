<?php
    require 'partials/header.php';
    require 'script/inc/get/postHandler.inc.php';
?>

<main>
    <div id="wrapper">
        <section id="firstPage">
            <div id="main-content">
                <h2>Alla inlägg</h2>
                <div class="posts">
                    <?php
                        getPosts();
                    ?>
                </div>
            </div>
            <div class="aside-content">
                <div class="top-content">
                    <h3>Senaste</h3>
                    <?php 
                        getLatest() 
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>

<?php
    require 'partials/footer.php';
?>