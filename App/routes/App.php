<?php 

class App
{
    protected   $controller = 'home',
                $method = 'index',
                $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // controller
        // mengecek apakah ada file yang ada didalam folder controllers yang dikirimkan di url
        if ( isset($url[0]) ){
            if( file_exists('../app/controllers/' .$url[0]. '.php') ){
                $this->controller = $url[0];
                // kita hilangkan controllernya dari element array
                unset($url[0]);
            }
        }
        require_once '../app/controllers/'.$this->controller.'.php';
        // diinstansiasi
        $this->controller = new $this->controller;

        // method
        if( isset($url[1]) ){
            if( method_exists($this->controller, $url[1]) ){
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // params
        if( !empty($url) ){
            // mengambil data array dari urlnya
            $url = array_values($url);
            $this->params = array_values($url);
        }

        // jalankan contoller dan method, serta kirimkan params
        // parameter pertama menajalankan function , parameter ke 2 untuk mengirimkan params
        call_user_func_array([$this->controller,$this->method], $this->params);
    }

    public function parseUrl(){
        // jika ada data url dikirimkan
        if( isset($_GET['url']) ){
            $url = rtrim($_GET['url'], '/') ;
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}