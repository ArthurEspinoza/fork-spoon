<?php 
    class Singleton 
    {
        public $db;     
        private static $dns = "mysql:host=localhost;dbname=forkspoon"; 
        private static $user = "root"; 
        private static $pass = "";     
        private static $instance;
    
        public function __construct ()  
        {        
        $this->db = new PDO(self::$dns,self::$user,self::$pass);
        $this->db->exec("set names utf8");     
        } 
    
        public static function getInstance()
        { 
            if(!isset(self::$instance)) 
            { 
                $object= __CLASS__; 
                self::$instance=new $object; 
            } 
            return self::$instance; 
        }    
    }
?>