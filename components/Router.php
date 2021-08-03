<?php

class Router
{
    private $routes;

    public function __construct ()
    {
           $routesPath=ROOT.'/config/routes.php';
           $this->routes = include($routesPath);
    }

    // return request string
    //return string
    private function getURI ()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
        public function run()
    {
        // отримую строку запиту

        $uri = $this->getURI();
        $uri = str_replace('index.php/', '', $uri);

        // перевірити наявність такого запиту в routes.php

        foreach ($this->routes as $uriPattern => $path) {

            // Сравниваем $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)) {

                // Получаем внутренний путь из внешнего согласно правилу.
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);


                $segments = explode('/', $internalRoute);
               // $controllerName= array_shift($segments) ;
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

               $actionName='action'.ucfirst(array_shift($segments));


               $parameters = $segments;

                // підключити файл класа контролера
                $controllerFile = ROOT. '/controllers/'.
                    $controllerName.'.php';

                if (file_exists($controllerFile)) {
                    include_once ($controllerFile);
                }
                //створити обєкт класа контроллера. визвати метод
                $controllerObject = new $controllerName;

                $result =call_user_func_array(array( $controllerObject, $actionName),$parameters);

                if ($result !=null) {
                    break;
                }

            }
        }
       }

    }
