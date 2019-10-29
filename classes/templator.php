<?php

class templator 
{
    const OPEN_BRACKET = "{";
    const CLOSE_BRACKET = "}";
    public $template;
	        function __construct()
    {

    }
    
    function LoadTemplate($name){
	$filename= APP_PATH.DS.'templates'.DS.'elements'.DS.$name.".html";
	//echo $filename;
	$this->template=  file_get_contents($filename);
	//print_r($this->template);
    }
    function loadFromString($string){
	$this->template=$string;
    }


    function Render(array $source){
	$ob_size = strlen(self::OPEN_BRACKET);
        $cb_size = strlen(self::CLOSE_BRACKET);
        $pos = 0;
        $end = strlen($this->template);
       
        while($pos <= $end)
        {
            if($pos_1 = strpos($this->template, self::OPEN_BRACKET, $pos))
            {
                if($pos_1)
                {
                    $pos_2 = strpos($this->template, self::CLOSE_BRACKET, $pos_1);
                   
                    if($pos_2)
                    {
                        $return_length = ($pos_2-$cb_size) - $pos_1;
                       
                        $var = substr($this->template, $pos_1+$ob_size, $return_length);
                       
                        $this->template = str_replace(self::OPEN_BRACKET.$var.self::CLOSE_BRACKET, $source[$var], $this->template);
                       
                        $pos = $pos_2 + $cb_size;
                    }
                    else
                    {
                        throw new exception("Incorrectly formed template - missing closing bracket. Please check your syntax.");
                        break;
                    }
                }
            }
            else
            {
                //exit the loop
                break;
            }
        }
       
        return $this->template;
    }
   
function tplAnalise(){
    preg_match_all('/\{.*?\}/is', $this->template, $match);
    return print_r($match[0],true);
}
}

/**array of values to inject into the template
$a=new templator();
$array = array("NAME" => "John Doe",
                "DOB"    => "12/21/1986",
                "ACL" => "Super Administrator");

template using '{' and '}' to signify variables
$template = "clean";
$a->LoadTemplate($template);
echo $a->Render($array);
$a=new templator($source, $template)*/
?>





