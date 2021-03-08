<?php

    session_start();

    if(isset($_POST['email'])) 
    {
        $all_ok = true;

        //sprawdzenie username

        $username = $_POST['signusername'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $rpassword = $_POST['repeatpassword'];
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];

        //sprawdzenie username
        if(strlen($username) < 6 || strlen($username) > 20)
        {
            $all_ok = false;
            $_SESSION['re_username'] = "Nazwa użytkownika powinna składać się z 6-20 znaków <br>";
            header('Location: ../index.php');
            
        }

        if(ctype_alnum($username)==false)
        {
            $all_ok = false;
            $_SESSION['re_username'] = "Tylko litery i cyfry (bez polskich znaków) <br>";
            header('Location: ../index.php');
        }

        //sprawdzanie email
        $emailB = filter_var($email, FILTER_SANITIZE_EMAIL);

        if(filter_var($emailB, FILTER_VALIDATE_EMAIL)==false || ($emailB!=$email))
        {
            $all_ok = false;
            $_SESSION['re_email'] = "Podaj poprawny email <br>";
            header('Location: ../index.php');
        }

         //sprawdzanie password
        if(strlen($password) < 8 || strlen($password) > 20)
        {
            $all_ok = false;
            $_SESSION['re_password'] = "Hasło musi posiadać od 8 do 20 znaków <br>";
            header('Location: ../index.php');
        }

        if($password != $rpassword) {
            $all_ok = false;
            $_SESSION['re_password'] = "Hasła nie są identyczne <br>";
            header('Location: ../index.php');
        }

        if(strlen($first_name) < 3 || strlen($first_name) > 30)
        {
            $all_ok = false;
            $_SESSION['re_first_name'] = "Imię musi posiadać conajmniej 3 znaki <br>";
            header('Location: ../index.php');
        }

        if(strlen($last_name) < 3 || strlen($last_name) > 30)
        {
            $all_ok = false;
            $_SESSION['re_last_name'] = "Nazwisko musi posiadać conajmniej 3 znaki <br>";
            header('Location: ../index.php');
        }

        require_once "db_data.php";

        try
        {
            $connect = new mysqli($host, $db_user, $db_password, $db_name);
            if ($connect->connect_errno!=0) 
            {
                throw new Exception(mysqli_connect_errno());
            }
            else
            {

                //Czy email już istnieje?
                $escapedemail = mysqli_real_escape_string(htmlspecialchars($email));
				$result = $connect->query("SELECT id_uzytkownika FROM uzytkownicy WHERE email='$escepedemail'");
				
				if (!$result) throw new Exception($connect->error);
				
				$how_mails = $result->num_rows;
				if($how_mails>0)
				{
					$all_ok=false;
                    $_SESSION['re_email']="Istnieje już konto przypisane do tego adresu e-mail!";
                    header('Location: ../index.php');
                }
                
                //Czy nick jest już zarezerwowany?
                $escapedusername = mysqli_real_escape_string(htmlspecialchars($username));
				$result = $connect->query("SELECT id_uzytkownika FROM uzytkownicy WHERE login='$escepedusername'");
				
				if (!$result) throw new Exception($connect->error);
				
				$how_nicks = $result->num_rows;
				if($how_nicks>0)
				{
					$all_ok=false;
                    $_SESSION['re_nick']="Nazwa użytkownika zajęta. Użyj innej.";
                    header('Location: ../index.php');
				}

                if($all_ok==true) 
                {
                    $salt1 = "ala";
                    $salt2 = "makota";
                    
                    $salted_password = $salt1 . $password . $salt2;

                    $hash_and_salt_password = password_hash($salted_password,PASSWORD_BCRYPT);

                    $escapedemail = mysqli_real_escape_string(htmlspecialchars($email));
                    $escapedusername = mysqli_real_escape_string(htmlspecialchars($username));
                    $escapedfirstname = mysqli_real_escape_string(htmlspecialchars($first_name));
                    $escapedlastname = mysqli_real_escape_string(htmlspecialchars($last_name));
                    $query = "INSERT INTO uzytkownicy (imie, nazwisko, login, email, haslo) VALUES ('$first_name', '$last_name','$username', '$email', '$hash_and_salt_password')";
                    if($connect->query($query))
                    {
                        $_SESSION['registered'] = "Udało się zarejestrować";
                        header('Location: ../index.php');
                    }
                    else
                    {
                        throw new Exception($connect->error);
                    }
                }       

                $connect->close();
            }
        }
        catch(Exception $e)
        {
            echo 'Błąd bazy danych';
        }

        

    }
?>