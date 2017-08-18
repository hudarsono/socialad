require('./bootstrap');


$(document).ready(function() {
    $('#keyword_stats').DataTable( {
	  "scrollX": true,
	  "pageLength": 50,
	  "colReorder": true
	} );
} );
