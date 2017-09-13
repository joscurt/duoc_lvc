function loadImage(imagen){
	var img = new Image();
	var img_xml = $.parseXML(imagen);
	img.src = $(img_xml).find('img').attr('src');
	return img;
}
function notifyUser(message,type) {
    $.growl({
        message: message
    },{
        type: type,
        allow_dismiss: true,
        label: 'Cancel',
        className: 'btn-xs btn-danger',
        placement: {
            from: 'top',
            align: 'right'
        },
        delay: 10000,
        animate: {
                enter: 'animated bounceIn',
                exit: 'animated bounceOut'
        },
        offset: {
            x: 40,
            y: 85
        }
    });
}