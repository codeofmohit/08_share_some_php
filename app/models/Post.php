<?php 
    class Post extends Database{
        public function __construct(){
            $this->db = new Database;
            $this->getPosts();
        }

        // Getting posts data of the logged in user
        public function getPosts(){
            $sql = "SELECT users.name AS 'user_name', 
                    users.email AS 'user_email',
                    posts.title AS 'post_title',
                    posts.body AS 'post_body',
                    posts.id AS 'post_id',
                    posts.created_at AS 'post_created_at' FROM posts 
                    JOIN users ON posts.user_id = users.id 
                    WHERE users.id=".$_SESSION['user_id']." 
                    ORDER BY posts.created_at DESC
                    ";
            $this->db->query($sql);
            $posts = $this->db->resultSet();
            return $posts;
        }

        // Adding posts into the database
        public function addPost($title,$body){
            $user_id = $_SESSION['user_id'];
            $post_title = $title;
            $post_body = $body;
            $sql="INSERT into posts (user_id,title,body) VALUES(:user_id,:post_title,:post_body)";
            $this->db->query($sql);
            $this->db->bind(':user_id',$user_id);
            $this->db->bind(':post_title',$post_title);
            $this->db->bind(':post_body',$post_body);
            return $this->db->execute();
        }

        // Updating post 
        public function updatePost($title,$body,$id){
            $post_title = $title;
            $post_body = $body;
            $post_id = $id;
            $sql="UPDATE posts SET title=:post_title,body=:post_body WHERE id=:post_id";
            $this->db->query($sql);
            $this->db->bind(':post_title',$post_title);
            $this->db->bind(':post_body',$post_body);
            $this->db->bind(':post_id',$post_id);
            return $this->db->execute();
        }

        // Returning the datails of the posts that needs to be updated
        public function update_post_details($id){
            $post_id = $id;
            $sql = "SELECT * FROM posts WHERE id=:post_id";
            $this->db->query($sql);
            $this->db->bind(':post_id',$post_id);
            return $this->db->single();
        }

        // Deleting the posts by their post id
        public function delete_post($id){
            $post_id = $id;
            $sql = 'DELETE FROM posts WHERE id = :post_id';
            $this->db->query($sql);
            $this->db->bind(':post_id',$post_id);
            return $this->db->execute();
        }
    }
?>