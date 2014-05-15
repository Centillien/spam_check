<?php
/**
 * List of uers without a valid email address
 */
echo elgg_view_form('spam_check/bulk_action_email', array(
	'id' => 'spam_check-form',
	'action' => 'action/spam_check/bulk_action'
));
