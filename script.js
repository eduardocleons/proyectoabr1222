function hidebox(bmsg){
    var box = document.getElementById(bmsg);
    box.className = 'hidden';

}

function boxid(){
    document.getElementById("box").setAttribute("id", "erbox");
    boxid = function(){};
}

function eliminar(cod){
    if (confirm("Seguro que deseas eliminar este registro ?") == true) {
        //alert("You pressed OK!" + cod) ;
        document.getElementById("eliminar_"+cod).submit();
    } 
}

function modificar(cod){
    document.getElementById("modificar_"+cod).submit();
}

function validar(b=0){
    var nom  = document.getElementById("nombre").value;
    var cor  = document.getElementById("email").value;
    var sx   = document.getElementsByName("sexo");
    var sxop = "";
    var li   = document.getElementById("area");
    var liop = li.value;
    var txt  = document.getElementById("textarea").value;
    var Cbox = document.getElementsByName('check'); 
    var chck = "0";  
    var bol  = document.getElementById('checkbol');  
    var bchk = "";
    boxid();
    var box = document.getElementById('erbox');
    box.className = '';
    var msg = document.getElementById('box_title');

    if (bol.checked == true ){  
        bchk=1;
    }else{
        bchk=0;
    }  

    for(i = 0; i<sx.length; i++){
        if(sx[i].checked){
            sxop=sx[i].value;
        }
    }

    for (var checkbox of Cbox) {  
        if (checkbox.checked){    
          chck = chck+","+checkbox.value;
        }
    }

    //Validacion valores
    if (nom == null || nom == "") {
        msg.innerHTML = "**Por favor ingrese un nombre";
        setTimeout(hidebox, 3000, 'erbox');
        return;   
    }

    if (cor == null || cor == "") {
        msg.innerHTML = "**Por favor ingrese un correo";
        setTimeout(hidebox, 3000, 'erbox'); 
        return; 
    } 

    if (sxop == null || sxop == "") {
        msg.innerHTML = "**Por favor Seleccionar un genero";
        setTimeout(hidebox, 3000, 'erbox');
        return;    
    } 

    if (sxop == null || sxop == "") {
        msg.innerHTML = "**Por favor Seleccionar un genero";
        setTimeout(hidebox, 3000, 'erbox');
        return; 
    } 

    if (liop == null || liop == "") { 
        msg.innerHTML = "**Por favor Seleccionar area";
        setTimeout(hidebox, 3000, 'erbox');
        return;
    } 

    if (txt == null || txt == "") {
        msg.innerHTML = "**Por favor agregar una descripcion";
        setTimeout(hidebox, 3000, 'erbox');
        return;  
    } 

    if (chck == null || chck == "0") {
        msg.innerHTML = "**Por favor seleccionar roles";
        console.log('flag');
        setTimeout(hidebox, 3000, 'erbox');  
        return;  
    } 

    if(b==0){
        document.getElementById('data').value="1:"+chck;   
    }else{
        document.getElementById('data').value="2:"+chck;
    }

    document.getElementById("registro").submit();
    
}