<?php 

class About extends Controller
{
    public function index()
    {
        $data['title'] = 'About';
        $data['active'] = 'active about';
        $this->view('template/header',$data);
        $this->view('about');
        $this->view('template/footer');
    }
}