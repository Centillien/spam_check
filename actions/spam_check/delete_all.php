<?php
/**
 * Delete a user or users by guid
 *
 * @package Elgg.Core.Plugin
 * @subpackage spam_check
 */

$user_guids = get_input('user_guids');
$error = FALSE;

if (!$user_guids) {
	register_error(elgg_echo('spam_check:errors:unknown_users'));
	forward(REFERRER);
}

foreach ($user_guids as $guid) {
	$user = get_entity($guid);
	if (!$user instanceof ElggUser) {
		$error = TRUE;
		continue;
	}

	if (!$user->delete()) {
		$error = TRUE;
		continue;
	}

}

if (count($user_guids) == 1) {
	$message_txt = elgg_echo('spam_check:messages:deleted_user');
	$error_txt = elgg_echo('spam_check:errors:could_not_delete_user');
} else {
	$message_txt = elgg_echo('spam_check:messages:deleted_users');
	$error_txt = elgg_echo('spam_check:errors:could_not_delete_users');
}

if ($error) {
	register_error($error_txt);
} else {
	system_message($message_txt);
}

forward(REFERRER);
