$(document).ready(function(){  
	
	



    $image_crop1 = $('#upload-bg').croppie({
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
		$('#image-bg').on('change', function () { 
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
		$('.upload-bg').on('click', function (ev) {
			$image_crop1.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				$.ajax({
					url: "crop-bg",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"image":response
					},
					success: function (data) {
						html_bg = '<img src="' + img + '" />';
			            $("#preview-crop-bg").html(html_bg);
			           // console.log("data",data.img_name);
			            document.getElementById("bg_image").value=data.img_name;
					}
				});
			});
		});	



		$image_crop2 = $('#image-logo').croppie({
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
		$('#image-logo').on('change', function () { 
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
		$('.upload-image').on('click', function (ev) {
			$image_crop2.croppie('result', {
				type: 'canvas',
				size: 'viewport'
			}).then(function (response) {
				$.ajax({
					url: "crop-logo",
					type: "POST",
					data: {
						"_token": "{{ csrf_token() }}",
						"image":response
					},
					success: function (data) {
						html = '<img src="' + img + '" />';
            			$("#preview-crop-logo").html(html);
						document.getElementById("logo_image").value=data.img_name;
					}
				});
			});
		});	

		


    
});