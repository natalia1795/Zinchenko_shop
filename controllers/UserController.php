<?php

include_once ROOT.'/models/User.php';

class UserController
{
    public function actionRegister()
    {
        $name = '';
        $email = '';
        $password = '';


        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            if (User::checkName($name)) {
                echo '<br>$name ok';

            } else {
                $errors [] = 'Імя не повинно бути коротшим 2 символів';
            }
            if (User::checkEmail($email)) {
                echo '<br>$email ok';
            } else {
                $errors [] = 'Неправильний емейл';
            }
            if (User::checkPassword($password)) {
                echo '<br>$password ok';
            } else {
                $errors [] = 'пароль не повинен бути коротшим 6 символів';
            }
            if (User::checkEmailExists($email)) {
                $errors [] = 'такий емейл вже використовується';
            }
            if ($errors == false) {
                // save user
                $result = User::register($name, $email, $password);
            }
        }
        require_once(ROOT . '/views/user/register.php');

        return true;
    }


    public function actionLogin()
    {
        $email = '';
        $password = '';

        if (isset ($_POST['submit'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $errors = false;

            // валідація полів

            if (!User::checkEmail($email)) {
                $errors[] = 'неправильний емейл';

            }

            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не повинен бути коротшим 6-ти символів';

            }

            //перевіряєм чи існує користувач
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                //якщо дані неправильні показуємо помилку
                $errors[] = ' неправильні дані для входу на сайт';

            } else {
                //якщо дані правильні запамятовуємо користувача (сесія)
                User::auth($userId);

                //перенаправляємо користувача в закриту частину - кабінет
                header("Location:/index.php/cabinet/");
            }
        }

        require_once(ROOT . '/views/user/login.php');
    }

    public function actionLogout ()
    {
        session_start();
        unset ($_SESSION["user"]);
        header ("location:/");
    }
}
