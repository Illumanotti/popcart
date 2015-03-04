$(function(){
	$('#registerForm').ajaxForm({
		beforeSend:function(){
			$(".progress").show();
		},
		uploadProgress:function(event,position,total,percentComplete){
			$(".progress-bar").width(percentComplete+'%');
			$(".sr-only").html(percentComplete+'%');
		},
		success:function(data){
			$(".progress").hide();
			
			
		},
		complete:function(response){
			if(response.responseText=="1"){
			$(".progress").hide();
			$("#registerName").val("");
			$("#registerPw").val("");
			$("#registerConfirm").val("");
			$("#alias").val("");
			$("#errorMsgBox").hide();
			$("#successMsgBox").show();
			$("#successMsgBox").empty();
			$("#successMsgBox").append("You have successfully created the account!");
			setTimeout(function(){ 
			$("#successMsgBox").hide();
			$("#registerModal").modal('hide');
			}, 4000);
			}else{
				$("#errorMsgBox").show();
				$("#errorMsgBox").empty();
				$("#errorMsgBox").append(response.responseText);
				setTimeout(function(){ 
					$("#errorMsgBox").hide();
				}, 4000);
			}

		}
	});
	
	$('#loginForm').ajaxForm({
		beforeSend:function(){
			$('.spinner-logo').fadeIn();
		},
		success:function(){
			$('.spinner-logo').fadeOut();
		},
		complete:function(response){
			if(response.responseText=="1"){
				window.location.replace('home.php');
			}else{
				$("#errorLogin").show();
				$("#errorLogin").empty();
				$("#errorLogin").append(response.responseText);
				setTimeout(function(){ 
					$("#errorLogin").hide();
				}, 4000);
			}
		}
	});
	
});