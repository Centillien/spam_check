<?php
/**
 * List of spamming users
 */
echo elgg_view_form('spam_check/bulk_action', array(
	'id' => 'spam_check-form',
	'action' => 'action/spam_check/bulk_action'
));
