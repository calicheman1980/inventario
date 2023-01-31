/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
function redireccionar(urldestino) 
{
    //alert(urldestino);
    var urlFinal=urldestino;
    //alert(urlFinal);
    location.href=urlFinal;
}
function redireccionar_1(urldestino) 
{
    
    var urlFinal=+urldestino;
    location.href=urlFinal;
}
function ChequearTodos(chkbox){ 
	for (var i=0;i < document.forms["formBorrar"].elements.length;i++){
		var elemento = document.forms[0].elements[i];
		if (elemento.type == "checkbox"){
			elemento.checked = chkbox.checked
		}
	}
}

function Desvincular(tabla, base)
{
        var cont=0;
	for (var i=1;i < (document.forms["formBorrar"].elements.length); i++){		
		if(document.forms["formBorrar"].todos[i].checked){
			cont=cont+1;			
		}
	}
	var noTabla=tabla;
	/*if(noTabla=="empleado"){
		noTabla="empleado";
	}*/
	if(cont>1){		
		if(tabla=="empleado"){
			noTabla="empleados";
		}
		if(tabla=="vehiculo"){
			noTabla="vehiculos";
		}
		if(tabla=="usuario"){
			noTabla="usuarios";
		}
	}
	if(cont>0){
		if(confirm("Esta seguro de desvincular permanentemente "+cont+" "+noTabla)){
			var paraBorrar = new Array(cont);
			var j=0;
			for (var i=1;i < (document.forms["formBorrar"].elements.length); i++){
				if(document.forms["formBorrar"].todos[i].checked){		
                                        paraBorrar[j]=document.forms["formBorrar"].todos[i].value;	
					j=j+1;
                                        
				}
			}
			window.location=base+tabla+"/desvincular/"+paraBorrar+"/"+tabla+"/"+cont+"/true";
		}
		else{
			//alert(tildes_unicode("Ha cancelado la operación"));
		}
	} else{
            alert(tildes_unicode("Debe seleccionar "));
        }
} 


