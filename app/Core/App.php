<?php
class App {
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];
    public function __construct()
    {
        $this->prepareURL();
        $this->render();


    }

    public function test(){
    }

    private function prepareURL()
    {
        $url=$_SERVER['REQUEST_URI'];
        if (!empty($url[0])){
            $url = trim($url, '/');
            $url = explode('/', $url);
            $this->controller = isset($url[0]) ? ucwords($url[0])."Controller" : 'HomeController';
            $this->method = isset($url[1]) ? $url[1] : 'index';
            unset($url[0]);//controller
            unset($url[1]);//method
            $this->params =!empty($url) ? array_values($url) : []; //params
        }
    }

    private function render()
    {
        if (class_exists($this->controller)){
            $this->controller = new $this->controller;
            if (method_exists($this->controller, $this->method)){
//                $obj->test();
//                $this->controller->{$this->method}($this->params);//HomeController->index($i,$j)

                call_user_func_array([$this->controller, $this->method], $this->params);
            }
        }else{
            echo 'This Controller '.$this->controller. ' not found';
        }
    }
}