<?php 
    class Posts extends Controller{
        public function __construct(){
            // Checking if user is not already logged in then redirecting to the login page
            if(!isset($_SESSION['user_id'])){
                redirect('users/login');
            }

            // Instantiating the Post moddel with instance property 'postModel'
            $this->postModel = $this->model('Post');
        }
        public function index(){
            $posts = $this->postModel->getPosts();
            $data = [
                'posts'=>$posts
            ];
            $this->view('posts/index',$data);
        }

        // for adding the posts
        public function add(){
            if(isset($_POST['post_add_submit'])){

                // sanitizing the $_POST array [important for safety]
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'title'=>trim($_POST['title']),
                    'body'=>trim($_POST['body']),
                    'title_err'=>'',
                    'body_err'=>'',
                ];

                // empty title validation
                if(empty($_POST['title'])){
                    $data['title_err'] = 'Post title can not be empty!';
                }

                // empty body validation
                if(empty($_POST['body'])){
                    $data['body_err'] = 'Post body can not be empty!';
                }

                // if no error msg, then submit the form data into database
                if(empty($data['title_err']) && empty($data['body_err'])){
                    // Submitting the form data to database
                    if($this->postModel->addPost($data['title'],$data['body'])){
                        // showing flash message for 'New Post Added'
                        flash('msg','New post added! And avaiable for public display in Post Feed!');
                        // Redirecting then to the posts page
                        redirect('posts');
                    }else{
                        die('Error! while adding the post');
                    }   
                }

                $this->view('posts/add',$data);

            }else{
                $data = [
                    'title'=>'',
                    'body'=>'',
                    'title_err'=>'',
                    'body_err'=>'',
                ];
                $this->view('posts/add',$data);
            }
        }

        public function update($id){
            if(isset($_POST['post_update_submit'])){

                // sanitizing the $_POST array [important for safety]
                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                $data = [
                    'post_id' => $id,
                    'title'=>trim($_POST['updated_title']),
                    'body'=>trim($_POST['updated_body'])
                ];

                // if no error msg, then submit the form data into database
                if(empty($data['title_err']) && empty($data['body_err'])){
                    // Submitting the form data to database
                    if($this->postModel->updatePost($data['title'],$data['body'],$data['post_id'])){
                        // showing flash message for 'New Post Added'
                        flash('msg','Post updated successfully!','alert alert-warning');
                        // Redirecting then to the posts page
                        redirect('posts');
                    }else{
                        die('Error! while adding the post');
                    }   
                }

                $this->view('posts/update',$data);

            }else{

                // Getting single post details for updating it
                $post_details = $this->postModel->update_post_details($id);

                $data = [
                    'post_id'=>$post_details->id,
                    'title'=>$post_details->title,
                    'body'=>$post_details->body,
                    'title_err'=>'',
                    'body_err'=>'',
                ];
                $this->view('posts/update',$data);
            }
        }

        // Deleting posts
        public function delete($id){
            if($this->postModel->delete_post($id)){
                flash('msg','Post deleted successfully!','alert alert-danger');
                // reloading the page to refresh after deleting
                redirect('posts');
            }else{
                die('Error! while deleting the post');
            }
        }
    }
?>

