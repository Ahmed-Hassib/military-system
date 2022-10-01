<?php


// Soldiers class
class Soldiers extends Database {

    /** PROPERTIES */
    public $id;
    public $militry_num;
    public $national_id;
    public $name;
    public $address;
    public $qualifications;
    public $religion;
    public $status;
    public $num_child;
    public $father_job;
    public $mother_job;
    public $phone1;
    public $phone2;
    public $basic_unit;
    public $current_unit;
    public $specification;
    public $joined_date;
    public $discharge_date;
    public $photo;
    public $con;
    
    /** METHODS */
    public function __construct() {
        $sol_obj = new Database();
        $this->con = $sol_obj->con;
    }

    // get soldier
    public function is_exist($id) {
        # select soldier with specific id 
        $selectSoldier = "SELECT *FROM `soldier` WHERE `id` = $id LIMIT 1";
        $stmt = $this->con->prepare($selectSoldier);        # prepare query
        $stmt->execute();                                   # execute the query
        $count = $stmt->rowCount();                      # fetch data
        // return soldier data
        return $count > 0 ? true : false;
    }

    // get soldier
    public function get_soldier($id) {
        # select soldier with specific id 
        $selectSoldier = "SELECT *FROM `soldier` WHERE `id` = $id LIMIT 1";
        $stmt = $this->con->prepare($selectSoldier);        # prepare query
        $stmt->execute();                                   # execute the query
        $soldierRows = $stmt->fetch();                      # fetch data
        // return soldier data
        return $soldierRows;
    }

    // delete soldier
    public function delete_soldier($id) {
        # select soldier with specific id 
        $selectSoldier = "DELETE FROM `soldier` WHERE `id` = $id LIMIT 1";
        $stmt = $this->con->prepare($selectSoldier);        # prepare query
        $stmt->execute();                                   # execute the query
        $soldierRowCount = $stmt->rowCount();                   # get row counter of the query
        // return soldier data
        return $soldierRowCount > 0 ? true : false;
    }
}