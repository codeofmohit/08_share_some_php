<?php 
    class PostFeed extends Database{
        public function __construct(){
            $this->db = new Database;
        }
        public function display_all_posts(){
            $sql = "SELECT users.name,
                    posts.title,
                    posts.body,
                    posts.created_at 
                    FROM posts JOIN users 
                    ON posts.user_id = users.id 
                    ORDER BY posts.created_at DESC";
            $this->db->query($sql);
            return $this->db->resultSet();
        }
    }
?>