var pathArray = window.location.pathname.split( '/' ); var urlPath = location.origin+'/'+pathArray[1]+'/'+pathArray[2];
var today = new Date(); var dd = today.getDate(); var mm = today.getMonth()+1; //January is 0! 
var yyyy = today.getFullYear();

var HOME = {
	onReady: function(){

		$("#loginForm").on("submit", function(e){
			e.preventDefault();
			var email = $("#email").val(), password = $("#password").val(), remember = $("input[type='checkbox']").val();
			HOME.sendAjax(e, {email: email, password: password, remember: remember});
		});
		//$("#country_code_phn").select2();
	},

	sendAjax: function(e, data){
		$.ajax({
			url: location.href,
			type: "POST",
			data: data,
			success:function(res){
				if(res !== 'true'){
					var check = res;
					if(check.email){
                        $('#errors-email-block').addClass('has-error');
                        $("#errors-email strong").html(check.email);
                    }

                    if(check.password){
                        $('#errors-password-block').addClass('has-error');
                        $("#errors-password strong").html(check.password);
                    }

                    $("#login-status-message p").text('There was something wrong.');
                    $("#login-status").css({visibility:'visible',transition:'visibility 0.1s ease-in'});

				}else{
					$('#errors-email-block').removeClass('has-error');
                    $("#errors-email strong").html();
                    $('#errors-password-block').removeClass('has-error');
                    $("#errors-password strong").html();
					$("#login-status-message p").text('You have been successfully login');
                    $("#login-status").removeClass('error-notice').addClass('success-notice').css({visibility:'visible',transition:'visibility 0.1s ease-in'});

					setTimeout(function(){	
	                	window.location.href = urlPath+'/dashboard';
	                }, 2000);
				}
			},
			error:function(res){
				var errors = res.responseJSON;

        		if(errors.email){
                    $('#errors-email-block').addClass('has-error');
                    $("#errors-email strong").html(errors.email[0]);
                }

                if(errors.password){
                    $('#errors-password-block').addClass('has-error');
                    $("#errors-password strong").html(errors.password[0]);
                }

                $("#login-status-message p").text('There was something wrong.');
                $("#login-status").css({visibility:'visible',transition:'visibility 0.1s ease-in'});
			}
		});
	}
};

var REG = {
	onReady: function(){

		$("#reg_location_state").select2({
			placeholder: "Select a state",
			allowClear: true
		});
		$("#reg_school_name").select2({placeholder:"Select a school",allowClear:true});
		$("#reg_institute_name").select2({placeholder:"Select an Institute",allowClear:true});

		$("#submit1").on('click', function(e){
			var candi_dob_d = $("#candi_dob_d").val(), candi_dob_m = $("#candi_dob_m").val(), candi_dob_y = $("#candi_dob_y").val();
			console.log(candi_dob_d+' - '+candi_dob_m+' - '+ candi_dob_y);
			if(candi_dob_d > 4 && candi_dob_m == 12 && candi_dob_y == (yyyy - 18)){
				$("#title-label").text('Toddler Detected!');
				$("p.reason").text('Minimum 18 years.');
				$("#msgPopUp").modal('show');
				e.preventDefault();
			}
		});

		$("#dde_others").on("click", function(){
			var val = $(this).is(':checked');
			if(val){
				$("#others-dde").removeClass('hidden');
			}else{
				$("#others-dde").addClass('hidden');
			}
		});

		$("#heard_tpo").on('change', function(){
			$(".tpo-heard-mayam").hide(100);
			var val = $(this).val(), insertedVal = new Array();
			if(val != 7){
				$(".tpo-"+val).show(200);
			}else{
				$(".tpo-heard-mayam").hide(100);
			}

		});

		$("#not_from_india").on('click', function(e){
			var val = $(this).is(':checked');
			if(val){
				$("#candi_city, #candi_state").hide(200);
			}else{
				$("#candi_city, #candi_state").show(200);
			}
		});

		$("#other_school").on("click", function(){
			var check = $(this).is(':checked');
			if(check){
				$(".other-school-section").show(200);
				$("#school_name, #reg_location_city, #school_type, #school_board, #reg_school_name, #reg_school_fee").attr('disabled','disabled');
				$(this).val('on');
			}else{
				$(".other-school-section").hide(200);
				$("#school_name, #reg_location_city, #school_type, #school_board, #reg_school_name, #reg_school_fee").removeAttr('disabled');
				$(this).val('off');
			}
		});

		$("#other_institute").on("click", function(){
			var check = $(this).is(':checked');
			if(check){
				$(".other-school-section").show(200);
				$("#reg_institute_name").attr('disabled','disabled');
				$(this).val('on');
			}else{
				$(".other-school-section").hide(200);
				$("#reg_institute_name").removeAttr('disabled');
				$(this).val('off');
			}
		});

		$("#reg2_course").on("change", function(){
			var val = $(this).val();
			$("#other_course").hide(100);
			if(val == 6){
				$("#other_course").show(100);
			}
		});
	},
}

if(!!pathArray[3]){
	if(pathArray[3] == 'registration'){
		$(document).ready(REG.onReady);
	}else if(pathArray[3] == 'login'){
		$(document).ready(HOME.onReady);
	}
	
}else{
	$(document).ready(HOME.onReady);
}
