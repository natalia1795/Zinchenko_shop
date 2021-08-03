<?php

include_once ROOT.'/models/User.php';

class CabinetController
{
     public function actionIndex () {
         $userId = User::CheckLogged();

       // отримати інформацію про користувача із бази даних
         $user = User::getUserById ($userId);

         require_once (ROOT.'/views/cabinet/index.php');

      return true;
     }

     public function actionEdit () {
         // отримуємо ідентифікатор користувача із сесії
         $userId = User::checkLogged();

         // отримуємо інформацію про користувача із бази даних
         $user = User::getUserById($userId);

         $name = $user['name'];
         $password = $user['password'];

         $result = false;

         if (isset ($_POST['submit'])) {
             $name = $_POST['name'];
             $password = $_POST['password'];

             $errors = false;

             if (!User::checkName($name)) {
                 $errors[] = 'імя не повинно бути коротшим 2 символів';

             }
             if(!User::checkPassword($password)) {
                 $errors [] = 'пароль не повинен бути коротшим  6 символів';
             }

             if ($errors == false) {
                 $result = User::edit ($userId, $name, $password);
             }
         }
         require_once (ROOT.'/views/cabinet/edit.php');
     }

}