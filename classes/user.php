<?php

include('password.php');

class User extends Password
{

    public $_db;

    function __construct($db)
    {
    	parent::__construct();

    	$this->_db = $db;
    }

	private function get_user_hash($username)
	{
		try
		{
			$stmt = $this->_db->prepare('SELECT password, username, memberID FROM members WHERE username = :username ');
			$stmt->execute(array('username' => $username));

			return $stmt->fetch();

		}
		catch(PDOException $e)
        {
		    echo '<p class="bg-danger">'.$e->getMessage().'</p>';
		}
	}

	public function login($username, $password)
	{
		$row = $this->get_user_hash($username);

		if($this->password_verify($password, $row['password']) == 1)
        {
		    $_SESSION['loggedin'] = true;
		    $_SESSION['username'] = $row['username'];
		    $_SESSION['memberID'] = $row['memberID'];

		    return true;
		}
	}

    public function redirect($url)
    {
        header('location: '.$url.'');
    }
    
    public function redirect_back()
    {
        header('location: '.$_SERVER['HTTP_REFERER'].'');
    }

    public function is_logged_in()
    {
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
        {
            return true;
        }
    }

    public function generateUuid()
    {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';       
        //generate 4 digit alphanumeric code
        return  strtoupper(substr(str_shuffle($permitted_chars), 0, 4));
    }

    public function logout()
    {
        session_destroy();
    }
    
}








