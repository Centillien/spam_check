<?php
/**
 * Plugin settings
 */
$input_options = array(
	"40" => elgg_echo("40"),
	"100" => elgg_echo("100"),
	"250" => elgg_echo("250"),
	"500" => elgg_echo("500"),
);

 if(!checkdnsrr('www.stopforumspam.com','A')) {
    echo elgg_echo('spam_check:dns_error');
	echo '<br><br>';
}


$spam_check_input = $vars['entity']->spam_check_input;

echo elgg_echo('spam_check:spam_check_input');
echo '<br><br>';
echo elgg_view("input/dropdown", array("name" => "params[spam_check_input]", "value" => $spam_check_input, "options_values" => $input_options));
echo '<br><br>';
echo elgg_echo('spam_check:spam_check_remark');
echo '<br>';
