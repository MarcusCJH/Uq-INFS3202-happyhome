<?php
/**
 * Created by PhpStorm.
 * User: Marcus
 * Date: 4/5/2018
 * Time: 12:28 AM
 */

class Sitters extends Controller
{

    public function __construct()
    {
        if(!isset($_SESSION['user_id'])){
            redirect('users/login');
        }


        else if($_SESSION['type'] == 'owner')
        {
            redirect('owners');
        }

        $this->userModel = $this->model('User');
        $this->houseListingModel = $this->model('HouseListing');

    }

    public function index()
    {
      // Dashboard

      $houses = $this->houseListingModel->getCurrentJobs($_SESSION['user_id']);

      $data = [
          'houses' => $houses
      ];

      $this->view('sitters/index', $data);
    }

    public function past_jobs()
    {
      // Dashboard

      $houses = $this->houseListingModel->getPastJobs($_SESSION['user_id']);

      $data = [
          'houses' => $houses
      ];

        $this->view('sitters/past_jobs', $data);
    }

    public function take_job($id)
    {
      // Dashboard

      $listing = $this->houseListingModel->getOneListing($id);

      $data = [
          'listing' => $listing
      ];

      $this->view('sitters/take_job', $data);
    }

    public function profile()
    {
      // Get their profile
      $user = $this->userModel->getUserById($_SESSION['user_id']);
      $data = [
          'user' => $user
      ];

      $this->view('sitters/profile', $data);
    }

    //mark this listing as taken
    public function listing_taken($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $listing = $this->houseListingModel->getOneListing($id);
        $user = $this->userModel->getUserById($_SESSION['user_id']);

        $data = [
            'listing_id' => $id,
            'user_id' => $_SESSION['user_id'],
        ];

          //Execute
          if($this->houseListingModel->updateHouseListingToTaken($data)){
            $mailto = $listing->email;
            $subject = 'Your Listing was Taken';
            $message = "Dear ".$listing->first_name." \r\n".'Your listing for '.$listing->full_address." has been taken by ".$user->first_name;
            $from = 'noreply@happy-home.name';
            $header = 'From:'.$from;


            if(mail($mailto,$subject,$message,$header)) {
              // Redirect to sitter page
              flash('house_msg', 'You have taken this job');
              redirect('sitters');
          }
          else{
              die('Something went wrong');
          }


          } else {
              die('Something went wrong');
          }
      } else {
          redirect('sitters');
      }
    }

    //cancel job that you have taken
    public function job_cancel($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $listing = $this->houseListingModel->getOneListing($id);
        $user = $this->userModel->getUserById($_SESSION['user_id']);

          //Execute
          if($this->houseListingModel->updateHouseListingToAvailable($id)){

            $mailto = $listing->email;
            $subject = 'Your Listing was Cancelled';
            $message = "Dear ".$listing->first_name." \r\n".'Your listing for '.$listing->full_address." has been cancelled by ".$user->first_name;
            $from = 'noreply@happy-home.name';
            $header = 'From:'.$from;


            if(mail($mailto,$subject,$message,$header)) {
              // Redirect to sitter page
              flash('house_msg', 'You have cancel this job');
              redirect('sitters');
          }
          else{
              die('Something went wrong');
          }

          } else {
              die('Something went wrong');
          }
      } else {
          redirect('sitters');
      }
    }

    //finish job that you have done
    public function job_finish($id){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          //Execute
          if($this->houseListingModel->updateHouseListingToFinish($id)){
              // Redirect to sitter page
              flash('house_msg', 'You have finished this job');
              redirect('sitters/past_jobs');
          } else {
              die('Something went wrong');
          }
      } else {
          redirect('sitters');
      }
    }


}
