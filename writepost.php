<?php
    require 'partials/header.php';
?>

<main>
    <div id="wrapper">
        <section id="writepost">
            <h2>Skriv inlägg</h2>
            <form action="script/inc/set/createPost.inc.php" method="POST">
                <input type="text" name="title" placeholder="Titel..">
                <textarea name="content" placeholder="Skriv inlägg..."></textarea>
                <button type="submit" name="create-post-submit">Skicka</button>
            </form>
        </section>
    </div>
</main>

<?php
    require 'partials/footer.php';
?>