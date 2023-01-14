<?php
class Database
{
    public static function StartUp()
    {

        $server="localhost"; 
        $user="root"; 
        $pass=""; 
        $db="cart"; 
        
        // connect to mysql 

        $connection = mysqli_connect($server, $user, $pass, $db);

        if (mysqli_connect_errno()) {
            printf("Falló la conexión: %s\n", mysqli_connect_error());
            exit();
        }
        
        return $connection; 
    }
}