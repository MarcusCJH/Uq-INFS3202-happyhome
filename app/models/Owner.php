<?php
/**
 * Created by PhpStorm.
 * User: Marcus
 * Date: 3/5/2018
 * Time: 4:05 PM
 */

class Owner
{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }


    // Register House listing
    public function register($data)
    {

        // Prepare Query
        $this->db->query("INSERT INTO houses (unit_no, full_address, street_number, route, locality, administrative_area_level_1, postal_code, country, latitude, longitude, contact_number, description, pet, plant, cover_image, owner)

VALUES (:unit_no, :full_address, :street_number, :route, :locality,:administrative_area_level_1, :postal_code, :country, :latitude, :longitude, :contact_number, :description, :pet, :plant, :cover_image, :owner)");


        // Bind Values
        $this->db->bind(':unit_no', $data['unit_no']);
        $this->db->bind(':full_address', $data['full_address']);
        $this->db->bind(':street_number', $data['street_number']);
        $this->db->bind(':route', $data['route']);
        $this->db->bind(':locality', $data['locality']);
        $this->db->bind(':administrative_area_level_1', $data['administrative_area_level_1']);
        $this->db->bind(':postal_code', $data['postal_code']);
        $this->db->bind(':country', $data['country']);
        $this->db->bind(':latitude', $data['latitude']);
        $this->db->bind(':longitude', $data['longitude']);
        $this->db->bind(':contact_number', $data['contact_number']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':pet', $data['pet']);
        $this->db->bind(':plant', $data['plant']);
        $this->db->bind(':cover_image', $data['cover_image']);
        $this->db->bind(':owner', $data['owner']);

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



    // Update
    public function updateHouse($data){
        // Prepare Query
        $this->db->query('UPDATE houses set contact_number = :contact_number, description = :description, pet = :pet, plant = :plant WHERE ID =:id;');

        // Bind Values
        $this->db->bind(':contact_number' ,$data['contact_number']);
        $this->db->bind(':description' ,$data['description']);
        $this->db->bind(':pet' ,$data['pet']);
        $this->db->bind(':plant' ,$data['plant']);
        $this->db->bind(':id' ,$data['id']);

        //Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


    // Delete by house by house ID

    public function deleteHouse($id)
    {
        // Prepare Query
        $this->db->query('DELETE FROM houses WHERE id = :id');

        // Bind Values
        $this->db->bind(':id', $id);

        //Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Retrieve all house by owner where order by created desc
    public function getAllHouseByOwnerId ($id)
    {
        $this->db->query("SELECT * FROM houses WHERE owner = :owner order by created_at desc;");

        $this->db->bind(':owner', $id);

        $results = $this->db->resultset();

        return $results;
    }

    // Retrieve one house by House ID
    public function getOneHouseById($id)
    {
        $this->db->query("SELECT * FROM houses WHERE id = :id;");
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }


    // Retrieve 3 houses order by desc limit 3
    public function getThreeLatestHouses()
    {
        $this->db->query("SELECT * FROM houses order by created_at desc LIMIT 3; ");
        $results = $this->db->resultset();

        return $results;
    }




}
