<?php

/*
 * Copyright 2014 merlin.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Description of dbo
 *
 * @author merlin
 */
class dbo {
    //put your code here
    
    public $query;
   public $result =array();
   public $succes;
   private $a;
   static $inst;
   public $lastState;
   public $found;
   public $link;
   public $last_id;
   public $structure;
   function __construct() {
         $host = DB_HOST;
         $login = DB_USER;
         $password = DB_PASSWORD;
         $dbname = DB_NAME;

   $this->link = mysql_connect ($host, $login, $password) or die(mysql_error());
   mysql_select_db ($dbname);
   mysql_query('SET NAMES UTF8'); // Setting database character set UTF-8
   mysql_query('SET SESSION character_set_results = "UTF8"'); // Setting database session result character set UTF-8
   mysql_query("SET lc_time_names = 'ru_RU'") ;

    $inst=1;
    $error = mysql_error();
    if ($error) throw new Exception($error);

    mysql_select_db($dbname);
    $error = mysql_error();
    $inst++;
    if ($error) throw new Exception($error);

    mysql_query('set names "utf8"');
    $inst++;
    $error = mysql_error();
    if ($error) throw new Exception($error);
    }
    
    public function getMyObj($ObjName){
        $r = mysql_query ($this->query);
        $this->found= $this->count_row();
        while ($row = mysql_fetch_object($r)) {
            $this->result=mysql_fetch_object($r,$ObjName);
        }
        
     
    }
    
    public function ObjToArray() {
	if (is_object($this->result)) {
		// Gets the properties of the object
		$d = get_object_vars($this->result);
	}

	if (is_array($this->result)) {
		return array_map(__FUNCTION__, $this->result);
	} else {
		// Return array
		return $this->result;
	}
}
function count_row() {
        $ar=mysql_fetch_array(mysql_query('SELECT FOUND_ROWS()as found'));
        return (int)$ar['found'];
    }
public function ObjToJson($obj){
    return json_encode($this->ObjToArray());
}
}
