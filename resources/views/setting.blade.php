<html>
	<head>
		<meta http-equiv="cache-control" content="no-cache"/>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
		<link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="/css/setting.css">

		<script type="text/javascript" src="/js/tabs.js"></script>
	</head>
	<body>
		<div class="header">
		</div>

		<!-- Tab links -->
		<div class="tab">
			<?php
			$screens = json_decode($screen_info,true);
			foreach($screens as $screen) {
			?>
			<button 
				id="tab_<?php echo $screen['id'];?>"
				class="tablinks" 
				onclick="tabs(event, 'screen_<?php echo $screen['id'];?>')">Screen <?php echo $screen['id'];?></button>
			<?php	}	?>
		</div>


		<!-- Session Message -->

		<?php if(session('status') != null && session('status') == 200){ ?>
		<div class="alert alert-{{ session('style') }} alert-dismissible fade show" role="alert">
		  <strong>{{ session('action') }} Success!</strong> {{ session('message') }}
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<?php 	} ?>




		<!-- Tab content -->
		<?php 
		foreach($screens as $screen) {
		?>
		<div id="screen_<?php echo $screen['id'];?>" class="tabcontent">
			<h3>Screen <?php echo $screen['id'];?></h3>

			<div class="container">
  				<div class="row">
  					
  					<?php
  						$resources = json_decode($image_info,true);

  						foreach($resources as $image) {
  							if($image['screen'] == $screen['id']){ 
  					?>
					<div class="col-xl-4">
						<div class="card <?php if($image['active'] == '1') echo 'active';?>" style="width: 18rem;">

						<!-- Delete Button -->

						<form action="/setting/delete" method="POST">
							<div class="delete_button">
							{{ csrf_field() }}
							<input type="hidden" name="image_id" value="<?php echo $image['id'];?>"/>
							<button type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
							</div>
						</form>


						<img class="card-img-top" src="<?php echo Storage::url('/'.$image['path']);?>" alt="Card image cap">
						<div class="card-body">
					    	<p class="card-text"> <?php echo $image['name'];?></p>


					    	<?php 

					    	//Disable image if the image is active
					    	if($image['active'] == '1') {	?>
					    	<form action="/setting/deactivate" method="POST">
					    		{{ csrf_field() }}
					    		<input type="hidden" name="id" value="<?php echo $image['id'];?>"/>
					    		<button type="submit" class="btn btn-outline-secondary">Disable</button>
					    	</form>
					    	<?php 

					    	//Enable image if deactivated
					    	} else { 	?>
					    	<form action="/setting/activate" method="POST">
					    		{{ csrf_field() }}
					    		<input type="hidden" name="id" value="<?php echo $image['id'];?>"/>
					    		<button type="submit" class="btn btn-outline-success">Activate</button>
					    	</form>
					    	<?php } ?>
					  	</div>
					</div>
					</div>
  					<?php
  							}
  						}
  					?>

  					<!-- File Upload -->
					<div class="col-xl-4">
						<div class="card" style="width: 18rem;">
					    	<div class="card-body">
						        <h5 class="card-title">Upload new image</h5>
						        <p class="card-text">Please make sure the dimension of your new image is in the correct orientation and dimension.</p>
						        

						        <form enctype="multipart/form-data" action="{{ url('setting/upload')}}" method="post">
						   
								    <!-- <div class="custom-file">
										<input type="file" class="custom-file-input" id="file">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div> -->
									<input type="hidden" name="for_screen_id" value="<?php echo $screen['id'];?>"/>

									<div class="form-group">	
							    		<input type="text" name="image_description" class="form-control" id="exampleInputEmail1" placeholder="Description">
							    		<small id="emailHelp" class="form-text text-muted">A simple description would do!</small>
							  		</div>

									<div class="form-group">
									    <label for="imagefile">Choose image</label>
									    <input type="file" class="form-control-file" id="imagefile" name="imagefile">
									</div>
								    {{ csrf_field() }}
								    <button type="submit" class="btn btn-primary">Upload</button>
								</form>




					    	</div>
					    </div>
					</div>
  					
				</div>
			</div>
		</div>

		<?php
		}
		?>
		
	</body>
</html>