
/**
 * Oculta los elementos que tengan el id  productos , entradasalida 
 * y muestra el elemento con el id fecha 
 *@Return void
 */
function mostrarfecha () {
	document.getElementById('fecha').style.display ='block'
	document.getElementById('productos').style.display = 'none';
	document.getElementById('entradasalida').style.display='none';
}
/**
 * Oculta el elemento con el id fecha , entradasalida y muestra el
 * elemento con el id productos  
 * @Return void
 */	
function mostrarproducto () {
	document.getElementById('fecha').style.display='none';
	document.getElementById('productos').style.display = 'block';
	document.getElementById('entradasalida').style.display='none';
}
/**
 * Oculta los elementos con el id fecha , productos y muestra
 * el elemento con el id entradasalida
 * @Return void 
 */
function entradasalida () {
	document.getElementById('fecha').style.display='none';
	document.getElementById('productos').style.display = 'none';
	document.getElementById('entradasalida').style.display='block';
}
