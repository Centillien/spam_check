<?php
/**
 * Admin area to view and delete spam users.
 *
 */
 if(!elgg_is_active_plugin("validate_email")){
	include_once(elgg_get_plugins_path() . "spam_check/lib/class.check_email.php");
}

$vmail = new verifyEmail();

if(!checkdnsrr('www.centillien.com','A')) {
    echo elgg_echo('spam_check:dns_error');
	return;
}

$spam_check_input = elgg_get_plugin_setting("spam_check_input","spam_check");

if(!$spam_check_input) {
        $spam_check_input = '40';
}

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
	'base_url' => 'admin/users/spammers',
	'offset' => $offset,
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

if(!empty($users)){
        foreach($users as $user){
                $email = trim($user->email);
				$ip_address = $user->ip_address;
				$url = "https://www.centillien.com/services/api/rest/json?method=validate_email&email=". $email;
                $return = url_get_api_contents($url);
                $data = json_decode($return, true);
				if (!is_null($data)) {
                     $email_exists = $data['result'];
                     if ($email_exists != true) {
                         $html .= "<li id=\"unvalidated-user-{$user->guid}\" class=\"elgg-item spam_check-unvalidated-user-item\">";
                         $html .= elgg_view('spam_check/spammer', array('user' => $user)) . 'This user appears to have an invalid email addres';
                         $html .= '</li>';
					}
                }
        }
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
