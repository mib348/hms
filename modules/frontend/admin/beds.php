<?php 
    include '../../../includes/header.php';
    GenerateLog("User accessed Beds Admin Page", ucwords($strModule));
?>
<style>
	.table th {	text-align: center;}
	.table th:hover {	cursor: pointer;}
	#filter_form label {	margin-top: 5px;}
	.table td:nth-child(5) {	width: 16%;}
</style>

<form id="param_form">
	<input type="hidden" id="nPage" name="nPage" value="" />
	<input type="hidden" id="strSubModule" name="strSubModule" value="Beds" />
	<input type="hidden" id="strOrderColumn" name="strOrderColumn" value="0" />
	<input type="hidden" id="strSortOrder" name="strSortOrder" value="desc" />
</form>

<div class="content-heading">Beds</div>
<div class="row">
	<div class="col-xs-12">
		<div class=" panel panel-default">
			<div class="panel-body">
				Search
				<form id="filter_form" role="form">
					<div class="form-group">
						<div class="col-xs-12 col-sm-2">
							<label>Ward</label> 
							<?php TableComboMsSql("Wards", "WardName", "WardId", " IsActive = 1 order by WardName asc", "nFilterWardId", "", "", "--- Select ---", "", "form-control searchable");?>
						</div>
						<div class="col-xs-12 col-sm-2">
							<label>Bed Number</label> 
							<input type="number" class="form-control" name="strFilterName" id="strFilterName">
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-12 col-sm-2">
							<label for="bEnabled">Enabled</label> 
							<select id="bEnabled" name="bEnabled" class="form-control">
								<option value="">-- Select --</option>
								<option value="1">Yes</option>
								<option value="0">No</option>
							</select>
						</div>
					</div>
				</form>
				<div class="clear clearfix"></div>
				<br>
				<hr>
				Add
				<form id="insertion_form" data-parsley-validate="">
					<input type="hidden" id="nBedId" name="nBedId" value="" />
					<div class="form-group">
						<div class="col-xs-12 col-sm-2">
							<label>Ward</label> 
							<?php TableComboMsSql("Wards", "WardName", "WardId", " IsActive = 1 order by WardName asc", "nWardId", "", "", "--- Select ---", "", "form-control searchable required", "required");?>
						</div>
						<div class="col-xs-12 col-sm-2">
							<label>Bed No</label> 
							<input type="number" class="form-control" id="strBed" name="strBed" required/>
						</div>
						<div class="col-xs-12 col-sm-2">
							<label>Enabled</label> <br>
							<div class="checkbox c-checkbox">
								<label> 
									<input type="checkbox" name="isactive_cb" id="isactive_cb" class="isactive_cb" value="1" checked> 
									<span class="fa fa-check"></span>
								</label>
							</div>
						</div>
					</div>
					<div class="clear clearfix"></div>
    				<br>
    				<div class="btn-group" style="padding-left: 10px;">
    					<button type="submit" class="btn btn-success submit_btn">
    						Submit
    					</button>
    					<button type="reset" class="btn btn-warning reset_btn">
    						Reset
    					</button>
    				</div>
				</form>
				<br>
				<div class="clear clearfix"></div>
				<br>
				<hr>
				Listing
				<br>
				<div class="table-responsive">
					<table id="company_table" class="table table-bordered table-hover table-condensed table-vcenter">
						<thead>
							<tr>
            					<th>ID</th>
            					<th>Bed Number</th>
            					<th>Ward</th>
            					<th>Enabled</th>
            					<th>Action</th>
							</tr>
						</thead>
						<tbody id="company_table_tbody">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
 	
