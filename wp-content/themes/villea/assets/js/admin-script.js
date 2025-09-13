/**
*
* -----------------------------------------------------------------------------
*
* Template JS for Admin*
* -----------------------------------------------------------------------------
*
**/

(function ($) {

	"use strict";
	$('.radio-select label').on('click', function (event) {
		$('.radio-select label').removeClass('active');
		$(this).addClass('active');
	});

	$('#meta-image-button').on('click', function () {
		var send_attachment_bkp = wp.media.editor.send.attachment;
		wp.media.editor.send.attachment = function (props, attachment) {
			$('#meta-image').val(attachment.url);
			$('#meta-image-preview').attr('src', attachment.url);
			wp.media.editor.send.attachment = send_attachment_bkp;
		}
		wp.media.editor.open();
		return false;
	});

	$(".meta-img-wrap i").on('click', function () {
		$('.meta-img-wrap').hide();
		$("#meta-image").val('');
	});




	// 	/* Try to display all post format in my project  */

	jQuery(document).ready(function ($) {
		// Initialize immediately and also after CMB2 loads
		cmb2_conditional_logic();

		// Handle CMB2's AJAX loading
		$(document).on('cmb2_load_fields', function () {
			setTimeout(cmb2_conditional_logic, 50);
		});

		// Run when any relevant field changes
		$('.cmb2-wrap').on('change', '.cmb2_select, .cmb2-radio-input input', function () {
			setTimeout(cmb2_conditional_logic, 10);
		});
	});

	function cmb2_conditional_logic() {
		jQuery('[data-conditional-id]').each(function () {
			var $this = jQuery(this);
			var parent_id = $this.data('conditional-id');
			var parent_val = $this.data('conditional-value');
			var parent_field = jQuery('#' + parent_id);

			if (!parent_field.length) return;

			// Get current value - works for both selects and radios
			var parent_value;
			if (parent_field.is('select')) {
				parent_value = parent_field.val();
			} else if (parent_field.is(':radio')) {
				parent_value = parent_field.filter(':checked').val();
			} else {
				parent_value = parent_field.val();
			}

			// Support for multiple values (comma-separated)
			var expected_values = parent_val.toString().split(',');
			var is_match = expected_values.includes(parent_value);

			// Get the row to show/hide
			var $row = $this.closest('.cmb-row');

			// Handle display
			if (is_match) {
				$row.show().removeClass('cmb2-conditional-hidden');
			} else {
				$row.hide().addClass('cmb2-conditional-hidden');
			}
		});

		// Trigger any nested conditionals
		jQuery('.cmb2-conditional-hidden [data-conditional-id]').each(function () {
			jQuery(this).trigger('change');
		});
	}


	// post format 
	function toggleFormatMetaboxes() {
		const selectedFormat = $("#post-formats-select input[name='post_format']:checked").val() || 'standard';

		// Hide all format metaboxes
		$('.format-metabox').closest('.cmb2-postbox').hide();

		// Show only the selected format's metabox
		$('.format-' + selectedFormat).closest('.cmb2-postbox').show();
	}
	// Initial run on load
	toggleFormatMetaboxes();

	// Re-run on post format change
	$('#post-formats-select input[name="post_format"]').on('change', function () {
		toggleFormatMetaboxes();
	});



})(jQuery);
