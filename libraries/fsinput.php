<?php
class  FSInput
{    
	function __construct() {
	   
	}
	
	public static function  get( $varname , $default = null, $type = ''  , $method = '')
	{
		global $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_COOKIE_VARS, $_REQUEST;
		
		$value	=	$default;

		
		if ( isset( $_POST[ $varname ] ) )
		{
			$value	= 	$_POST[ $varname ];
		}
		else if ( isset($_GET[ $varname ]) )
		{
			$value 	= 	$_GET[ $varname ];
		}
		else if( isset($_REQUEST[ $varname ] ) )
		{
			$value	=	$_REQUEST[ $varname ];
		}
		else if( isset($_FILES[ $varname ] ) )
		{
			$value	=	$_FILES[ $varname ];
		}
		if(!isset($value) && !isset($default))
			return; 
			
		if(!isset($value) && isset($default))
		{
			$value = $default;
		}
//		if(empty($value)){
//			if(isset($default)){
//				$value = $default;
//			}
//		}
		switch ( $type )
		{			
			case 'txt':
				$value = FSInput::def( trim($value ));
				break;
			case 'int':
				$value = FSInput::cint($value );
				break;
			case 'sql':
				$value = FSInput::csql( trim($value ));
				break;
			case 'array':
				$value = FSInput::carray( $value );
				break;
			default:
                if(is_array($value))
                    $value = FSInput::carray( $value );
                else
				    $value = FSInput::cstr( trim($value));
				break;
		}
		
		$value = FSInput::clean2($value);
		return $value;
	}
    
    public static function  get2( $varname , $default = null, $type = ''  , $method = '')
	{
		global $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_COOKIE_VARS, $_REQUEST;
		
		$value	=	$default;
		
		if ( isset( $_POST[ $varname ] ) )
		{
			$value	= 	$_POST[ $varname ];
		}
		else if ( isset($_GET[ $varname ]) )
		{
			$value 	= 	$_GET[ $varname ];
		}
		else if( isset($_REQUEST[ $varname ] ) )
		{
			$value	=	$_REQUEST[ $varname ];
		}
		else if( isset($_FILES[ $varname ] ) )
		{
			$value	=	$_FILES[ $varname ];
		}
		if(!isset($value) && !isset($default))
			return; 
			
		if(!isset($value) && isset($default))
		{
			$value = $default;
		}
//		if(empty($value)){
//			if(isset($default)){
//				$value = $default;
//			}
//		}
		switch ( $type )
		{			
			case 'txt':
				$value = FSInput::def( trim($value ));
				break;
			case 'int':
				$value = FSInput::cint($value );
				break;
			case 'sql':
				$value = FSInput::csql( trim($value ));
				break;
			case 'array':
				$value = FSInput::carray( $value );
				break;
			default:
				$value = FSInput::cstr( trim($value ));
				break;
		}
        
        $value = FSInput::clean($value);
		return $value;
	}
    
    public static function clean($string = '') {
        $string =  str_replace("'", '', $string);
        $string =  str_replace('(', '', $string);
        $string =  str_replace(')', '', $string);
        $string =  str_replace('UNION', '', $string);
        $string =  str_replace('union', '', $string);
        $string =  str_replace('select', '', $string);
        $string =  str_replace('SELECT', '', $string);
        $string =  str_replace('CONCAT', '', $string);
        $string =  str_replace('concat', '', $string);
        $string =  str_replace('count', '', $string);
        $string =  str_replace('COUNT', '', $string);
        $string =  str_replace('from', '', $string);
        $string =  str_replace('FROM', '', $string);
        $string =  str_replace('*', '', $string);
        $string =  str_replace('`', '', $string);
        $string =  str_replace('=', '', $string);
        $string =  str_replace('--', '', $string);
        $string =  str_replace('--+', '', $string);
        $string =  str_replace('--+-', '', $string);
        $string =  str_replace(';%00', '', $string);
        $string =  str_replace('`', '', $string);
        $string =  str_replace('+', '', $string);
        $string =  str_replace('|', '', $string);
        $string =  str_replace('~', '', $string);
        $string =  str_replace('!', '', $string);
        $string =  str_replace('^', '', $string);
        $string =  str_replace('"', '', $string);
        $string =  str_replace('<', '', $string);
        $string =  str_replace('>', '', $string);
        $string =  str_replace('ScRiPt', '', $string);
        $string = str_replace("onclick","", $string);
        $string = str_replace("onmouseover","", $string);
        $string = str_replace("prompt(","", $string);
        $string = str_replace("eval(","", $string);
        $string = str_replace("<script","", $string);
        $string = str_replace("alert(","", $string);
        $string = str_replace("[]","", $string);
        $string = str_replace("'","", $string);
        $string = str_replace('"','', $string);
        $string = str_replace('<','', $string);
        $string = str_replace('>','', $string);
        $string = str_replace('*','', $string);
       return $string; // Removes special chars.
    }
    
    public static function clean2($string = '') {
        $string =  str_replace('UNION', '', $string);
        $string =  str_replace('union', '', $string);
    
        $string =  str_replace('CONCAT', '', $string);
        $string =  str_replace('concat', '', $string);
        $string =  str_replace('count', '', $string);
        $string =  str_replace('COUNT', '', $string);
        $string =  str_replace('from', '', $string);
        $string =  str_replace('FROM', '', $string);
        $string =  str_replace('`', '', $string);
        $string =  str_replace('--', '', $string);
        $string =  str_replace('--+', '', $string);
        $string =  str_replace('--+-', '', $string);
        $string =  str_replace(';%00', '', $string);
    
        $string =  str_replace('ScRiPt', '', $string);
        $string = str_replace("onclick","", $string);
        $string = str_replace("onmouseover","", $string);
        $string = str_replace("prompt(","", $string);
        $string = str_replace("eval(","", $string);
        $string = str_replace("<script","", $string);
        $string = str_replace("alert(","", $string);
        $string = str_replace("[]","", $string);
        $string = str_replace('<','', $string);
       return $string; // Removes special chars.
    }
		
	public static function encode( $strval )
	{		
		if(strlen($strval)) {
			$strval = htmlentities($_POST[$strval], ENT_QUOTES);
		}
		return $strval;
	}
	
	public static function decode( $strval )
	{
		if(strlen($strval)) {
			$strval = html_entity_decode($strval, ENT_QUOTES);
		}
		return $strval;
	}
	
	public static function cstr( $strval )
	{
//		if ( get_magic_quotes_gpc() == 0 ) $strval = addslashes($strval);
//		if ( get_magic_quotes_gpc() == 0 ) $strval = stripslashes($strval);
		
		if(strlen($strval))
			$strval = htmlspecialchars($strval);
		return $strval;
	}
	
	
	public static function def( $strval )
	{
//		if ( get_magic_quotes_gpc() == 0 ) $strval = addslashes($strval);
		
		$strval = htmlspecialchars($strval);
		
		return $strval;
	}
	
	
	public static function csql( $strval )
	{
//		if ( get_magic_quotes_gpc() == 0 )
		    $strval = addslashes($strval);
		
		return $strval;
	}
	
	
	public static function cint( $intval ){
		if(!isset($intval)){
			return null;
		}
		if(empty($intval)){
			return $intval;
		}
		$intval = (int) $intval;
		
		return $intval;
	}
	public static function carray( $arrayval )
	{
		return (array)$arrayval;
	}
	
}
?>