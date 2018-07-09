<?php

/**
 * CreateTables class used to create tables.
 *
 */

class CreateTables
{

	/**
	 * Create tables.
	 *
	 */

	function createNewTables()
	{

		if ( ! function_exists( 'createNewTables' ) ){

			// Create table 'users'.

			$createTableUsers = 'CREATE table IF NOT EXISTS users
								(id int not null auto_increment primary key,
								login varchar(50) not null,
								pass varchar(255) not null)
								default charset="utf8"';

			// Create table 'profiles'.

			$createTableProfiles = 'CREATE table IF NOT EXISTS profiles
								(id int not null auto_increment primary key,
								name varchar(50) not null,
								surname varchar(50) not null,
								email varchar(50) not null,
								description varchar(500) not null,
								user_id int not null)
								default charset="utf8"';

			$databaseQueries = array(
									$createTableUsers,
									$createTableProfiles
									);

			foreach ( $databaseQueries as $query ) {
				mysql_query( $query );
			}

			$error = mysql_errno();
			if( $error ){
				echo "Error: ".$err."<br/>";
			}

		}

	}

}

?>