<script>
	$("#strBed").focus();
	$(function(){
		$('.searchable').select2({
		    theme: "bootstrap"
		});
		
		getList(1, $("#strOrderColumn").val(), $("#strSortOrder").val(), false);

		  $('#insertion_form').parsley().on('field:validated', function() {
				  if($("#insertion_form .select2").parent().find(".parsley-errors-list").length){
					  $("#insertion_form .select2").parent().find(".parsley-errors-list").remove();
					  $("#insertion_form .select2").parent().append('<ul class="parsley-errors-list filled" id="parsley-id-5"><li class="parsley-required">This value is required.</li></ul>');
				  }
			  }).on('form:submit', function() {
			    $(".submit_btn").attr("disabled", true);
			    
				if($("#nBedId").val() != "")
					var strAction = "Edit";
				else
					var strAction = "Add";
		    
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: $('#insertion_form').serialize() + "&" + $("#param_form").serialize() + "&strAction=" + strAction,
		        success: function(data)
		        { 
		        	getList($("#nPage").val(), $("#strOrderColumn").val(), $("#strSortOrder").val(), false);
		        	$(".parsley-errors-list").remove();
		        }
		      });

		      $("#strBed").focus();
		    	return false;
		  });


		$(document).on("click", ".delete_btn", function(){
			$("#nBedId").val($(this).parent().parent().attr("id"));
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: "strAction=Delete" + "&" + $("#param_form").serialize() + "&nBedId=" + $(this).parent().parent().attr("id"),
		        success: function(data)
		        { 
		        	getList($("#nPage").val(), $("#strOrderColumn").val(), $("#strSortOrder").val(), false);
		        }
		      });
		});

		$(document).on("click", ".edit_btn", function(){
			$("#nBedId").val($(this).parent().parent().attr("id"));
		      $.ajax({
		        type: 'POST',
		        url: "../../backend/admin/operations.php",
		        data: "strAction=Get" + "&" + $("#param_form").serialize() + "&nBedId=" + $(this).parent().parent().attr("id"),
		        dataType:"json",
		        cache:false,
		        success: function(data)
		        {
		        	$("#strBed").val(data['rstRow']['BedNo']);
		        	$("#nWardId").val(data['rstRow']['WardId']).trigger('change');

		        	if(data['rstRow']['IsActive'] == "1"){
			        	$("#isactive_cb").attr("checked", true);
			        	$("#isactive_cb").prop("checked", true);
		        	}
		        	else{
		        		$("#isactive_cb").attr("checked", false);
		        		$("#isactive_cb").prop("checked", false);
		        	}
		        }
		      });
		});

		$(document).on("click", ".table th:not(:last-child)", function(){
			getList($("#nPage").val(), $(this).index());
		});

		$(document).on("keyup change", "#filter_form input, #filter_form select", function(){
			getList($("#nPage").val());
		}); 
	});

	function getList(nPage, strOrderColumn, strSortOrder, bSort=true){
		if(strOrderColumn == undefined)
			strOrderColumn = 0;
		if(strSortOrder == undefined)
			strSortOrder = 'desc';
		
		if((nPage != 1 || strOrderColumn == $("#strOrderColumn").val()) && bSort == true){
			if(strSortOrder == "asc" && $("#strSortOrder").val() == "asc")
				strSortOrder = "desc";
			else if(strSortOrder == "desc" && $("#strSortOrder").val() == "desc")
				strSortOrder = "asc";
		}
		
		$("#nPage").val(nPage);
		$("#strSortOrder").val(strSortOrder);
		$("#strOrderColumn").val(strOrderColumn);
		$("#company_table_tbody").html('');
		$(".loader-wrapper").show();

    	$.ajax({
            type: "POST",
            url: "../../backend/admin/json.php",
            cache:false,
            data: "strAction=getBeds&nPage=" + nPage + "&" + "&strSortColumnIndex=" + strOrderColumn + "&strSortOrder=" + strSortOrder + "&" + $("#filter_form").serialize(),
            dataType:"json",
            success:function(data){
                if(data != null){
                    $("#company_table_tbody").html(data);
                    $(".loader-wrapper").hide();
                }
                else{
                	$("#company_table_tbody").html('');
                	$(".loader-wrapper").hide();
                }

                $('#insertion_form').find('input,select,textarea').val('');
                $('#insertion_form').find('.searchable').val('').trigger('change');
                $(".submit_btn").attr("disabled", false);
//             	$("#strBed").focus();

            }
        });
		
	}
</script>
<?php include '../../../includes/footer.php';?>
