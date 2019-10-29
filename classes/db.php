<?php
class db {

    // Database properties
    const DATABASE = DB_NAME;
    const HOST = DB_HOST;
    const DATABASE_USER = DB_USER;
    const DATABASE_PASSWORD = DB_PASSWORD;

    private $link;
    public $lastState;
    public $query;
    public $result = array();
    public $succes;
    private $a;
    static $inst;
    public $found;
    public $last_id;
    public $structure;

    public function __construct() {
        $this->link = new mysqli(self::HOST, self::DATABASE_USER, self::DATABASE_PASSWORD, self::DATABASE);
        $this->link->set_charset('utf8mb4');
        if ($this->link->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->_mysqli->connect_errno . ") " . $this->_mysqli->connect_error;
        }
    }
    public function get_fields($table) {
	$zapros="SHOW FULL COLUMNS FROM $table";
	foreach ( $this->get_result($zapros) as $v){
	   // print_r($v);
    	    $out[$v->Field]= (object) array('label'=>$v->Comment,'type'=>$v->Type);
	}
	return $out;
    }

    public static function init() {
        static $inst = false;
        if (!$inst) {
            $inst = new self();
        }
        return $instance;
    }

    function q($zapros) {
        $this->result = mysqli_fetch_array(mysqli_query($this->link, $zapros));
        $this->lastState = mysqli_error($this->link);
        $this->last_id = mysqli_insert_id($this->link);
    }

    function query($zapros) {
        $this->result = mysqli_query($this->link, $zapros);
        $this->lastState = mysqli_error($this->link);
        $this->last_id = mysqli_insert_id($this->link);
    }

    function get_rows($zapros) {
        $rest = mysqli_query($this->link, $zapros);
        //$this->found= $this->count_row();
        while ($row = mysqli_fetch_assoc($rest)) {
            $out[] = $row;
        }

        $this->lastState = mysqli_error($this->link);
        return $out;
    }

    function get_cols($zapros) {
        $rest=mysqli_query($this->link,$zapros);
        while ($row = mysqli_fetch_assoc($rest)) {
            foreach ($row as $key => $value) {
                //echo "$key=$value";
               $out[$key][]=$value;
            }
        }
        return $out;
    }

    function fetch_array($zapros) {
        $this->result = mysqli_fetch_assoc(mysqli_query($this->link, $zapros));
        $this->found = $this->count_row();
        $this->lastState = mysqli_error($this->link);
    }

    function get_result($zapros) {
	//echo $zapros." ";
        $out = array();
        $this->result = $this->link->query($zapros);
        $this->found= $this->count_row();
        while ($row = $this->result->fetch_object()) {
            $out[] = $row;
        }
        
        return $out;
    }
    public function escape($p){
        return mysqli_real_escape_string($this->link,$p);
    }

    function count_row() {
        $ar = mysqli_fetch_array(mysqli_query($this->link, 'SELECT FOUND_ROWS()as found'));
        return (int) $ar['found'];
    }

    function close() {
        mysqli_close($this->link);
    }

}
    
