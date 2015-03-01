//transfer data via ajax to drop.php
$(function(){
	var obj=$('#drop');
	obj.on('dragover',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css('border',"2px solid #16a085");
	});
	
	obj.on('drop',function(e){
		e.stopPropagation();
		e.preventDefault();
		$(this).css('border',"2px dotted #bdc3c7");
		
		var files = e.originalEvent.dataTransfer.files;
		var file = files[0];
		upload(file);
	});
	
	function upload(file){
		xhr=new XMLHttpRequest();
		
		if(xhr.upload && check(file.type)){
		//initiate request (method,url,async?)
		xhr.open('post','../scripts/drop.php',true);
		
		//set headers
		xhr.setRequestHeader('Content-Type',"multipart/form-data");
		xhr.setRequestHeader('X-File-Name',file.fileName);
		xhr.setRequestHeader('X-File-Size',file.fileSize);
		xhr.setRequestHeader('X-File-Type',file.fileType);
		
		//send the file
		xhr.send(file);
		
		//listen on the progress of upload
		xhr.upload.addEventListener("progress",function(e){
			var progress=(e.loaded/e.total)*100;
			$('.progress').show();
			$('.progress-bar').css('width',progress+"%");
		},false);
		
		//upload complete check
		xhr.onreadystatechange = function (e){
			if(xhr.readyState==4){
				if(xhr.status==200){
					$('.progress').hide();
					console.log(xhr.responseText);
					$("#successAlert").show().delay(1000).fadeOut();
				}
			}
		}
		}else{
			alert("Please upload only images");
		}
		
	}
	
	function check(image){
		switch(image){
			case 'image/jpeg':
			return 1;
			case 'image/png':
			return 1;
			case 'image/gif':
			return 1;
			default:
			return 0;
		}
	}
});