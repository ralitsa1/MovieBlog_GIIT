<?php

Include 'config.php';
require_once 'DataObject.php';

Class Movie extends DataObject {

    public function getMovies() {   //grabs the data from the movies table
        $pdo = DataObject::connect();           //Connect to the database via the DataObject class - catches errors

        $stmt = $pdo->prepare("SELECT * FROM movies");       //WHERE movieName = :movieName");

        try {
            $stmt->execute(); //['movieName' => $movieName]);                                                   //3. execute
        } catch (PDOException $e) {
            echo $e->getMessage();
            $error = $e->errorInfo();   //4. check error
            die();
        }
        $movies_row = $stmt->fetch(PDO::FETCH_ASSOC);    //5. use data
        $this->movie[] = $movies_row;
        return $this->movie;


        //echo "found" . $movie['movieName'];
        //echo $movie['movieName'];
    }

    public function insertMovies() {

        $pdo = DataObject::connect();

        $stmt = $pdo->prepare("INSERT INTO movies (movieName,movieYear, movieCert, movieRuntime)
                                    VALUES (:movieName, :movieYear, :movieCert, :movieRunTime)");

        try {
            #Collect info from a form which will be used to add a movie to the database - filter_input is required
            //$stmt->execute(["movieName" => $_GET['movieName'], "movieYear" => $_GET['movieYear'], "movieCert" => $_GET['movieCert'], "movieRunTime" => $_GET['movieRunTime']]);
        
            $stmt->execute(['movieName' => 'Shawshank Redemption', 'movieYear' => '1995', 'movieCert' => '18', 'movieRunTime' => '200mins']);
        } catch (PDOException $e) {
            echo $e->getMessage();
            $error = $e->errorInfo();   //4. check error
            die();
        }
    }

}

$newMovie = new Movie();
print_r($newMovie->getMovies());
$newMovie->insertMovies();

