jQuery(function($){
	$('.ardev_ajax_form').on('submit', function(e){
		e.preventDefault();

		var ardev_name = $('#name').val();
		$.post({
			url: ajaxurl,
			data: {
				action: 'ardev_ajax_action', 
				option1: ardev_name
			},
			success:function(data){
				console.log(data);
			},
			error:function(errorThrown){
				console.log(errorThrown);
			}
		}); 
	});

	// var data = {
	// 	action: 'ardev_front_ajax_action',
	// 	value: ardev_ajax_script.num1,
	// };
	// $.post(ardev_ajax_script.ajaxurl, data, function(val){
	// 	alert(val);
	// });
	
});