/*Modal mostrar */
$(document).ready(function () {
  $(document).on('click', '#mostrar', function () {
    var farmacoV = $(this).data('farmaco');
    var mecanismoV = $(this).data('mecanismo');
    var imagenV = $(this).data('imagen');
    var efectoV = $(this).data('efecto');
    var tituloV = $(this).data('titulo');
    var grupoV = $(this).data('grupo');
    var interaccionV = $(this).data('interaccion');


    $("#farmacoN").val(farmacoV);
    $("#mecanismoN").val(mecanismoV);
    $("#imagenF").val(imagenV);
    $("#efectoN").val(efectoV);
    $("#bibliografiaN").val(tituloV);
    $("#grupoN").val(grupoV);
    $("#interaccionN").val(interaccionV);
  })

})

// sweet alert 2
$('#delete_interaccion').click(function (e) {
  e.preventDefault();
  // const form = $(this).parents('form');
  console.log("Hola");
  // Swal.fire({
  //   title: 'Estas seguro',
  //   text: "No prodas revertirlo",
  //   icon: 'warning',
  //   showCancelButton: true,
  //   confirmButtonColor: '#3085d6',
  //   cancelButtonColor: '#d33',
  //   confirmButtonText: 'Sim, delete it!'
  // }).then((result) => {
  //   if (result.isConfirmed) {

  //     this.submit();
  //     // Swal.fire(
  //     //   'Deleted!',
  //     //   'Your file has been deleted.',
  //     //   'success'
  //     // )
  //   }
  // });
});
/*Modal actualizar Interaccion */
$(document).ready(function () {
  $(document).on('click', '#bt-modal', function () {
    var id_In = $(this).data('id_inter');
    var interaccion = $(this).data('inter');
    var id_farmaco = $(this).data('id_far');


    $("#id_interaccion").val(id_In);
    $("#inter").val(interaccion);
    $("#id_farmaco").val(id_farmaco);
  });
});
/* Tabla farmaco */
$(document).ready(function () {
  $('#farmaco').DataTable({
    "lengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]
  });
});
/* Tabla interacciones*/
$(document).ready(function () {
  $('#tabla_interacciones').DataTable({
    "lengthMenu": [[8, 15], [8, 15, "All"]]
  });
});


