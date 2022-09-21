<html>
<script>

function Validar(){
 for($a = 1;$a<=6;$a++){
 if(this.document.altausuarios.radio2[0].checked) {
 	this.document.altausuarios.nControl.disabled = false;
		this.document.altausuarios.nControl.value = '';
			this.document.altausuarios.carrera.disabled = false;
				this.document.altausuarios.carrera.value = '';
					this.document.altausuarios.carrera.value ='a';
					this.document.altausuarios.semestre.disabled = false;
						this.document.altausuarios.semestre.value = '';
					this.document.altausuarios.grupo.disabled = false;
				this.document.altausuarios.grupo.value = '';
			this.document.altausuarios.turno.disabled = false;
		this.document.altausuarios.turno.value = '';
	this.document.altausuarios.aula.disabled = false;	
this.document.altausuarios.aula.value = '';

		} else {
 	
	this.document.altausuarios.nControl.disabled = true;
	this.document.altausuarios.nControl.value = '';
	  this.document.altausuarios.carrera.disabled = true;
	  this.document.altausuarios.carrera.value = '';
		this.document.altausuarios.semestre.disabled = true;
		this.document.altausuarios.semestre.value = '';
	 this.document.altausuarios.grupo.disabled = true;
	 this.document.altausuarios.grupo.value = '';
 this.document.altausuarios.turno.disabled = true;
 this.document.altausuarios.turno.value = '';
this.document.altausuarios.aula.disabled = true;
this.document.altausuarios.aula.value = '';    
		}
	    	}
				}
				
function texto(){
miinfo = "";
var checkOK = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚabcdefghijklmnñopqrstuvwxyzáéíóú";
var checkStr = this.document.altausuarios.nombre.value;
var allValid = true;
if (this.document.altausuarios.nombre.value == "") {
miinfo += "\n     -  Nombre";
} else
for (i = 0;  i < checkStr.length;  i++)
  {
    ch = checkStr.charAt(i);
    for (j = 0;  j < checkOK.length;  j++)
      if (ch == checkOK.charAt(j))
        break;
    if (j == checkOK.length)
    {
      allValid = false;
      break;
    }
  }
  if (!allValid)
  {
    alert("Nombre no Valido");
    this.document.altausuarios.nombre.focus();
	//formulario.nombre.focus();
    return (false);
  }
  
  
var er_cp = /(^([0-9]{1,13})|^)$/
    if(!er_cp.test(this.document.altausuarios.telefono.value)) {    
        alert('Telefono no Valido')   
        return false       
}else
if(this.document.altausuarios.telefono.value == "" ) {
miinfo += "\n     -  Telefono"
}

if (this.document.altausuarios.email.value.indexOf('@', 0) == -1 || document.altausuarios.email.value.indexOf('.', 0) == -1)
{
miinfo += "\n     -  Direccion de Correo Invalida"
}
var er_cont = /(^([0-9]{1,9})|^)$/
		if(!er_cont.test(this.document.altausuarios.nControl.value)) {    
		  //er_cont;
    		//if(er_cont = 08106 || er_cont = 09106 || er_cont = 10106)
	 			//if(er_cont)
	 alert('Nº Control no Valido')   
        return false       
}else 

if(this.document.altausuarios.nControl.value == ""){

miinfo += "\n     -  Numero de Control"
}
if(this.document.altausuarios.carrera.value == ""){
miinfo += "\n     -  Carrera"
}

var er_semes = /(^([0-9]{1,1})|^)$/
    if(!er_semes.test(this.document.altausuarios.semestre.value)) {    
        alert('Semestre no Valido')   
        return false       
}else 
if(this.document.altausuarios.semestre.value == ""){
miinfo += "\n     -  Semestre"
}	 
if(this.document.altausuarios.grupo.value == ""){
miinfo += "\n     -  Grupo"
}
if(this.document.altausuarios.turno.value == ""){
miinfo += "\n     -  Turno"
}
if(this.document.altausuarios.aula.value == ""){
miinfo += "\n     -  Aula"
}
if(this.document.altausuarios.tipo.value == ""){
miinfo += "\n     -  Queja, Sujerencia o Reconocimiento"
}
if(this.document.altausuarios.notas.value == ""){
miinfo += "\n     -  Notas"
}
 	// Datos para la validaciion del formulario
	
	if (miinfo != "") {
miinfo ="_____________________________\n" +
"Campos Obligatorios:\n" +
miinfo + "\n_____________________________" +
"\nPor favor inténtalo de nuevo";
alert(miinfo);
return false;
}
else return true;
}

function tex(_v) {
if(this.document.altausuarios.tipo.value ='tipo'){
this.document.altausuarios.tipo.value=_v;
return true;
}else
if(this.document.altausuarios.tipo.value){
alert("Que es: Queja, Sujerencia o Reconocimiento");
return false;
}}

if (window.Event)
this.document.captureEvents(Event.MOUSEUP);

function nocontextmenu()
{
event.cancelBubble = true
event.returnValue = false;
return false;
}

function norightclick(e)
{
if (window.Event)
{
if (e.which == 2 || e.which == 3)
return false;
}
else
if (event.button == 2 || event.button == 3)
{
window.event.cancelBubble = true
window.event.returnValue = false;
return false;
}
}

this.document.oncontextmenu = nocontextmenu;
this.document.onmousedown = norightclick;

</script>
</html>
