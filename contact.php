<?php
    require 'partials/header.php';
?>

<main>
    <div id="wrapper">
        <section id="writepost">
            <h2>Kontakt</h2>
            <form>
                <input type="text" name="name" placeholder="Namn.." disabled>
                <input type="text" name="mail" placeholder="E-mail.." disabled>
                <textarea name="content" placeholder="Skriv meddelande..." disabled></textarea>
                <button type="submit" name="contact-submit">Skicka</button>
            </form>
        </section>
    </div>
</main>

<?php
    require 'partials/footer.php';
?>