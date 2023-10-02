/**
 * File : editNotas.js 
 * 
 * 
 * @author Katheren Salom
 */
$(document).ready(function(){
	
	var editNotasForm = $("#editNotas");
	
	var validator = editNotasForm.validate({
		
		rules:{
			fname :{ required : true },
			statusupd :{ required : true },
			observ :{ required : true }

		},
		messages:{
			fname :{ required : "This field is required" },
			statusupd :{ required : "This field is required" }	,
			observ :{ required : "This field is required" }	

		}
	});

});