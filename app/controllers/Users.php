<?php 
    class Users extends Controller{

        public $loggedIn = false;
        public $loggedIn_userInfo = null;

        public function __construct(){
            $this->userModel = $this->model('User');
        }

        public function register(){
            // cheks for form submition
            if($_SERVER['REQUEST_METHOD']=='POST'){
                // Process the form

                // Sanitizing the POST superglobal array
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];

                // Vaidating email
                if(empty($_POST['email'])){
                    $data['email_err'] = 'Please enter email!';
                }else{
                    // if already exists in database
                    if($this->userModel->getUserByEmail($data['email'])){
                        $data['email_err'] = 'Email is already taken!';
                    }
                }

                // Vaidating password
                if(empty($_POST['password'])){
                    $data['password_err'] = 'Please enter password!';
                }else{
                    if(strlen($_POST['password'])<6){
                        $data['password_err'] = 'Password must be at least 6 characters!';
                    }else if(strlen($_POST['password'])>25){
                        $data['password_err'] = 'Password is too long! Only 25 characters are allowed';
                    }
                }

                // Vaidating name
                if(empty($_POST['name'])){
                    $data['name_err'] = 'Please enter name!';
                }

                // Vaidating confirm_password
                if(empty($_POST['confirm_password'])){
                    $data['confirm_password_err'] = 'Please confirm your password!';
                }else{
                    if($data['password'] != $data['confirm_password']){
                        $data['confirm_password_err'] = 'Password did not match! Try again';
                    }
                }

                // Submitting form & redirting to login page [making sure all the error msgs are empty]
                if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){

                    // Hashing the password for storing it into the database
                    $data['password'] = password_hash($data['password'],PASSWORD_DEFAULT);

                    // Submitting form and storing user data in database
                    if($this->userModel->registerUser($data)){
                        //die('user registered successfully!');
                        // passing msg to session helper function to show the msg
                        flash('msg',"{$data['name']}, You are registered successfully! Proceed to Login...");
                        // redirect the flow to login page, after register success, using helper funciton
                        redirect('users/login');
                    }else{
                        die('something went wrong!');
                    }
                }

                $this->view('users/register',$data);

            }else{
                // Init data
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm_password_err' => ''
                ];
                // Load view
                $this->view('users/register',$data); 
            }
        }

        public function login(){
            // cheks for form submition
            if($_SERVER['REQUEST_METHOD']=='POST'){
                // Process the form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'email' => rtrim($_POST['email']),
                    'password' => rtrim($_POST['password']),
                    'email_err' => '',
                    'password_err' => ''
                ];

                // Email validation
                if(empty($_POST['email'])){
                    $data['email_err'] = 'Please enter email!';
                }

                // Password empty validation
                if(empty($_POST['password'])){
                    $data['password_err'] = 'Please enter password!';
                }

                // Validating for "user not found" error, [Checking to see if email exists or not in database]
                if($this->userModel->getUserByEmail($data['email'])){
                    //echo 'test';
                    // Email found! Now check for the Password validation [Password did not match!]
                    if($this->userModel->loginPassCheck($data['email'],$data['password'])){
                        // Login success
                        $this->loggedIn = true;
                    }else{
                        // Password empty validation
                        if(empty($_POST['password'])){
                            $data['password_err'] = 'Please enter password!';
                        }else{
                            $data['password_err'] = 'Password did not match!';
                        }
                    }
                }else{
                    // user not found [as email does not exists in database]
                    $data['email_err'] = 'User not found!';
                }

                // When all set up & validated then logging in finally
                if((empty($data['email_err']) && empty($data['password_err'])) && ($this->loggedIn)){
                    $this->login_Init($this->userModel->loginPassCheck($data['email'],$data['password']));
                }

                $this->view('users/login',$data);

            }else{
                // Init data
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];
                // Load view
                $this->view('users/login',$data); 
            }
        }

        // For user loging Once validation succeed
        public function login_Init($user_data){
            // When logged in , storing user info 
            $this->loggedIn_userInfo = $user_data;
                    
            // Creating Session for The Logged in User
            $_SESSION['user_id'] = $this->loggedIn_userInfo->id;
            $_SESSION['user_name'] = $this->loggedIn_userInfo->name;
            $_SESSION['user_email'] = $this->loggedIn_userInfo->email;

            // Redirecting to the post page
            redirect('posts');
        }

        // For logging the user out
        public function logout(){
            // unsetting session variables and then destroying the session
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();
            // redirecting user back to login page
            redirect('users/login');
        }

    }
?>