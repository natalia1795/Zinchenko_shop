<?php

include_once ROOT.'/models/Category.php';
include_once ROOT.'/models/Product.php';
include_once ROOT.'/models/User.php';


class SiteController
{
         public function actionIndex ()
         {
             $categories = array ();
             $categories = Category::getCategoriesList();

             $latestProduct = array();
             $latestProduct = Product::getLatestProducts(3);
             require_once (ROOT.'/views/site/index.php');
             return true;
         }

         public function actionContact () {

             $userEmail = '';
             $userText = '';
             $result = false;

             if (isset($_POST['submit'])) {
                 $userEmail = $_POST['userEmail'];
                 $userText = $_POST['userText'];

                 $errors = false;

                 //валідація полів

                 if (!User::checkEmail($userEmail)) {
                     $errors[] = 'неправильний емейл';
                 }

                 if ($errors == false) {
                     $adminEmail = 'php.start@gmail.ru';
                     $message = "Текст: {$userText}. від {$userEmail}";
                     $subject = 'Тема листа';
                     $result = mail($adminEmail, $subject, $message);
                     $result = true;
                 }
             }
             require_once (ROOT.'/views/site/contact.php');
             return true;

         }
}