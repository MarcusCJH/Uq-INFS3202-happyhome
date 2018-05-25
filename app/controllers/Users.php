<?php
  class Users extends Controller{
    public function __construct(){
      $this->userModel = $this->model('User');
    }


    public function register(){
      // Check if logged in
      if($this->isLoggedIn()){
          if($_SESSION['type'] == 'sitter')
          {
              redirect('sitters');
          }

          if($_SESSION['type'] == 'owner')
          {
              redirect('owners');
          }
      }

      // Check if POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'first_name' => trim($_POST['first_name']),
          'last_name' => trim($_POST['last_name']),
          'type' => trim($_POST['type']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'contact_number' => trim($_POST['contact_number']),
          'first_name_err' => '',
          'last_name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'contact_number_err' => ''
        ];

        // Validate email
        if(empty($data['email'])){
            $data['email_err'] = 'Please enter an email';

        } else{
          // Check Email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken.';
          }
        }
          // Validate first name
          if(empty($data['first_name']))
          {
              $data['first_name_err'] ='Please enter first name';
          }

          // Validate last name
          if(empty($data['last_name']))
          {
              $data['last_name_err'] ='Please enter last name';
          }



        // Validate password
        if(empty($data['password'])){
            $password_err = 'Please enter a password.';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must have atleast 6 characters.';
        }

        // Validate confirm password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Please confirm password.';
        } else{
            if($data['password'] != $data['confirm_password']){
                $data['confirm_password_err'] = 'Password do not match.';
            }
        }

          // Validate contact number
          if(empty($data['contact_number']))
          {
              $data['contact_number_err'] ='Please enter Contact number';
          }

        // Make sure errors are empty
        if(empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['contact_number_err'])){
          // SUCCESS - Proceed to insert


            $result = $this->CheckCaptcha($_POST['g-recaptcha-response']);
            if ($result['success']) {
                //If the user has checked the Captcha box
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Execute
                if($this->userModel->register($data)){
                    // Redirect to login
                    flash('register_success', 'You are now registered and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong');
                }

            } else {
                // If the CAPTCHA box wasn't checked
                echo '<script>alert("If your human, tick CAPTCHA");</script>';
                $this->view('users/register', $data);
            }


        } else {
          // Load View
          $this->view('users/register', $data);
        }
      } else {
        // IF NOT A POST REQUEST

        // Init data
        $data = [
          'first_name' => '',
          'last_name' => '',
            'type'=>'',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
            'contact_number' =>'',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
            'contact_number_err' => ''
        ];

        // Load View
        $this->view('users/register', $data);
      }
    }

    public function login(){
      // Check if logged in
      if($this->isLoggedIn()){
          if($_SESSION['type'] == 'sitter')
          {
              redirect('sitters');
          }

          if($_SESSION['type'] == 'owner')
          {
              redirect('owners');
          }
      }

      // Check if POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST
        $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',
        ];

        // Check for email
        if(empty($data['email'])){
          $data['email_err'] = 'Please enter email.';
        }

        // Check for name
        if(empty($data['name'])){
          $data['name_err'] = 'Please enter name.';
        }

        // Check for user
        if($this->userModel->findUserByEmail($data['email'])){
          // User Found
        } else {
          // No User
          $data['email_err'] = 'This email is not registered.';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){

            $result = $this->CheckCaptcha($_POST['g-recaptcha-response']);
            if ($result['success']) {
                //If the user has checked the Captcha box
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    // User Authenticated!
                    $this->createUserSession($loggedInUser);
                    if($_SESSION['type'] == 'sitter')
                    {
                        redirect('sitters');
                    }

                    if($_SESSION['type'] == 'owner')
                    {
                        redirect('owners');
                    }

                } else {
                    $data['password_err'] = 'Password incorrect.';
                    // Load View
                    $this->view('users/login', $data);
                }

            } else {
                // If the CAPTCHA box wasn't checked
                echo '<script>alert("If your human, tick CAPTCHA");</script>';
                $this->view('users/login', $data);
            }


        } else {
          // Load View
          $this->view('users/login', $data);
        }

      } else {
        // If NOT a POST

        // Init data
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',
        ];

        // Load View
        $this->view('users/login', $data);
      }
    }

    // Create Session With User Info
    public function createUserSession($user){
      $_SESSION['user_id'] = $user->id;
      $_SESSION['user_email'] = $user->email;
      $_SESSION['type'] = $user->type;
    }

    // Logout & Destroy Session
    public function logout(){
      unset($_SESSION['user_id']);
      unset($_SESSION['user_email']);
      unset($_SESSION['type']);
      session_destroy();
      redirect('users/login');
    }

    // Check Logged In
    public function isLoggedIn(){
      if(isset($_SESSION['user_id'])){
        return true;
      } else {
        return false;
      }
    }

      public function CheckCaptcha($userResponse) {
          $fields_string = '';
          $fields = array(
              'secret' => '[SECRET KEY]',
              'response' => $userResponse
          );
          foreach($fields as $key=>$value)
              $fields_string .= $key . '=' . $value . '&';
          $fields_string = rtrim($fields_string, '&');
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
          curl_setopt($ch, CURLOPT_POST, count($fields));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
          $res = curl_exec($ch);
          curl_close($ch);
          return json_decode($res, true);
      }



  }
