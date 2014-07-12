<?php
/**
 * Whitelist a user from spam_check
 *
 *
 */

admin_gatekeeper();


$guid = get_input('guid');
$user = get_entity($guid);

if (($user instanceof ElggUser) && ($user->canEdit())) {
	if(create_metadata($user->guid, 'spam_whitelist', true, '', 0)) {
                system_message(elgg_echo('admin:user:whitelist:yes'));
        } else {
                register_error(elgg_echo('admin:user:whitelist:no'));
        }
} else {
        register_error(elgg_echo('admin:user:whitelist:no'));
}
forward(REFERER);

