/**
 * Funciones auxiliares de javascripts 
 */
function confirmarBorrar(nombre,id){
  if (confirm("¿Quieres eliminar esta pelicula:  "+nombre+"?"))
  {
   document.location.href="?orden=Borrar&userid="+id;
  }
}