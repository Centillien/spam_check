
elgg.provide('elgg.spam_check');

elgg.spam_check.init = function() {
	$('#spam_check-checkall').click(function() {
		var checked = $(this).attr('checked') == 'checked';
		$('#spam_check-form .elgg-body').find('input[type=checkbox]').attr('checked', checked);
	});

	$('.spam_check-submit').click(function(event) {
		var $form = $('#spam_check-form');
		event.preventDefault();

		// check if there are selected users
		if ($('#spam_check-form .elgg-body').find('input[type=checkbox]:checked').length < 1) {
			return false;
		}

		// confirmation
		if (!confirm($(this).attr('title'))) {
			return false;
		}

		$form.attr('action', $(this).attr('href')).submit();
	});
};

elgg.register_hook_handler('init', 'system', elgg.spam_check.init);
