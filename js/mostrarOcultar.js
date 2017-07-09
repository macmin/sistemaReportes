function mostrar(){
document.getElementById('registrar').style.visibility = 'visible';
}

function ocultar(){
document.getElementById('registrar').style.visibility='hidden';
}

function mostrarfecha(){
document.getElementById('fecha').style.display ='block'
document.getElementById('productos').style.display = 'none';
document.getElementById('entradasalida').style.display='none';
}

function mostrarproducto(){
document.getElementById('fecha').style.display='none';
document.getElementById('productos').style.display = 'block';
document.getElementById('entradasalida').style.display='none';
}

function entradasalida(){
document.getElementById('fecha').style.display='none';
document.getElementById('productos').style.display = 'none';
document.getElementById('entradasalida').style.display='block';

}


