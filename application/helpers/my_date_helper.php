<?php
//the name of the file is indicated to the extend of the native date helper
#############################################################################################################################
//date format
///*
		function date_my($date)
			{
				return mdate("%D, %j %M %Y %g:%i %a", mysql_to_unix($date));
			}

		function mssqldate()
			{
				return mdate('%Y-%m-%d %H:%i:%s', now());
			}
//*/
#############################################################################################################################

?>