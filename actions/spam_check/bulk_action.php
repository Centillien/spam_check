<?php
/**
 * Dispatches a bulk action to real action.
 *
 */

$action_type = get_input('action_type');
$valid_actions = array('delete');

if (!in_array($action_type, $valid_actions)) {
	forward(REFERRER);
}

$action_name = "spam_check/$action_type";

action($action_name);
