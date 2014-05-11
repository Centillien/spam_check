<?php
/**
 * Admin area to view and delete spam users.
 *
 */
include_once(elgg_get_plugins_path() . "spam_check/lib/stopforumspam.php");
$sfs = new StopForumSpam();

if(!checkdnsrr('www.stopforumspam.com','A')) {
    echo elgg_echo('spam_check:dns_error');
	return;
}

$spam_check_input = elgg_get_plugin_setting("spam_check_input","spam_check");

$limit = get_input('limit', $spam_check_input);
$offset = get_input('offset', 0);

$options = array(
	'type' => 'user',
	'limit' => $limit,
	'offset' => $offset,
	'count' => TRUE,
);




$count = elgg_get_entities($options);

if (!$count) {
	access_show_hidden_entities($hidden_entities);
	elgg_set_ignore_access($ia);

	echo autop(elgg_echo('admin:users:nospammer'));
	return TRUE;
}

$options['count']  = FALSE;

$users = elgg_get_entities($options);


// setup pagination
$pagination = elgg_view('navigation/pagination',array(
	'base_url' => 'admin/users/spammer',
	'offset' => $offset,
	'count' => $count,
	'limit' => $limit,
));

$bulk_actions_checkbox = '<label><input type="checkbox" id="spam_check-checkall" />'
	. elgg_echo('spam_check:check_all') . '</label>';


$delete = elgg_view('output/url', array(
	'href' => 'action/spam_check/delete_all/',
	'text' => '<h3>' . elgg_echo('admin:users:delete') . '</h3>',
	'title' => elgg_echo('admin:users:confirm_delete_checked'),
	'class' => 'spam_check-submit',
	'is_action' => true,
	'is_trusted' => true,
));

$bulk_actions = <<<___END
	<ul class="elgg-menu elgg-menu-general elgg-menu-hz float-alt">
		<li>$delete</li>
	</ul>

	$bulk_actions_checkbox
___END;


if (is_array($users) && count($users) > 0) {
	$html = '<ul class="elgg-list elgg-list-distinct">';
	foreach ($users as $user) {
		$email = $user->email;
		$ip_address = $user->ip_address;
        	$args = array('email' => $email, 'ip' => $ip_address, 'username' => $user->name);
			$spamcheck = $sfs->is_spammer( $args );
        	if ($spamcheck){
			$html .= "<li id=\"unvalidated-user-{$user->guid}\" class=\"elgg-item spam_check-unvalidated-user-item\">";
			$html .= elgg_view('spam_check/spammer', array('user' => $user)) . 'With IP address: ' . $ip_address;
			$html .= '</li>';
			}
	}
	$html .= '</ul>';
}

echo <<<___END
<div class="elgg-module elgg-module-inline spammer-module">
	<div class="elgg-head">
		$bulk_actions
	</div>
	<div class="elgg-body">
		$html
	</div>
</div>
___END;

echo $pagination;
