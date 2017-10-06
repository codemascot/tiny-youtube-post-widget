(function( $ ) {
	'use strict';

	// After document is ready
	$(function($){
		
		// Initiate select2 library for user role. 
		$('select#sodathemes_typw_user_role').select2({ 
			width: '300px', 
			dropdownCssClass: 'bigdrop',
			minimumResultsForSearch: 7
		});

		// Initiate select2 library for taxonomies.
		$('select#sodathemes_typw_post_types, select#sodathemes_typw_taxonomies').select2();

		// Enable and disable user checkbox.
		$('input[name=sodathemes_typw_user_check]').on('click', function(){
			var $this = $(this);
			var value = $this.val();
			if ( value != 1 ) {
				$('select#sodathemes_typw_user_role').attr('disabled', true);
			} else {
				$('select#sodathemes_typw_user_role').attr('disabled', false);
			}
		});


	});
	
})( jQuery );