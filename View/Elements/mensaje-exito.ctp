<script>
	$(document).ready(function(){
		$.growl({
			message: '<?php echo $message; ?>'
		},{
			type: 'success',
			allow_dismiss: true,
			label: 'Cancel',
			className: 'btn-xs btn-success',
			placement: {
				from: 'top',
				align: 'right'
			},
			delay: 8000,
			z_index: 1131,
			animate: {
					enter: 'animated bounceIn',
					exit: 'animated bounceOut'
			},
			offset: {
				x: 20,
				y: 85
			}
		});
	});
</script>