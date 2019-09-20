<?php
    require 'partials/header.php';
    require 'script/inc/get/postHandler.inc.php';
?>

<main>
    <div id="wrapper">
        <section id="firstPage">            
            <form method="POST" id="search-form">
                <input type="text" name="search" placeholder="Search">
                <button type="submit" name="search-submit">Sök</button>
            </form>
            <div id="main-content">
                <div class="posts">
                    <?php
                        searchPosts();
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