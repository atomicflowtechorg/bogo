jQuery(function($){
				
		   $('.datepicker').datepicker();
		   
		   $('.signupButton').click(function(){
		   		var toLoad = $(this).attr('href')+'#content';

		   });


		   $('#container').masonry({
			  itemSelector: '.item',
			  columnWidth: 240,
			  animationOptions: {
			    duration: 400
			  }
			});

		    });