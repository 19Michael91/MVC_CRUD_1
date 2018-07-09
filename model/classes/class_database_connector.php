<?php

/**
 * ConnectToDatabase class used to connect database.
 *
 */

class ConnectToDatabase
{

	/**
	 * Connect database.
	 *
	 * @param string $host      Host name.
	 * @param string $db_user   User name.
	 * @param string $db_pass   Database password.
	 * @param string $db_name   Database name.
	 *
	 */

	function connect( $host = 'localhost', $db_user = 'root', $db_pass = '', $db_name = "client" )
	{

		if ( ! function_exists( 'connect' ) ){
			$link = mysql_connect( $host, $db_user, '' ) or die( "Could not connect to the server :(" );
			mysql_select_db( $db_name ) or die( "Could not connect to database :(" );
			mysql_query('set names "utf8"');
		}

	}

}

?>
