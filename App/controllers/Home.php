<?php 

class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'Home';
        $data['active'] = 'active home';
        $this->view('template/header',$data);
        $this->view('index');
        $this->view('template/footer');
    }

}