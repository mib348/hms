<?php 
	include '../../../includes/header.php';
	GenerateLog("User accessed OPD Dashboard", ucwords($strModule));
?>

        <div class="content-heading">
            OPD
        </div>
        
	<div class="row">
		<div class="col-xs-12">
			<div class=" panel panel-default">
				<div class="panel-body">
					<form id="insertion_form" class="form form-horizontal" novalidate action="../../backend/opd/operations.php">
						Patient Searching
						<?php include '../formfiles/patient_search.php';?>
						<div class="form-group">
							<div class="col-xs-12 col-sm-2">
								<label>Medical Department</label> 
								<?php TableComboMsSql("MedicalDepartments", "Name", "MedicalDeptId", " IsActive = 1 order by Name asc", "nMedDeptId", "", "", "--- Select ---", "", "form-control required searchable", "required");?>
							</div>
							<div class="col-xs-12 col-sm-2">
								<label>Consultant</label> 
								<?php TableComboMsSql("Consultants", "Name", "ConsultantId", " IsActive = 1 order by Name asc", "nConsultantId", "", "", "--- Select ---", "", "form-control required searchable", "required");?>
							</div>
							<div class="col-xs-12 col-sm-2">
								<label>Company</label> 
								<?php TableComboMsSql("Companies", "Name", "CompanyId", " IsActive = 1 order by Name asc", "nCompanyId", "", "", "--- Select ---", "", "form-control required searchable", "required");?>
							</div>
						</div>
						<div class="clear clearfix"></div>
	    				<br>
	    				<div class="btn-group" >
	    					<button type="submit" class="btn btn-success submit_btn">
	    						Submit
	    					</button>
	    					<button type="reset" class="btn btn-warning reset_btn">
	    						Reset
	    					</button>
	    				</div>
					</form>
				</div>
			</div>
		</div>
<script>
	$("#strPatientMRNum").focus();
	$(function(){
		$('.searchable').select2({
		    theme: "bootstrap"
		});

	  $('#insertion_form').parsley().on('field:validated', function() {
		  if($("#insertion_form .select2").parent().find(".parsley-errors-list").length){
			  $("#insertion_form .select2").parent().find(".parsley-errors-list").remove();
			  $("#insertion_form .select2").parent().append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">This value is required.</li></ul>');
		  }
	  }).on('form:submit', function() {
		    $(".submit_btn").attr("disabled", true);
		    
			if($("#nPaymentHeadId").val() != "")
				var strAction = "Edit";
			else
				var strAction = "Add";
	    
	      $.ajax({
	        type: 'POST',
	        url: "../../backend/opd/operations.php",
	        data: $('#insertion_form').serialize() + "&" + $("#param_form").serialize() + "&strAction=" + strAction,
	        success: function(data)
	        { 
	        	location.reload();
	        }
	      });
	      
	      $("#strPatientMRNum").focus();
    	return false;
	  });
		
// 		  $('#opd_form').find('input,select,textarea').not('[type=submit]').jqBootstrapValidation({
// 		    submitSuccess: function ($form, event) {
// 		    	$(".submit_btn").attr("disabled", true);
// 					$.ajax({
// 						type: 'POST',
// 						url: $form.attr('action'),
// 						data: $form.serialize() + "&" + $("#param_form").serialize(),
// 						success: function(data)
// 						{
// 							location.reload();
// 						}
// 					});

// 		      // will not trigger the default submission in favor of the ajax function
// 		      event.preventDefault();
// 		    }
// 		  });
	});
</script>
<?php include '../../../includes/footer.php';?>
