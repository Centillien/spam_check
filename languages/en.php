<?php

	$english = array(
		
		//Admin menu
		'admin:users:spammer' => "Check for Spammers",
		'admin:users:nospammer' => "No Spammers",
		'admin:users:delete' => "Delete Spammers",
		'admin:users:confirm_delete_checked' => "Confirm Delete",
		'spam_check:admin:ip_date_created' => 'Created %s',
		'spam_check:admin:delete_ip' => 'Delete',
		'spam_check:admin:confirm_delete_ip' => 'Delete %s?',
		
		'spam_check:messages:deleted_users' => 'Spammers have been deleted.',
		'spam_check:errors:unknown_ips' => 'IP not found.',
		'spam_check:admin:no_ips' => 'The IP list is empty.',
		
		'spam_check:admin:unvalidated' => 'Unvalidated',
		'spam_check:admin:user_created' => 'Registered %s',
		'spam_check:admin:delete' => 'Delete',
		'spam_check:confirm_delete' => 'Delete %s?',
		'spam_check:confirm_delete_checked' => 'Delete checked users?',
		'spam_check:check_all' => 'All',

		'spam_check:errors:unknown_users' => 'Unknown users',
		'spam_check:errors:could_not_delete_users' => 'Could not delete all checked users.',
		'spam_check:messages:deleted_users' => 'All checked users deleted.',
		'spam_check:spam_check_input' => 'How many users do you want to check per page ?', 
		'spam_check:spam_check_remark' => '<strong>Remark :</strong> More users takes more time to process and you risk being temporarily banned by <a href="http://www.stopformspam.com">SFS</a> if you check too many users in one day.', 
		'spam_check:dns_error' => 'This machine cannot contact www.stopforumspam.com and the plugin will not work. Check your <font color="red"><a href="https://www.centillien.com/dns">DNS settings</font></a> first',

			
	);
	add_translation("en",$english);

?>
