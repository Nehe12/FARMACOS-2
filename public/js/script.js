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
/*Modal actualizar Bibliografia */
$(document).ready(function () {
  $(document).on('click', '#bt-modalBiblio', function () {
    const id_bilio = $(this).data('id_biblio');
    const titulo = $(this).data('titulo');
    const descripcion = $(this).data('descrip');
    const autor = $(this).data('autor');
    const anio = $(this).data('anio');
    const editorial = $(this).data('editorial');

    $('#biblioID').val(id_bilio);
    $('#tituloU').val(titulo);
    $('#descripcionU').val(descripcion);
    $('#autorU').val(autor);
    $('#añoU').val(anio);
    $('#editorialU').val(editorial);
  })
});
/*Modal actualizar grupo */
$(document).ready(function () {
  $(document).on('click', '#bt-modalGrupo', function () {
    const id_grupo = $(this).data('id_grupo');
    const grupo = $(this).data('grupo');
    const subgrupo = $(this).data('subgrupo');

    $('#grupo_id').val(id_grupo);
    $('#grupoU').val(grupo);
    $('#subgrupoU').val(subgrupo);
  })
})
/*Delete Interaccion */
$('.delete_interaccion').click(function (event) {
  event.preventDefault();
  // const form = $(this).parents('form');
  console.log("Hola");
  Swal.fire({
    title: 'Estas seguro',
    text: "No prodas revertirlo",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {

      this.submit();
      // Swal.fire(
      //   'Deleted!',
      //   'Your file has been deleted.',
      //   'success'
      // )
    }
  });
});
/*Delete grupo */
$('.delete_grupo').click(function (event) {
  event.preventDefault();
  // const form = $(this).parents('form');
  console.log("Hola");
  Swal.fire({
    title: 'Estas seguro',
    text: "No prodas revertirlo",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {

      this.submit();
      // Swal.fire(
      //   'Deleted!',
      //   'Your file has been deleted.',
      //   'success'
      // )
    }
  });
});
/*Delete bibliografia */
$('.delete_bibliografia').click(function (event) {
  event.preventDefault();
  // const form = $(this).parents('form');
  console.log("Hola");
  Swal.fire({
    title: 'Estas seguro',
    text: "No prodas revertirlo",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sim, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {

      this.submit();
      // Swal.fire(
      //   'Deleted!',
      //   'Your file has been deleted.',
      //   'success'
      // )
    }
  });
});
/* Tabla farmaco */
$(document).ready(function () {
  $('#farmaco').DataTable({
    "lengthMenu": [[10, 20, 30, 50, 100, -1], [10, 20, 30, 50, 100, "All"]]
  });
});
/* Tabla interacciones*/
$(document).ready(function () {
  $('#tabla_interacciones').DataTable({
    "lengthMenu": [[8, 15], [8, 15, "All"]]
  });
});
/*Tabla Bibliografias */
$(document).ready(function () {
  $('#tabla_biblios').DataTable({
    "lengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]
  });
});

/*Tabla Bibliografias */
$(document).ready(function () {
  $('#tabla_grupo').DataTable({
    "lengthMenu": [[5, 10, 50, 100, -1], [5, 10, 50, 100, "All"]]
  });
});

/*Checkbox */
// $(function(){
//   $('.mi-switch').change(function (event,state) {
//     var id=$(this).data('id');
//     // var estatus = $(this).prop('checked') == true ? 1 : 0;
//     // console.log(estatus);

//     $.ajax({
//       url:"{{route('activar.farmaco')}}/" + id,
//       type:"PUT",
//       data:{
//         estado: state ? 1 : 0
//       },
//       success:function(data){
//         toastr.success(data.success);
//       }
//     });
//     });
//  });  






 $(document).ready(function () {

   $('.mi-switch').change(function () {
     var estatus = $(this).prop('checked') == true ? 1 : 0;
     var id = $(this).data('id');
     console.log(estatus);
       var url="{{route('activar.farmaco')}}"
     $.ajax({
       method: "GET",
       dataType: "json",
        // url:'/updateA',
        url: url,

       data: {
         'estatus': estatus,
         'id': id,

          // "_token": $("meta[name='csrf-token']").attr("content"),
       },
       success: function (data) {
         $('#resp' + id).html(data.var);
         console.log(data.var);
         console.log("ajh");
       }
     })

   })
 });
// $(function () {
//   $('.mi-switch').change(function () {
//     var status = $(this).prop('checked') == true ? 1 : 0;
//     var id = $(this).prop('id');
//     $.ajax({
//       type: "GET",
//       dataType: "json",
//       url: '/updateA',
//       data:{
//         'status':status,
//         'id':id,
//         success:function (data) {
//           console.log('Success');
//         }
//       },
//     });
//   });
// });
/*Vista previa imagen */
$(document).ready(function (e) {
  $('#image').change(function () {
    let reader = new FileReader();
    reader.onload = (e) => {
      $('#imagenSeleccionada').attr('src', e.target.result);
    }
    reader.readAsDataURL(this.files[0]);
  })
})


