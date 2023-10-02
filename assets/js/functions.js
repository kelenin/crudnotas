$(document).ready(function () {

	$('#datatableid').DataTable({
		"pagingType": "full_numbers",
		"lengthMenu": [
			[10, 25, 50, -1],
			[10, 25, 50, "All"]
		],
		responsive: true,
		language: {
			search: "_INPUT_",
			searchPlaceholder: "Search Your Data",
		}
	});

	$("#example1").DataTable({
		"responsive": true,
		"autoWidth": false,
	  });
	  $('#example2').DataTable({
		"paging": true,
		"lengthChange": false,
		"searching": false,
		"ordering": true,
		"info": true,
		"autoWidth": false,
		"responsive": true,
	  });
	

});
function objectAjax(){
	var xmlhttp = false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");			
		} catch (E){
			xmlhttp = false;	
		}		
	}
	if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}
//Inicializo automaticamente la funcion read al entrar a la pagina o recargar la pagina;
addEventListener('load', read, false);

function read(){
        $.ajax({        
        		type: 'POST',
                url:   '?c=administrator&m=table_users',               
                beforeSend: function () {
                        $("#information").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#information").html(response);
                }
        });
}

function register(){
	departamento 		= document.formUser.departamento.value;
	description 	= document.formUser.description.value;
	name_cliente 		= document.formUser.name_cliente.value;
	company 		= document.formUser.company.value;
	phone 		= document.formUser.phone.value;

	ajax = objectAjax();
	ajax.open("POST", "?c=administrator&m=registeruser", true);
	ajax.onreadystatechange=function() {
		if(ajax.readyState==4){			
			read();			
			alert('Los datos guardaron correctamente.');			
			$('#addUser').modal('hide');
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("departamento="+departamento+"&description="+description+"&name_cliente="+name_cliente+"&company="+company+"&phone="+phone);
}	

function update(){
	
	id 			= document.formUserUpdate.id.value;
	descrip 		= document.formUserUpdate.descrip.value;
	statusupd 	= document.formUserUpdate.statusupd.value;
	observacionup 		= document.formUserUpdate.observacionup.value;

	ajax = objectAjax();
	ajax.open("POST", "?c=administrator&m=updateuser", true);
	ajax.onreadystatechange=function() {
		if(ajax.readyState==4){
			read();
			alert('Los datos se actualizaron correctamente.');
			$('#updateUser').modal('hide');
		}
	}
ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
ajax.send("descrip="+descrip+"&statusupd="+statusupd+"&observacionup="+observacionup+"&id="+id);

}

function deleteUser(id){	
	if(confirm('¿Esta seguro de eliminar este registro?')){						
	ajax = objectAjax();
	ajax.open("POST", "?c=administrator&m=deleteuser", true);
	ajax.onreadystatechange=function() {
		if(ajax.readyState==4){			
			read();		
			alert('Los datos fue eliminado correctamente.');

		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+id);
	}
}

function ActiveUser(id){	
	if(confirm('¿Estás seguro que deseas activar nuevamente la nota?')){						
	ajax = objectAjax();
	ajax.open("POST", "?c=administrator&m=activeuser", true);
	ajax.onreadystatechange=function() {
		if(ajax.readyState==4){			
			read();	
			alert('Los datos fue activado correctamente.');
	
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("id="+id);
	}
}

function ModalRegister(){
	$('#addUser').modal('show');
}

function ModalUpdate(id,description,status,observ){			
	document.formUserUpdate.id.value 		   = id;
	document.formUserUpdate.descrip.value  = description;
	document.formUserUpdate.statusupd.value 	= status;
	document.formUserUpdate.observacionup.value 	= observ;
	$('#updateUser').modal('show');
}

/*
	CRUD creado por Katheren Salom
	Contacto: kartherensalom@gmail.com
*/