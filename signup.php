<?php
    require 'partials/header.php';
?>

<main>
    <div id="wrapper">
        <section id="contact">  
            <h2>Skapa konto</h2>
            <form action="script/inc/users/signup.inc.php" method="POST">
                <input type="text" name="username" placeholder="Användarnamn..">
                <input type="text" name="mail" placeholder="E-mail..">
                <input type="password" name="password" placeholder="Lösenord..">
                <input type="password" name="password-repeat" placeholder="Upprepa lösenord..">
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </div>
</main>

<?php
    require 'partials/footer.php';
?>