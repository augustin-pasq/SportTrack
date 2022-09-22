<?php

require_once('SqliteConnection.php');

class ActivityDAO {

    private static ActivityDAO $dao;

    private function __construct() {}

    public static function getInstance(): ActivityDAO {
        if(!isset(self::$dao)) { self::$dao= new ActivityDAO(); }
        return self::$dao;
    }

    public final function findAll(): Array {
        $dbc = SqliteConnection::getInstance()->getConnection();
        $query = "SELECT * FROM Activity ORDER BY date";
        $stmt = $dbc->query($query);
        $results = $stmt->fetchALL(PDO::FETCH_CLASS, 'Activity');
        return $results;
    }

    public final function insert(Activity $st): void {
        if($st instanceof Activity) {
            
            $da = $st->getDate();
            $ds = $st->getDescription();
            $m = $st->getMailUser();

            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "INSERT INTO Activity (date, description, activityUser) VALUES ('$da', '$ds', '$m')";
            $stmt = $dbc->prepare($query);
            $stmt->execute();
        }
    }

    public function update(Activity $st): void {
        if($st instanceof Activity) {

            $da = $st->getDate();
            $ds = $st->getDescription();
            $m = $st->getMailUser();
            
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "UPDATE Activity SET date = '$da', description = '$ds', activityUser = '$m'";
            $stmt = $dbc->prepare($query); 
            $stmt->execute();
        }
    }
    
    public function delete(Activity $st): void { 
        if($st instanceof Activity){

            $da = $st->getDate();
            $ds = $st->getDescription();
            $m = $st->getMailUser();
            
            $dbc = SqliteConnection::getInstance()->getConnection();
            $query = "DELETE FROM User WHERE date = '$da', description = '$ds', activityUser = '$m'";
            $stmt = $dbc->prepare($query);
            $stmt->execute();
        }
    }
}

?>