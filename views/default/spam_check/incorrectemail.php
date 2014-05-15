<?php
/**
 * Formats and list spam user.
 * 
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
	'text' => elgg_echo('spam_check:admin:delete_incorrect')
));
$menu = 'test';
$block = <<<___END
	<label>$user->username: "$user->name" &lt;$user->email&gt;</label>
	<div class="spam_check-unvalidated-user-details">
		$created
	</div>
___END;

$menu = <<<__END
	<ul class="elgg-menu elgg-menu-general elgg-menu-hz float-alt">
		<li>$delete</li>
	</ul>
__END;

echo elgg_view_image_block($checkbox, $block, array('image_alt' => $menu));
