<?php

/**
 * Description of DataObject
 * 
 * This class is the parent class for all the classes. It is an abstract class used to create new classes 
 * which will handle database access and retrieval
 *
 * @author diana
 */
require_once "config.php";                       //the config.php file contains the constants used withing the classes

abstract class DataObject {

    protected $data = [];                       //creates an empty array that will hold the data from the record in the DB

    //public function __construct($data) {            //constructor accepts data from the DB in the form of an associative array
      //  foreach ($data as $key => $value) {         //with field names and values
          //  if (array_key_exists($key, $this->data)) //$data array then stores the field name and values
            //    $this->data[$key] = $value;
       // }
  //  }

    public function getValue($field) {              // Accepts field name and looks up the name in the object $data array   
        if (array_key_exists($field, $this->data)) {//it enables outside code to access the data in the object
            return $this->data[$field];
        } else {
            die("Field not found");
        }
    }

    protected function connect() {                  //Connect to the database
        try {
            $pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_PERSISTENT, true);                //enables php to keep the MySQL connection open for use by other parts of the application
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: “ . $e->getMessage() ");
        }
        return $pdo;
    }

    protected function disconnect($pdo) {          //Disconnect the database
        $pdo = "";
    }

}
?>

