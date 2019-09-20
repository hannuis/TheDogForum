<?php
    require 'head.php';
?>

<header>
    <div class="login">
        <?php
            if (isset($_SESSION['userId'])) {
                echo '
                    <form action="script/inc/users/logout.inc.php" method="POST">
                        <button type="submit" name="logout-submit">Logout</button>
                    </form>
                ';
            }
            else {
                echo '
                    <form action="script/inc/users/login.inc.php" method="POST">
                        <input type="text" name="username" placeholder="Användarnamn/E-mail..">
                        <input type="password" name="password" placeholder="Lösenord..">
                        <button type="submit" name="login-submit">Logga in</button>
                        <a href="signup">
                            <button type="button" name="signup">Sign up</button>
                        </a>
                    </form>
                ';
            }
        ?>
    </div>
    <nav>
        <ul>
            <li>
                <a href="index">Hem</a>
            </li>
            <li>
                <a href="posts">Inlägg</a>
            </li>
            <?php
                if (isset($_SESSION['userId'])) {
                    echo '
                        <li>
                            <a href="writepost">Skriv inlägg</a>
                        </li>
                    ';
                }
            ?>
            <li>
                <a href="contact">Kontakt</a>
            </li>
        </ul>
    </nav>
</header>