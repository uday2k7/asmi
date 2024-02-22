$(document).ready(function(){  
	
	



    $image_crop1 = $('#upload-image1').croppie({
			enableExif: true,
			viewport: {
				width: 120,
				height: 160,
				type: 'square'
			},
			boundary: {
				width: 130,
				height: 170
			}
		});
		$('#images1').on('change', function () {
			$(':input[type="submit"]').prop('disabled', true); 
			var reader = new FileReader();
			reader.onload = function (e) {
				$image_crop1.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});			
			}
			reader.readAsDataURL(this.files[0]);
		});
		$('#cropped_image1').on('click', function (ev) {
			$image_crop1.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				$.ajax({
					url: "../crop-image",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"image":response
					},
					success: function (data) {
						html1 = '<img src="' + response + '" />';
						$("#upload-image-view1").html(html1);

						document.getElementById("campaign_image").value=data.img_name;
						$(':input[type="submit"]').prop('disabled', false);
					}
				});
			});
		});	



		$image_crop2 = $('#upload-image2').croppie({
			enableExif: true,
			viewport: {
				width: 120,
				height: 160,
				type: 'square'
			},
			boundary: {
				width: 130,
				height: 170
			}
		});
		$('#images2').on('change', function () {
			$(':input[type="submit"]').prop('disabled', true); 
			var reader = new FileReader();
			reader.onload = function (e) {
				$image_crop2.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});			
			}
			reader.readAsDataURL(this.files[0]);
		});
		$('#cropped_image2').on('click', function (ev) {
			$image_crop2.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				$.ajax({
					url: "../crop-image2",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"image":response
					},
					success: function (data) {
						html2 = '<img src="' + response + '" />';
						$("#upload-image-view2").html(html2);
						document.getElementById("campaign_image2").value=data.img_name;
						$(':input[type="submit"]').prop('disabled', false);
					}
				});
			});
		});	

		$image_crop3 = $('#upload-image3').croppie({
			enableExif: true,
			viewport: {
				width: 120,
				height: 160,
				type: 'square'
			},
			boundary: {
				width: 130,
				height: 170
			}
		});
		$('#images3').on('change', function () { 
			$(':input[type="submit"]').prop('disabled', true); 
			var reader = new FileReader();
			reader.onload = function (e) {
				$image_crop3.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});			
			}
			reader.readAsDataURL(this.files[0]);
		});
		$('#cropped_image3').on('click', function (ev) {
			$image_crop3.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				$.ajax({
					url: "../crop-image3",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"image":response
					},
					success: function (data) {
						html3 = '<img src="' + response + '" />';
						$("#upload-image-view3").html(html3);
						document.getElementById("campaign_image3").value=data.img_name;
						$(':input[type="submit"]').prop('disabled', false);
					}
				});
			});
		});	

		$image_crop4 = $('#upload-image4').croppie({
			enableExif: true,
			viewport: {
				width: 120,
				height: 160,
				type: 'square'
			},
			boundary: {
				width: 130,
				height: 170
			}
		});
		$('#images4').on('change', function () { 
			$(':input[type="submit"]').prop('disabled', true); 
			var reader = new FileReader();
			reader.onload = function (e) {
				$image_crop4.croppie('bind', {
					url: e.target.result
				}).then(function(){
					console.log('jQuery bind complete');
				});			
			}
			reader.readAsDataURL(this.files[0]);
		});
		$('#cropped_image4').on('click', function (ev) {
			$image_crop4.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				$.ajax({
					url: "../crop-image4",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"image":response
					},
					success: function (data) {
						html4 = '<img src="' + response + '" />';
						$("#upload-image-view4").html(html4);
						document.getElementById("campaign_image4").value=data.img_name;
						$(':input[type="submit"]').prop('disabled', false);
					}
				});
			});
		});	


    
});