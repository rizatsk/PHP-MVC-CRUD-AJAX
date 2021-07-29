<?php 

class Controller{
    // membuat function view dan menerima parameter yang dikirimkan yaitu berupa folder dan filenya 
    // dan kita siapkan parameter ke 2 untuk menerima parameter data dan dikasih array kosong.
    public function view($view,$data = [])
    {
        // kita langsung aja panggil file yang ingin kita tampilkan
        require_once '../app/views/'.$view.'.php';
    }

    public function model($model)
    {
        require_once '../app/models/'.$model.'.php';
        // sekalian kita instansiasi/ jalankan function get usernya.
        return new $model;
    }
}