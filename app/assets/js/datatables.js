// DataTables para la tabla rastreo
$(document).ready(function() {
    $('#tabla_rastreo').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
        },
        "pageLength": 3,
        "lengthMenu": [1, 2 ,3]
    });
});




// DataTables para la tabla bodegas
$(document).ready(function() {
  $('#tabla_bodegas').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "pageLength": 5,
    "buttons": [
      {
        text: 'AÑADIR BODEGA',
        action: function ( e, dt, node, config ) {
          $('#addBodegaModal').modal('show');
        }
      },
      {
        extend: 'excel',
        text: 'REPORTE EXCEL', 
        title: 'Reporte de bodegas',
        filename: 'Bodegas - El Libertador',
        exportOptions: {
          columns: ':not(:last)' 
        }
      }
    ]
  });


  // Evento que se dispara cuando se cierra el modal
  $('#addBodegaModal').on('hidden.bs.modal', function (e) {
    // Restablecer el formulario
    $(this).find('form')[0].reset();
  });

  // Evento de clic para el botón de cierre del modal
  $(document).on('click', '#addBodegaModal .btn-secondary', function(e) {
    e.preventDefault();
    $('#addBodegaModal').modal('hide');
  });
});

// Funcion para insertar bodegas
$(document).ready(function() {
  $('#addBodegaForm').on('submit', function(e) {
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      data: $(this).serialize(),
      success: function(response) {
        console.log(response); // Imprimir la respuesta en la consola
        if (response.trim() === 'success') {
          $('#addBodegaModal .modal-body').html('Bodega ingresada con éxito');
          setTimeout(function() {
            $('#addBodegaModal').modal('hide');
            location.reload();
          }, 1000);
        } else {
          $('#addBodegaModal .modal-body').html('Fallo al ingresarse');
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
        $('#addBodegaModal .modal-body').html('Error en la petición');
      }
    });
  });
});

// Funcion para Eliminar bodegas
$(document).ready(function() {
  $(document).on('click', '.delete-btn', function() {
    var id = $(this).data('id');
    Swal.fire({
      title: '¿Está seguro?',
      text: "No podrá revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Eliminar'
      
    }).then((result) => {
      if (result.isConfirmed) {
        console.log(id);
        window.location.href = "eliminar_bodega.php?id=" + id;
      }
    })
  });
});

// DataTables para la tabla ubicaciones
$(document).ready(function() {
  $('#tabla_ubicaciones').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "pageLength": 5,
    "buttons": [
      {
        text: 'AÑADIR UBICACIÓN',
        action: function ( e, dt, node, config ) {
          $('#addUbicacionModal').modal('show');
        }
      },
      {
        extend: 'excel',
        text: 'REPORTE EXCEL', 
        title: 'Reporte de Ubicaciones',
        filename: 'Ubicaciones - El Libertador',
        exportOptions: {
          columns: ':not(:last)' 
        }
      }
    ]
  });
});

// DataTables para la tabla clientes
$(document).ready(function() {
  $('#tabla_clientes').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "pageLength": 5,
    "buttons": [
      {
        text: 'AÑADIR CLIENTE',
        action: function ( e, dt, node, config ) {
          $('#addClienteModal').modal('show');
        }
      },
      {
        extend: 'excel',
        text: 'REPORTE EXCEL', 
        title: 'Reporte de Clientes',
        filename: 'Clientes - El Libertador',
        exportOptions: {
          columns: ':not(:last)' 
        }
      }
    ]
  });
});

// DataTables para la tabla usuarios
$(document).ready(function() {
  $('#tabla_usuarios').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "pageLength": 5,
    "buttons": [
      {
        text: 'AÑADIR USUARIO',
        action: function ( e, dt, node, config ) {
          $('#addUsuarioModal').modal('show');
        }
      },
      {
        extend: 'excel',
        text: 'REPORTE EXCEL', 
        title: 'Reporte de Usuarios',
        filename: 'Usuarios - El Libertador',
        exportOptions: {
          columns: ':not(:last)' 
        }
      }
    ]
  });
});


// DataTables para la tabla vehiculos
$(document).ready(function() {
  $('#tabla_vehiculos').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "pageLength": 5,
    "buttons": [
      {
        text: 'AÑADIR VEHICULO',
        action: function ( e, dt, node, config ) {
          $('#addVehiculoModal').modal('show');
        }
      },
      {
        extend: 'excel',
        text: 'REPORTE EXCEL', 
        title: 'Reporte de Flota',
        filename: 'Vehiculos - El Libertador',
        exportOptions: {
          columns: ':not(:last)' 
        }
      }
    ]
  });
});

// DataTables para la tabla bodegaje
$(document).ready(function() {
  $('#tabla_bodegaje').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json"
    },
    "dom": 'Bfrtip',
    "pageLength": 5,
    "buttons": [
      {
        text: 'REGISTRAR MERCADERIA EN BODEGA',
        action: function ( e, dt, node, config ) {
          $('#addRegistroMercancia').modal('show');
        }
      },
      {
        extend: 'excel',
        text: 'REPORTE EXCEL', 
        title: 'Reporte de Mercaderia en Bodegas',
        filename: 'Mercaderia de clientes en Bodegas - El Libertador',
        exportOptions: {
          columns: ':not(:last)' 
        }
      }
    ]
  });
});

