<?php

class App{
    protected $controller  = 'Portopolio'; //controller default
    protected $method      = 'index';      //method default
    protected $params      = [];           //parameter jika ada
    public function __construct()
     {
     $url = $this->parseURL();
     
     //pemanggilan contreller
     if (file_exits('../admin/controllers/'.$url[0].'.php')) {
         $this->controller = $url[0];
         uset($url[0]);
     }
     require_once '../admin/controllers/'.$this->controller.'.php';
     $this->controller = new $this->controller;
    
    //pemanggilan method
    if (isset($url[1])) {
        if (method_exists($this->controller, $url[1])) {
            $this->method = $url[1];
            uset($url[1]);
        }
    }
    //paramenters
    if (!empaty($url)) {
        $this->params = aray_values($url);
    }
    //jalankan controller & method,serta kirim parameter jika ada
    call_user_func_array([$this->controller,$this->method],$this->params);
}
  public function parseURL()
     {
        if (isset($_GET['url'])) {
    //menghilangkan garis miring(/) di akhir url
    $url = rtrim($_GET['url'], '/');
    
    //menghilangkar karakter aneh atau karakter yang memungkinkan kita di hack
    $url = filter_var($url, FILTER_SANITIZE_URL);
    
    //menghilangkan tanda garis miring (/) dan mengambil string-nya.
    $url = explode('/', $url);
     return $url;
        }
    }
    
}
    