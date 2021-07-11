
<?php

class Constants
{
    //DATABASE DETAILS
    static $DB_SERVER="localhost";
    static $DB_NAME="driver_schedule";
    static $USERNAME="t8lsv6sm34a5";
    static $PASSWORD="Abhayam@123";

    //STATEMENTS
    static $SQL_SELECT_ALL="SELECT * FROM driver_allocate";

}

include_once('gistfile1');

class Driverschedule
{
    /*******************************************************************************************************************************************/
    /*
       1.CONNECT TO DATABASE.
       2. RETURN CONNECTION OBJECT
    */
    public function connect()
    {
        $con=new mysqli(Constants::$DB_SERVER,Constants::$USERNAME,Constants::$PASSWORD,Constants::$DB_NAME);
        if($con->connect_error)
        {
            // echo "Unable To Connect"; - For debug
            return null;
        }else
        {
            //echo "Connected"; - For debug
            return $con;
        }
    }
    /*******************************************************************************************************************************************/
    /*
       1.SELECT FROM DATABASE.
    */
    public function select()
    {
        $con=$this->connect();
        if($con != null)
        {
            $result=$con->query(Constants::$SQL_SELECT_ALL);
            if($result->num_rows>0)
            {
                $driverallocate=array();
                while($row=$result->fetch_array())
                {
                   // array_push($spacecrafts, array("id"=>$row['id'],"name"=>$row['name'],
                   //"propellant"=>$row['propellant'],"destination"=>$row['destination'],
                   // "image_url"=>$row['image_url'],"technology_exists"=>$row['technology_exists']));

                   array_push($driverallocate, array("id"=>$row['id'],"employee"=>$row['employee'],
                   "driver"=>$row['driver'],"travel_date"=>$row['travel_date'],
                   "start_time"=>$row['start_time'],"pickup"=>$row['pickup'],
                   "drop_location"=>$row['drop_location']));
                }
                print(json_encode(array_reverse($driverallocate)));
            }else
            {
                print(json_encode(array("PHP EXCEPTION : CAN'T RETRIEVE FROM MYSQL. ")));
            }
            $con->close();

        }else{
            print(json_encode(array("PHP EXCEPTION : CAN'T CONNECT TO MYSQL. NULL CONNECTION.")));
        }
    }
}
$driverallocate=new Driverschedule();
$driverallocate->select();


function sendPushNotification($to='', $data()){

	$appKey = 'AIzaSyB9HeJrgQ1F_r_9s99ADEe08rL7p6K3Za0';
	$fields = array()
}