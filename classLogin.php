<?php

class login{

	function getLogin($post, $connect){
		$query = "SELECT * FROM login WHERE username = :username";
		$statement = $connect->prepare($query);
		$statement->bindParam(':username', $post["username"], PDO::PARAM_STR);
		$statement->execute();

		$count = $statement->rowCount();
		if($count > 0)
		{
			$result = $statement->fetchAll();
			foreach($result as $row)
			{
				if(password_verify($post["password"], $row["password"]))
				{
					$_SESSION['user_id'] = $row['user_id'];
					$_SESSION['username'] = $row['username'];
					$sub_query = "
					INSERT INTO login_details 
		     		(user_id) 
		     		VALUES ('".$row['user_id']."')
					";
					$statement = $connect->prepare($sub_query);
					$statement->execute();
					$_SESSION['login_details_id'] = $connect->lastInsertId();
					header('location:index.php');
				}
				else
				{
					$message = '<label>Wrong Password</label>';
				}
			}
		}
		else
		{
			$message = '<label>Wrong Username</labe>';
		}
	}
}

?>



