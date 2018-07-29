<?php

    class Posts extends Controller{

        public function __construct(){
            if(!isLoggedIn()){
                redirect('users/login');
            }

            $this->postModel = $this->model('Post');
            $this->userModel = $this->model('User');
        }

        public function index(){
            
            $posts = $this->postModel->getPosts(); 

            $data = [
                'posts' => $posts
            ];

            $this->view('posts/index',$data);
        }

        public function add(){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                //sanitize POST Array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'title'=>trim($_POST['title']),
                    'body'=>trim($_POST['body']),
                    'user_id'=>trim($_SESSION['user_id']),
                    'title_err'=>'',
                    'body_err'=>''
                ];

                //validate data
                if(empty($data['title'])){
                    $data['title_err'] = 'Please Enter your Title';
                }
                if(empty($data['body'])){
                    $data['body'] = 'Please Enter your Description';
                }

                //make sure no errors
                if(empty($data['title_err']) && empty($data['body_err'])){
                    if($this->postModel->addPost($data)){
                        flash('post_added',"Post Added Successfully");
                        redirect("posts");
                    }else{
                        die("Something Went Wrong");
                    }
                    
                }else{
                    //load view with errors
                    $this->view('posts/add',$data);
                }

            }else{
                $data = [
                    'title'=>'',
                    'body'=>'',
                    'user_id'=>'',
                    'title_err'=>'',
                    'body_err'=>''
                ];
            }

            $data = [
                'title' =>'',
                'body' => ''
            ];

            $this->view('posts/add', $data);
        }

        public function show($id){
            $post = $this->postModel->getPostById($id);
            $user = $this->userModel->getUserById($post->user_id);
    
            $data = [
                'post' => $post,
                'user' => $user
            ];

            $this->view('posts/show',$data);
        }
    }

?>