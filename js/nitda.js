// JavaScript Document
$(document).ready(function(e) {

//ADMIN HOME PAGE //
// functions
// delete department
function deletefunction(modalid, id, name, confirmbtn, url){
		$(modalid).on('show.bs.modal', function(event){
		$('.modal-footer').show();
		var button= $(event.relatedTarget); // Button that triggered the modal
		var deleteid = button.data(id); // info from data attributes
		var deletedptname = button.data(name);
		
		var modal=$(this);
		modal.find('.modal-title').text('Confirmation (Warning! you cant undo this operation)');
		modal.find('.modal-body').text('Are you Sure you want to remove '+ deletedptname);
		
		modal.find(confirmbtn).val(deletedptname);
		// Delete Item Confirmation
		$(confirmbtn).click(function(){
						var deleteid = $(confirmbtn).val();
						$.post(url, {deleteid : deleteid}, function(result){
							$('.modal-title').text('Message').fadeIn();
							$('.modal-body').html(result);
							$('.modal-footer').slideUp('slow');
							
							// refresh page after delete
							$(modalid).on('hidden.bs.modal', function () {
								   location.reload();
								});
							
							}) 
	
					 })	
		});
		}
		//CALL TO DELETE DEPARTMENT	
		deletefunction('#deletedepartmentmodal', 'did', 'dptname', '#confirmdeletedpt', 'request/deletedpt.php');	
		//CALL TO DELETE USER
		deletefunction('#deleteusermodal', 'id', 'name', '#confirmdeleteuser', 'request/deleteuser.php');	
// ajax post function
function ajaxsubmit(formid, url, result){
		$.ajax({
           type: "POST",
           url: url,
           data: $(formid).serialize(), // serializes the form's elements.
           success: function(data)
           {
               $(result).html(data); // show response from the php script.
           }
         });
		}
		
// ajax post trigger
// new deparment
$('#newdepartmentform').on('submit', function(e){
		e.preventDefault();
		ajaxsubmit('#newdepartmentform','request/newdepartment.php','.modal-body');
		// refresh page after delete
							$('#newdepartment').on('hidden.bs.modal', function () {
								   location.reload();
								});
		
	});
// FUNCTION CALL TO NEW USER AJAX FORM SUBMIT //
		$('#newuserform').on('submit', function(e){
		e.preventDefault();
		ajaxsubmit('#newuserform', 'request/newuser.php', '.modal-body');
		// refresh page after delete
							$('#newuser').on('hidden.bs.modal', function () {
								   location.reload();
								});	
		});		
// end of ajax post trigger				

// TRIGGER VIEW FILE
$('.fileholder').click(function(event) {
      	var button= $(event.relatedTarget); // Button that triggered the modal
		var file_desc = button.data(desc); // info from data attributes
		alert();
		$('.displayfile').html(file_desc);
});
	
	// MULTIPLE INPUTS
		$(function() {
			var numlen = $('#units').val().length;
						
			//To render the input device to multiple email input using BootStrap icon
			$('#units').multiple_emails({position: "bottom"});
			//OR $('#phonenumbers').multiple_emails("Bootstrap");
			
			//Shows the value of the input device, which is in JSON format
			$('#current_emailsBS').text($('#units').val());
			$('#units').change( function(){
				$('#current_emailsBS').text($(this).val());
			});
		});
		$(function() {
			var numlen = $('.units').val().length;
						
			//To render the input device to multiple email input using BootStrap icon
			$('.units').multiple_emails({position: "bottom"});
			//OR $('#phonenumbers').multiple_emails("Bootstrap");
			
			//Shows the value of the input device, which is in JSON format
			$('#current_emailsBS').text($('.units').val());
			$('.units').change( function(){
				$('#current_emailsBS').text($(this).val());
			});
		});
	// end multiple inputs

    
});