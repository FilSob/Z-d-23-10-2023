<?php
$id = mysqli_connect('localhost','root','','psy');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forum o psach</title>
    <link rel="stylesheet" href="styl4.css">
</head>
<body>
    <div class="baner">
        <h1>Forum wielbicieli psów</h1>
    </div>
    <div class="flex_con">
        <div class="lewy">
            <img src="pliki4/zad1/obraz.jpg" alt="foksterier">
        </div>
        <div class="prawy">
            <div class="prawy1">
                <h2>Zapisz się</h2>
                <form action="logowanie.php" method="post">
                    login: <input type="text" name="login">
                    <br>
                    hasło: <input type="password" name="haslo">
                    <br>
                    powtórz hasło: <input type="password" name="haslo_pow">
                    <br>
                    <button type="submit">Zapisz</button>
                </form>
                <?php
                @$login = $_POST['login'];
                @$haslo = $_POST['haslo'];
                @$haslo_pow = $_POST['haslo_pow'];
                if(!empty($_POST['login']) && !empty($_POST['haslo']) && !empty($_POST['haslo_pow']))
                {
                    if($haslo != $haslo_pow)
                    {
                        echo "<p> hasła nie są takie same, konto nie zostało dodane</p>";
                    }
                    else
                    {
                        $zap3 = "SELECT login FROM `uzytkownicy`";
                        $login_av = 1;
                        $w_zap3 = mysqli_query($id,$zap3);
                        while($linia = mysqli_fetch_row($w_zap3))
                        {
                            if($login == $linia[0])
                            {
                                echo "<p> login występuje w bazie danych, konto nie zostało dodane</p>";
                                $login_av = 0;
                                break;
                            }
                        }
                        if($login_av == 1)
                        {
                            $haslo_enc = sha1($haslo);
                            $zap2 = "INSERT INTO `uzytkownicy`(id, login, haslo) VALUES ('','$login','$haslo_enc')";
                            $w_zap2 = mysqli_query($id,$zap2);
                            if($w_zap2)
                            {
                                echo "<p> Konto zostało dodane</p>";
                            }
                        }

                        
                    }
                }
                else
                {
                    echo "<p> wypełnij wszystkie pola</p>";
                }

                ?>
            </div>
            <div class="prawy2">
                <h2>Zapraszamy wszystkich</h2>
                <ol>
                    <li>właścicieli psów</li>
                    <li>weterynarzy</li>
                    <li>tych, co chcą kupić psa</li>
                    <li>tych, co lubią psy</li>
                </ol>
                <a href="regulamin.html">Przeczytaj regulamin forum</a>
            </div>
        </div>
    </div>
    <div class="stopka">
        Stronę wykonał: (numer PESEL zdającego)
    </div>
</body>
</html>
<?php
mysqli_close($id);
?>