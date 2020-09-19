<hr>
<footer class="container">
    <p class="float-right"><a href="#">
    	<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
		  <path fill-rule="evenodd" d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
		  <path fill-rule="evenodd" d="M8 12a.5.5 0 0 0 .5-.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 .5.5z"/>
		</svg>
	</a></p>
    <p>&copy; 2020 <a href="https://www.wejapa.com/">Wejapa Internships</a></p>
</footer>

<!-- Optional JavaScript -->
<script>
	CKEDITOR.replace('content');
	
	function readURL(input) {
	  if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function(e) {
		  $('#show_image').attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]); // convert to base64 string
	  }
	}

	$("#post_image").change(function() {
	  readURL(this);
	});
</script>

<script>
// confirm record deletion
function delete_post(id){
	
	// document.getElementById('post_id').value = id;
	 //$('#confirmAction').modal('show');
	
	 var answer = confirm('Are you sure you want to delete this post? This action cannot be undone and will be unable to recover.');
	if (answer){
		// if user clicked ok, 
		// pass the id to delete.php and execute the delete query
		window.location = 'delete-post.php?id=' + id;
	}  
}


function delete_category(id){
	
	// document.getElementById('post_id').value = id;
	// $('#confirmAction').modal('show');
	
	 var answer = confirm('Are you sure you want to delete this post? This action cannot be undone and will be unable to recover.');
	if (answer){
		// if user clicked ok, 
		// pass the id to delete.php and execute the delete query
		window.location = 'delete-category.php?id=' + id;
	} 
}


</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<noscript>Please enable JavaScript</noscript>