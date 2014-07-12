<?php
/**
 * Formats and list spammers.
 *
 * @subpackage SpamCheck.Administration
 */

$user = elgg_extract('user', $vars);

$checkbox = elgg_view('input/checkbox', array(
	'name' => 'user_guids[]',
	'value' => $user->guid,
	'default' => false,
));

$created = elgg_echo('spam_check:admin:user_created', array(elgg_view_friendly_time($user->time_created)));

$delete = elgg_view('output/confirmlink', array(
	'confirm' => elgg_echo('spam_check:confirm_delete', array($user->username)),
	'href' => "action/admin/user/delete?guid=$user->guid",
	'text' => elgg_echo('spam_check:admin:delete')
));

$whitelist = elgg_view('output/confirmlink', array(
	'confirm' => elgg_echo('spam_check:confirm_whitelist', array($user->username)),
	'href' => "action/spam_check/whitelist?guid=$user->guid",
	'text' => elgg_echo('spam_check:admin:whitelisted')
));


$menu = 'spam';
$block = <<<___END
	<label>$user->username: "$user->name" &lt;$user->email&gt;</label>
	<div class="spam_check-unvalidated-user-details">
		$created
	</div>
___END;

$menu = <<<__END
	<ul class="elgg-menu elgg-menu-general elgg-menu-hz float-alt">
	    <li>$whitelist</li>
		<li>$delete</li>
__END;

echo elgg_view_image_block($checkbox, $block, array('image_alt' => $menu));
