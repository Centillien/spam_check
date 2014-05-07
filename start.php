<?php
/**
 * Spam Checkker
 * This plugin checks your users database for spammers. 
 * Author Gerard Kanter
 * copyright Centillien 2013
 * https://www.centillien.com/
 * 
 * @package spam_check
 */

	elgg_register_event_handler('init', 'system', 'spam_check_init');
	$action_path = elgg_get_plugins_path() . "spam_check/actions/spam_check";

        //Admin menu for spam check GK
	if(elgg_in_context("admin") && elgg_is_admin_logged_in()){

        	elgg_extend_view('css/admin', 'spam_check/css');
        	elgg_extend_view('js/elgg', 'spam_check/js');

        	elgg_register_admin_menu_item('administer', 'spammer', 'users');
	}

        //Register actions
	elgg_register_action('spam_check/bulk_action', "$action_path/bulk_action.php", 'admin');
	elgg_register_action('spam_check/delete_all', "$action_path/delete_all.php", 'admin');
	



