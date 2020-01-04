<?php
	
	ob_start();

    header ('Content-type: text/html; charset=utf-8');

    session_start();
      
    //database credentials
    define('DBHOST','localhost');
    define('DBUSER','root');
    define('DBPASS','');
    define('DBNAME','assignment');
    
    //application address
    define('DIR','http://localhost/trans/');

    define('SITEEMAIL','noreply@domain.com');

    define('SITETITLE','Translation Website');
    
    try
    {
        //create PDO connection
        $db = new PDO("mysql:host=".DBHOST.";charset=utf8;dbname=".DBNAME, DBUSER, DBPASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Suggested to comment on production websites
        $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);       
    }
    catch(PDOException $e)
    {
        //show error
        echo '<p class="bg-danger">'.$e->getMessage().'</p>';
        exit;
    }
    
   
    /**
     *  Classes
     * 
    **/
     
    spl_autoload_register(function ($class) 
    {
    
		$class = strtolower($class);

		//if call from within assets adjust the path
		$classpath = 'classes/'.$class . '.php';

		if ( file_exists($classpath))
		{
			require_once $classpath;
		}  

		//if call from within another subfolder adjust the path
		$classpath = '../classes/'.$class . '.php';

		if ( file_exists($classpath))
		{
			require_once $classpath;
		}

		//if call from within another sub-subfolder adjust the path
		$classpath = '../../classes/'.$class . '.php';

		if ( file_exists($classpath)) 
		{
			require_once $classpath;
		}     
        
    });

    /**
     *  Classe Objects
     * 
    **/

    $user  = new User($db); 