<?php
/**
 * Created by PhpStorm.
 * User: Marcus
 * Date: 10/5/2018
 * Time: 3:59 PM
 */

class HouseListing
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function addHouseListing($data)
    {
        // Prepare Query
        $this->db->query("INSERT INTO house_listing (house_id, start_date, end_date, price) VALUES (:house_id, :start_date, :end_date, :price);");
        $this->db->bind(':house_id', $data['house']->id);
        $this->db->bind(':start_date', $data['start_date']);
        $this->db->bind(':end_date', $data['end_date']);
        $this->db->bind(':price', $data['price']);

        //Execute
        if($this->db->execute())
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    // Get one latest house listing
    public function getOneHouseListingHouseId($id)
    {
        $this->db->query("SELECT * FROM house_listing Where house_id = :house_id ORDER BY created_date desc LIMIT 1;");
        $this->db->bind(':house_id', $id);
        $row = $this->db->single();

        return $row;
    }


    // Get one row of house listing using ID
    public function getHouseListingId($id)
    {
        $this->db->query("SELECT * From house_listing where id = :id;");
        $this->db->bind(':id', $id);
        $row = $this->db-> single();
        return $row;
    }

    // Get all house ID Listing where there is a house listing and base on an ID For Current Listing that is finish
    public function getAllHouseThatHasBeenListedFinished($id)
    {
        $this->db->query("SELECT houses.full_address,description,house_listing.id,house_listing.taken_by_user_id, houses.cover_image,house_listing.review_score,house_listing.review FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id WHERE houses.owner = :owner and house_listing.status = \"finished\" order by house_listing.created_date desc;");
        $this->db->bind(':owner', $id);
        $results = $this->db->resultset();

        return $results;
    }

    // Delete House Listing by house id
    public function deleteHouseListing($id)
    {
        // Prepare Query
        $this->db->query('DELETE FROM house_listing where id = :id');

        // Bind Values
        $this->db->bind(':id', $id);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Update House Listing for review and review score
    public function updateHouseListingReview($data)
    {
        // Prepare Query
        $this->db->query('Update house_listing set review_score = :review_score, review = :review where id = :id;');

        // Bind Values
        $this->db->bind(':id' ,$data['id']);
        $this->db->bind(':review_score' ,$data['review_score']);
        $this->db->bind(':review' ,$data['review']);


        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Update House Listing details while it is still available
    public function updateAvailableListing($data)
    {
      // Prepare Query
      $this->db->query('Update house_listing set price = :price, start_date = :start_date, end_date = :end_date where id = :id;');

      // Bind Values
      $this->db->bind(':id' ,$data['id']);
      $this->db->bind(':price' ,$data['price']);
      $this->db->bind(':start_date' ,$data['start_date']);
      $this->db->bind(':end_date' ,$data['end_date']);

        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    // Update House Listing to taken
    public function updateHouseListingToTaken($data)
    {
        $this->db->query('Update house_listing set status = "taken", taken_by_user_id= :user_id where id = :listing_id');
        $this->db->bind(':listing_id' ,$data['listing_id']);
        $this->db->bind(':user_id' ,$data['user_id']);

        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    // Update House Listing to Available
    public function updateHouseListingToAvailable($id)
    {
        $this->db->query('Update house_listing set status = "available", taken_by_user_id = null where id = :id');
        $this->db->bind(':id', $id);

        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Update House Listing to finish
    public function updateHouseListingToFinish($id)
    {
        $this->db->query('Update house_listing set status = "finished" where id = :id');
        $this->db->bind(':id', $id);

        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    // Get All Available House Listing
    public function getAllAvailableHouseListing()
    {
        $this->db->query("SELECT houses.full_address,houses.contact_number,description,pet,plant,house_listing.id,house_listing.taken_by_user_id,house_listing.created_date,house_listing.start_date,house_listing.end_date,house_listing.price,house_listing.review,house_listing.review_score,email,first_name,last_name FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id INNER JOIN users ON users.id = houses.owner WHERE house_listing.status = \"available\" order by start_date desc;");
        $results = $this->db->resultset();

        return $results;
    }

    // Get all on-going listing by an owner ID (taken and not finished) that an owner currently has and who the sitter is
    public function getAllOnGoingListing($id)
    {
        $this->db->query("SELECT t1.id,t1.full_address,t1.created_date,t1.start_date,t1.end_date,t1.price,t1.review,t1.review_score,t2.first_name,t2.last_name,t2.contact_number,t2.email FROM (SELECT houses.full_address,houses.contact_number,description,pet,plant,house_listing.id,house_listing.taken_by_user_id,house_listing.created_date,house_listing.start_date,house_listing.end_date,house_listing.price,house_listing.review,house_listing.review_score,email,first_name,last_name FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id INNER JOIN users ON users.id = houses.owner WHERE users.id = :id AND house_listing.status = \"taken\" order by start_date) AS t1 INNER JOIN users AS t2 On t1.taken_by_user_id = t2.id");
        $this->db->bind(':id', $id);
        $results = $this->db->resultset();

        return $results;
    }

    // Get all available listing by an owner ID (available and no one take yet) that an owner currently has and who the sitter is
    public function getOwnerAvailableListing($id)
    {
        $this->db->query("SELECT houses.full_address,houses.contact_number,description,pet,plant,house_listing.id,house_listing.taken_by_user_id,house_listing.created_date,house_listing.start_date,house_listing.end_date,house_listing.price,house_listing.review,house_listing.review_score,email,first_name,last_name FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id INNER JOIN users ON users.id = houses.owner WHERE house_listing.status = \"available\" AND users.id = :id order by start_date desc;");
        $this->db->bind(':id', $id);
        $results = $this->db->resultset();

        return $results;
    }

    // Get all sitter's current jobs by sitter's id
    public function getCurrentJobs($id)
    {
        $this->db->query("SELECT houses.full_address,houses.contact_number,description,pet,plant,house_listing.id,house_listing.taken_by_user_id,house_listing.created_date,house_listing.start_date,house_listing.end_date,house_listing.price,house_listing.review,house_listing.review_score,email,first_name,last_name FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id INNER JOIN users ON users.id = houses.owner WHERE taken_by_user_id = :id and house_listing.status = \"taken\" order by start_date; ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultset();

        return $results;
    }

    // Get all sitter's past jobs by sitter's id
    public function getPastJobs($id)
    {
        $this->db->query("SELECT houses.full_address,houses.contact_number,description,pet,plant,house_listing.id,house_listing.taken_by_user_id,house_listing.created_date,house_listing.start_date,house_listing.end_date,house_listing.price,house_listing.review,house_listing.review_score,email,first_name,last_name FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id INNER JOIN users ON users.id = houses.owner WHERE taken_by_user_id = :id and house_listing.status = \"finished\" order by start_date; ");
        $this->db->bind(':id', $id);
        $results = $this->db->resultset();

        return $results;
    }

    // Get one listing with owner's details and house details by listing's id
    public function getOneListing($id)
    {
        $this->db->query("SELECT houses.owner,houses.full_address,houses.contact_number,description,pet,plant,house_listing.id,house_listing.taken_by_user_id,house_listing.created_date,house_listing.start_date,house_listing.end_date,house_listing.price,house_listing.review,house_listing.review_score,email,first_name,last_name FROM house_listing INNER JOIN houses ON house_listing.house_id = houses.id INNER JOIN users ON users.id = houses.owner WHERE house_listing.id = :id;");
        $this->db->bind(':id', $id);
        $row = $this->db-> single();
        return $row;
    }

    // Get sitter's details by listing's id
    public function getListingSitter($id)
    {
        $this->db->query("SELECT email,first_name,last_name FROM house_listing INNER JOIN users ON users.id = house_listing.taken_by_user_id WHERE house_listing.id = :id;");
        $this->db->bind(':id', $id);
        $row = $this->db-> single();
        return $row;
    }

}
