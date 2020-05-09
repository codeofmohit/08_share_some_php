<?php 
    class Pages extends Controller{
        public function __construct(){
            $this->postFeed = $this->model('postFeed');
        }
        public function about($id=NULL){
            //echo "about called of pages! the id is $id<br>";
            $data = [
                'title'=>'<br>About',
                'desc'=>'<br><b>Share Some</b> app is built on the PHP Framework <b>Mohit_MVC</b>, Which is a very minimal model-view-controller Framework (like mini laravel) Created by <b>Mohit Verma</b> for his personal usage.
                <br><br><b>Share Some</b> app is built on that Framework, The <b>Main functionality</b> of this application is to be able to Share your thoughts/feelings/confessions as <b>\'Posts\'</b> that will be displayed publically in the <b>\'Post Feed\'</b> section.<br><br>In order to <b>add/edit/delete</b> your individual posts you will have to <b>Login</b> into the application, And for being able to login, you ofcourse need to <b>Register/Signup</b> first.<br><br><b style=\'color:red;\'>Contact Developer[Mohit Verma]</b><br>9660369581<br>contact@codeofmohit.com<br><a href=\'https://www.codeofmohit.com/\' target=\'_blank\'>Portfolio Website [codeofmohit.com]</a>'
            ];
            $this->view('pages/about',$data); // DO NOT CONFUSE, views are not classes, they need not to be instantiated
        }
        public function index(){
            $postFeed = $this->postFeed->display_all_posts();
            $data = [
                'title'=>'Share Some',
                'desc'=>'Welcome! to Share Some, A post sharing application Built on Mohit_MVC Framework',
                'posts'=>$postFeed
            ];
            $this->view('pages/index',$data);
        }
    }
?>