<?php
/**
 * Created by PhpStorm.
 * User: Marcus
 * Date: 3/5/2018
 * Time: 4:03 PM
 */




class Owners extends Controller
{

    public function __construct(){
        if(!isset($_SESSION['user_id'])) {
            redirect('users/login');
        }


        else if($_SESSION['type'] == 'sitter')
        {
            redirect('sitters');
        }


        $this->ownerModel = $this->model('Owner');
        $this->userModel = $this->model('User');
        $this->houseListingModel = $this->model('HouseListing');


    }

    // Retrieve Houses
    public function index()
    {
        // Dashboard

        $houses = $this->ownerModel->getAllHouseByOwnerId($_SESSION['user_id']);

        $data = [
            'houses' => $houses
        ];

        $this->view('owners/index', $data);
    }

    public function past_listing()
    {
        $houses = $this->houseListingModel->getAllHouseThatHasBeenListedFinished($_SESSION['user_id']);

        $data = [
            'houses' => $houses
        ];

        $this->view('owners/past_listing',$data);
    }

    public function current_listing()
    {
        $houses = $this->houseListingModel->getAllOnGoingListing($_SESSION['user_id']);

        $data = [
            'houses' => $houses
        ];



        $this->view('owners/current_listing',$data);
    }

    public function available_listing()
    {
        $houses = $this->houseListingModel->getOwnerAvailableListing($_SESSION['user_id']);

        $data = [
            'houses' => $houses
        ];



        $this->view('owners/available_listing',$data);
    }

    public function new_listing($id)
    {


        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $house = $this->ownerModel->getOneHouseById($id);

            $data = [
                'house' => $house,
                'price' => doubleval($_POST['price']),
                'start_date' => date("Y-m-d", strtotime($_POST['start_date'])),
                'end_date' => date("Y-m-d", strtotime($_POST['end_date'])),
                'price_err' => '',
                'start_date_err' => '',
                'end_date_err' => '',

            ];

            // Validate Price
            if(empty($data['price']))
            {
                $data['price_err'] ='Place a price';
            }

            // Validate end date
            $startDate = strtotime(date('Y-m-d', strtotime($data['start_date']) ) ).' ';
            $endDate = strtotime(date('Y-m-d', strtotime($data['end_date']) ) ).' ';
            $nowDate = strtotime(date('Y-m-d'));

            if($startDate > $endDate)
            {
                $errorMsg ='End date must be after start date';
                $data['end_date_err'] ='End date must be after start date';

            }

            if($startDate < $nowDate)
            {
                $errorMsg ='Start date must be after today';
                $data['end_date_err'] ='Start date must be after today';

            }

            // Make sure there are no errors
            if(empty($data['price_err']) && empty($data['start_date_err']) && empty($data['end_date_err']) )
            {
                // Validation passed
                // Execute
                if($this->houseListingModel->addHouseListing($data))
                {
                    // Redirect to Dashboard
                    flash('house_msg', 'Listing Added');
                    redirect('owners/available_listing');
                }
                else{
                    die('Something went wrong');
                }
            }else{
                // Load View with Errors
                flash('error_msg', $errorMsg);
                $this->view('owners/new_listing', $data);
            }
        }
        else{
            $house = $this->ownerModel->getOneHouseById($id);
            $data =[
                'house'=>$house,
                'price' => '',
                'start_date' => '',
                'end_date' =>  '',
            ];
        }

