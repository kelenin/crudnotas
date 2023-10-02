/**
 * File : addNewnotas.js
 * 
 * 
 * @author Katheren Salom
 */

$(document).ready(function(){
	
	var addNotasForm = $("#addNewnotas");
	
	var validator = addNotasForm.validate({
		
		rules:{
			departamento :{ required : true },
			description :{ required : true },
			name_cliente :{ required : true },
			company :{ required : true },
			phone :{ required : true }

		},
		messages:{
			departamento :{ required : "This field is required" },
			description :{ required : "This field is required" },
			name_cliente :{ required : "This field is required" },
			company :{ required : "This field is required" },
			phone :{ required : "This field is required" }	

		}
	});
});
