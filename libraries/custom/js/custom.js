jQuery(function($)
{
	$(document).on('click', ".reset_btn", function(){
		$('#insertion_form').find('input,select,textarea').val('');
        $('#insertion_form').find('.searchable').val('').trigger('change');
    	$("#insertion_form input[type=checkbox]").attr("checked", false);
    	$("#insertion_form input[type=checkbox]").prop("checked", false);
    	$("#insertion_form .isactive_cb").attr("checked", true);
    	$("#insertion_form .isactive_cb").prop("checked", true);
	});
	
	$(document).on('click', "#logout", function()
    {
        $.ajax({
            url: "../../backend/login/operations.php?strOper=logout",
            type: "post",
            dataType: "json",
            success: function(data){
	            if(data['status'] == 'true'){
	                window.location.href = "../login/index.php";
	            }
            }
        }); 
    });
    
});

function showConfirmDialog(s)
{
	$("#response_popup_body").html(s);
	$("#response_popup").modal("show");
}	


function readURL(input, previewId)
{
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) 
        {
            $('#'+previewId).attr('src', e.target.result);
            var fileName = input.files[0].name;
            var lastChar = previewId.substr(previewId.length - 1); // => "1"
        }
        reader.readAsDataURL(input.files[0]);
    }
}