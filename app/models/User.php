<?php 
    class User extends Database{
       public function __construct(){
            $this->db = new Database;
        }

        // Checking user by email, to check for already taken email id's [While User Registration]
        public function getUserByEmail($email){
            $sql = 'SELECT * FROM users WHERE email = :email';
            $this->db->query($sql);
            $this->db->bind(':email',$email);
            $hasUser = $this->db->single();
            if($hasUser){
                return true;
            }else{
                return false;
            }
        }

        // Registering users, and saving user data into databse
        public function registerUser($data){
            $sql = 'INSERT into users (name,email,password) VALUES(:name,:email,:password)';
            $this->db->query($sql);
            $this->db->bind(':name',$data['name']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':password',$data['password']);
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        // Checking password while Login [Verfiying it]
        public function loginPassCheck($email,$password){
            $sql = 'SELECT * FROM users WHERE email=:email';
            $this->db->query($sql);
            $this->db->bind(':email',$email);
            $row = $this->db->single();
            
            // Verying the password
            if(password_verify($password,$row->password)){
                return $row;
            }else{
                return false;
            }
        }
    }
?>