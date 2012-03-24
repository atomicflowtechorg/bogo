jQuery(function($){
				
		   $('.datepicker').datepicker();
		   Cufon.replace('h3, h1, .karmaPoints');
		   
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