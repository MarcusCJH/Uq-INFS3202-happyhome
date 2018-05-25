<?php
  class Pages extends Controller{
    public function __construct(){
        // Load Model
        $this->houseListingModel = $this->model('HouseListing');
        $this->ownerModel = $this->model('Owner');
    }

    // Load Homepage
    public function index(){
      // If logged in, redirect to posts
      if(isset($_SESSION['user_id'])){
          if($_SESSION['type'] == 'sitter')
          {
              redirect('sitters');
          }

          if($_SESSION['type'] == 'owner')
          {
              redirect('owners');
          }

      }
      $houses = $this->ownerModel->getThreeLatestHouses();
      //Set Data
      $data = [
            'houses' => $houses,
      ];

      // Load homepage/index view
      $this->view('pages/index', $data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0'
      ];

      // Load about view
      $this->view('pages/about', $data);
    }


    public function homesitters()
    {
      $this->view('pages/homesitters');
    }

    public function listings()
    {
      $houses = $this->houseListingModel->getAllAvailableHouseListing();

      $data = [
          'houses' => $houses
      ];

      $this->view('pages/listings', $data);
    }

    public function contactus()
    {
        $this->view('pages/contactus');
    }


    //actual send mail
    public function sendmail()
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {

          // Sanitize POST
          $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

          $data = [

              'name' => trim($_POST['name']),
              'email' => trim($_POST['email']),
              'phone' => trim($_POST['phone']),
              'message' => trim($_POST['message']),
              'name_err' => '',
              'email_err' => '',
              'phone_err' => '',
              'message_err' => '',

          ];

          // Validate data
          if(empty($data['name']))
          {
              $data['name_err'] ='Enter your Name';
          }
          if(empty($data['email']))
          {
              $data['email_err'] ='Enter your Email';
          }
          if(empty($data['phone']))
          {
              $data['phone_err'] ='Enter your Phone Number';
          }
          if(empty($data['message']))
          {
              $data['message_err'] ='Enter your Message';
          }

          // Make sure there are no errors
          if(empty($data['name_err']) && empty($data['email_err']) && empty($data['phone_err']) && empty($data['message_err']))
          {

          $mailto = 'noreply@happy-home.name';
          $sendDate = date('Y-m-d');
          $subject = 'Contact Email from '.$data['name'].' on '.$sendDate;
          $message = $data['message']." \r\n".'Contact Number: '.$data['phone'];
          $from = $data['email'];
          $header = 'From:'.$from;


          if(mail($mailto,$subject,$message,$header)) {
            flash('contact_msg', 'Your feedback has been sent');
            redirect('pages/contactus');
        }
        else{
            die('Something went wrong');
        }
      }else{
          // Load View with Errors
          $this->view('pages/contactus', $data);
      }
    }


  }

  //for testing, works on server
  public function mail()
  {


        $mailto = 'noreply@happy-home.name';
        $subject = 'the subject';
        $message = 'This is a contact message';
        $from = 'julientran1995@gmail.com';
        $header = 'From:'.$from;


        if(mail($mailto,$subject,$message,$header)) {
          flash('contact_msg', 'Your feedback has been sent');
          $this->view('pages/contactus');
      }
      else{
          die('Something went wrong');
      }
  }


}