        $this->view('owners/new_listing', $data);
    }

    public function delete_listing($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Execute
            if($this->houseListingModel->deleteHouseListing($id)){
                // Redirect to owner page
                flash('house_msg', 'Listing Removed');
                redirect('owners/available_listing');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('owners/current_listing');
        }
    }

    public function review_listing($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'review_score' => doubleval($_POST['review_score']),
                'review' => trim($_POST['review']),
            ];

            //Execute
            if($this->houseListingModel->updateHouseListingReview($data)){
              $sitter = $this->houseListingModel->getListingSitter($data['id']);

              $mailto = $sitter->email;
              $subject = 'You have receive a review';
              $message = "Dear ".$sitter->first_name." \r\n".'You have received a review for your work';
              $from = 'noreply@happy-home.name';
              $header = 'From:'.$from;


              if(mail($mailto,$subject,$message,$header)) {
                // Redirect to review listing
                flash('house_msg', 'Reviews Submitted');
                redirect('owners/past_listing');
              }
              else{
                die('Something went wrong');
              }

            } else {
                die('Something went wrong');
            }
        }
        else{
            // Get Data

            $houseListing = $this->houseListingModel->getHouseListingId($id);
            $house = $this->ownerModel->getOneHouseById($houseListing->house_id);
            $user =  $this->userModel->getUserById($houseListing->taken_by_user_id);

            // Check for owners
            if($house->owner != $_SESSION['user_id']){
                redirect('owners');
            }

            $data = [
                'id' => $id,
                'user' => $user,
                'review_score' => '0',
                'review' => '',
            ];

            $this->view('owners/review_listing', $data);
        }

        $this->view('owners/review_listing',$data);
    }

    // View House Details
    public function house_details($id)
    {
        $house = $this->ownerModel->getOneHouseById($id);
        $houseListing = $this->houseListingModel ->getOneHouseListingHouseId($house->id);

        $data = [
            'house' => $house,
            'houseListing' => $houseListing,

        ];
        $this->view('owners/house_details', $data);
    }

    // Create House
    public function house_register()
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            // Sanitize POST
            $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data = [
                'unit_no' => trim($_POST['unit_no']),
                'full_address' => trim($_POST['full_address']),
                'street_number' => trim($_POST['street_number']),
                'route' => trim($_POST['route']),
                'locality' => trim($_POST['locality']),
                'administrative_area_level_1' => trim($_POST['administrative_area_level_1']),
                'postal_code' => trim($_POST['postal_code']),
                'country' => trim($_POST['country']),
                'latitude' => floatval($_POST['latitude']),
                'longitude' => floatval($_POST['longitude']),
                'contact_number' => trim($_POST['contact_number']),
                'description' => trim($_POST['description']),
                'pet' => intval($_POST['pet']),
                'plant' => intval($_POST['plant']),
                'cover_image' => '',
                'owner' => $_SESSION['user_id'],
                'full_address_err' => '',
                'street_number_err' => '',
                'route_err' => '',
                'locality_err' => '',
                'administrative_area_level_1_err' => '',
                'postal_code_err' => '',
                'country_err' => '',
                'latitude_err' => '',
                'longitude_err' => '',
                'contact_number_err' => '',

            ];
            //upload image
            // image file directory


            // Validate Full address
            if(empty($data['full_address']))
            {
                $data['full_address_err'] ='Please enter a building name';
            }

            // Validate Street number
            if(empty($data['street_number']))
            {
                $data['street_number_err'] ='Please enter street number';
            }

            // Validate route
            if(empty($data['route']))
            {
                $data['route_err'] ='Please enter route';
            }

            // Validate locality
            if(empty($data['locality']))
            {
                $data['locality_err'] ='Please enter locality';
            }

            // Validate state
            if(empty($data['administrative_area_level_1']))
            {
                $data['administrative_area_level_1_err'] ='Please enter administrative_area_level_1';
            }

            // Validate postal code
            if(empty($data['postal_code']))
            {
                $data['postal_code_err'] ='Please enter postal_code';
            }


            // Validate country
            if(empty($data['country']))
            {
                $data['country_err'] ='Please enter country';
            }

            // Validate latitude
            if(empty($data['latitude']))
            {
                $data['latitude_err'] ='Please enter latitude';
            }

            // Validate longitute
            if(empty($data['longitude']))
            {
                $data['longitude_err'] ='Please enter longitute';
            }

            // validate contact number
            if(empty($data['contact_number']))
            {
                $data['contact_number_err'] = 'Please enter contact number';
            }
            //debug only
            //$msg = '';

            if(isset($_FILES['cover_image']))
            {
                if($_FILES['cover_image']['error'] == UPLOAD_ERR_NO_FILE) {
                    $data['cover_image'] = 'no_image.png';
                }
                else {

                    $data['cover_image'] = time()."_".$_FILES['cover_image']['name'];
                    $target = getcwd().DIRECTORY_SEPARATOR."images/cover_image/".basename($data['cover_image']);
                    move_uploaded_file($_FILES['cover_image']['tmp_name'], $target);

                    //debug only
                    /*
                    if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target)){
                      $msg = 'file is uploaded to ' . $target;
                    } else{
                      $msg = 'no';
                    }
                    */
                }
            }




            // Make sure there are no errors
            if(empty($data['full_address_err']) && empty($data['street_number_err']) && empty($data['route_err']) && empty($data['locality_err']) && empty($data['administrative_area_level_1_err']) && empty($data['postal_code_err']) && empty($data['country_err']) && empty($data['latitude_err']) && empty($data['longitude_err']) && empty($data['contact_number_err']))
            {
                // Validation passed
                // Execute
                if($this->ownerModel->register($data))
                {
                    // Redirect to Dashboard

                    //debug only
                    //flash('house_msg', $msg." ".$target);

                    flash('house_msg', "House Added");
                    redirect('owners');
                }
                else{
                    die('Something went wrong');
                }
            }else{
                // Load View with Errors
                $this->view('owners/house_register', $data);
            }
        }
        else{
            $data =[
                'unit_no' => '',
                'full_address' => '',
                'street_number' =>  '',
                'route' =>  '',
                'locality' =>  '',
                'administrative_area_level_1' =>  '',
                'postal_code' =>  '',
                'country' => '',
                'latitude' =>  '',
                'longitude' =>  '',
                'contact_number' =>  '',
                'description' =>  '',
                'pet' =>  '',
                'plant' =>  '',
                'cover_image' =>  '',
            ];
            $this->view('owners/house_register', $data);
        }

    }


    // Update House
    public function house_edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'contact_number' => trim($_POST['contact_number']),
                'description' => trim($_POST['description']),
                'pet' => intval($_POST['pet']),
                'plant' => intval($_POST['plant']),
                'contact_number_err' => '',
            ];

            // validate contact number
            if(empty($data['contact_number']))
            {
                $data['contact_number_err'] = 'Please enter contact number';
            }



            // Make sure there are no errors
            if(empty($data['contact_number_err'])){
                // Validation passed
                //Execute
                if($this->ownerModel->updateHouse($data)){
                    // Redirect to login
                    flash('house_msg', 'House Updated');
                    redirect('owners');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('owners/house_edit', $data);
            }

        } else{
            // Get houses from owner model
            $house = $this->ownerModel->getOneHouseById($id);

            // Check for owners
            if($house->owner != $_SESSION['user_id']){
                redirect('owners');
            }

            $data = [
                'id' => $id,
                'contact_number' => $house->contact_number,
                'description' => $house->description,
                'pet' => $house->pet,
                'plant' => $house->plant,
            ];

            $this->view('owners/house_edit', $data);
        }
    }


    // Delete house
    public function house_delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Execute
            if($this->ownerModel->deleteHouse($id)){
                // Redirect to owner page
                flash('house_msg', 'House Removed');
                redirect('owners');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('owners');
        }
    }


    //update listing
    public function listing_edit($id)
    {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST
            $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'start_date' => trim($_POST['start_date']),
                'end_date' => trim($_POST['end_date']),
                'price' => trim($_POST['price']),
            ];

            // validate price
            if(empty($data['price']))
            {
                $data['price_err'] = 'Please enter a price';
            }

            if(empty($data['start_date']))
            {
                $data['start_date_err'] = 'Please enter a start date';
            }

            if(empty($data['end_date']))
            {
                $data['end_date_err'] = 'Please enter a end date';
            }

            // Make sure there are no errors
            if(empty($data['price_err']) && empty($data['start_date_err']) && empty($data['end_date_err'])){
                // Validation passed
                //Execute
                if($this->houseListingModel->updateAvailableListing($data)){
                    // Redirect to available listing
                    flash('house_msg', 'Listing Updated');
                    redirect('owners/available_listing');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('owners/listing_edit', $data);
            }

        } else{
            // Get listing from house Listing model
            $house = $this->houseListingModel->getOneListing($id);

            // Check for owners
            if($house->owner != $_SESSION['user_id']){
                redirect('owners');
            }

            $data = [
                'id' => $id,
                'start_date' => $house->start_date,
                'end_date' => $house->end_date,
                'price' => $house->price,
            ];

            $this->view('owners/listing_edit', $data);
        }
    }

    public function profile()
    {
      // Get their profile
      $user = $this->userModel->getUserById($_SESSION['user_id']);
      $data = [
          'user' => $user
      ];

      $this->view('owners/profile', $data);
    }




}
