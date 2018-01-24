<html>
	<head>
		<meta http-equiv="cache-control" content="no-cache"/>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="stylesheet" type="text/css" href="/css/single-image.css">
		<script
		  src="https://code.jquery.com/jquery-3.3.1.min.js"
		  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
		  crossorigin="anonymous"></script>
		<input type="hidden" id="screen_id" value="<?php echo $screen_id;?>" />


		<script>
		var currentData = null;

		var updateImage = function(){
			//Get post destination using screen ID info
			var target = "/screen/"+document.getElementById('screen_id').value;

			$.post(target,
	        {
	          "_token": "{{ csrf_token() }}",
	        },
	        function(data,status){

	        	//If there is a change in data
	        	// if(currentData != data){
	        	// 	alert(currentData);
	        	// 	currentData = JSON.stringify(data, null);


		            if(status == 'success' && data.length == 1){
		            	var path = data[0]['path'];
		            	$('.single-image').css({
		            		'background-image':'url("/storage/'+path+'")',
		            		'background-size': 'contain',
		            		'background-repeat': 'no-repeat'
		            	});
		            }else if(status == 'success' && data.length > 1){
		            	//TODO
		            	//Append images
		     //        	var i;
		     //        	for (i = 0; i < data.length; i++) {
							// document.getElementById('gallery').innerHTML += '<img class="slide w3-animate-fading" src="/storage/'+data[i]['path']+'" style="width:100%">';
	    		// 		}
		            	
		            	
		            }else{
		            	//TODO
		            }
		        // }
	        });
		}

		updateImage();
		setInterval(updateImage, 5000);
		</script>
	</head>

	<body>
		

		<div class="single-image"></div>
		<div class="gallery" id="gallery">
		</div>
		<div class="message-board"></div>
	</body>
</html>