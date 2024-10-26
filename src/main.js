$(document).ready(function () {
  // Función para manejar modales
  window.openModal = () => toggleModal('#modalproduct', 'open');
  window.closeModal = () => toggleModal('#modalproduct', 'close');

  const toggleModal = (modalId, action) => {
    $(modalId).toggleClass('hidden', action === 'close');
    if (action === 'close') $(modalId).find('form').trigger('reset'); // Limpia el formulario
  };

  // Función para mostrar productos
  const mostrarProductos = () => {
    $.ajax({
      type: "GET",
      url: "mostrarDatos.php",
      success: response => $("#productsData").html(response),
      error: () => Swal.fire('Error', 'No se pudieron cargar los productos.', 'error')
    });
  };

 // Función para manejar el envío de formularios
const handleFormSubmit = (formId, url, actionType, successMessage) => {
  // Escuchar el evento de envío del formulario
  $(formId).submit(function (e) {
    e.preventDefault(); // Evitar que el formulario se envíe de forma convencional

    // Serializar los datos del formulario y agregar el tipo de acción si se proporciona
    const data = $(this).serialize() + (actionType ? `&action_type=${actionType}` : '');

    // Realizar la solicitud AJAX
    $.ajax({
      type: "POST", // Método de envío
      url: url, // URL a la que se enviarán los datos
      data: data, // Datos que se enviarán
      success: response => {
        // Verificar si hay un error en la respuesta
        if (response.error) {
          alert("Error: " + response.error); // Mostrar mensaje de error
        } else {
          // Mostrar mensaje de éxito
          Swal.fire('¡Éxito!', successMessage, 'success');
          
          // Cerrar el modal correspondiente
          toggleModal(formId === '#formulario' ? '#modalproduct' : '#modalEditProduct', 'close');
          
          // Actualizar la lista de productos en la interfaz
          mostrarProductos(); 
        }
      },
      error: () => alert("Error en la solicitud.") // Manejar errores de la solicitud AJAX
    });
  });
};

// Inicializar el manejo del envío de formularios
handleFormSubmit("#formulario", "ingresarDatos.php", null, 'Producto añadido correctamente.');
handleFormSubmit("#formularioEditar", "productAction.php", 'edit', 'Producto actualizado correctamente.');


  // Función para abrir el modal de edición
  window.editItem = function (id) {
    $.ajax({
      type: "POST",
      url: "productAction.php",
      data: { action_type: 'data', id },
      dataType: 'JSON',
      success: response => {
        if (!response.error) {
          $("#edit-id").val(response.id);
          $("#edit-nombre").val(response.nombre);
          $("#edit-cantidad").val(response.cantidad);
          $("#edit-precio").val(response.precio);
          $("#edit-categoria").val(response.categoria);
          // $("#edit-imagen").val(response.imagen);
          toggleModal("#modalEditProduct", 'open'); // Abrir el modal
        } else {
          alert("Error: " + response.error);
        }
      },
      error: () => alert("Error al obtener los datos del producto.")
    });
  };
  // $("#productsData").on("click","bg-red-500 rounded", function(){
  //   let indice= $(this).productsData("id")
  //   console.log(indice)
  //   eliminarDato(indice)

  // // })
  // // function eliminarDato(id){
  // //   $.ajax({
  // //     type: "POST",
  // //     url: "eliminarProducto.php",
  // //     data: "id",
  // //     dataType: "dataType",
  // //     success: function (response) {
  // //       alert("se elimino")
        
  // //     }
  // //   });
  // // }
  // Función para eliminar productos
  window.deleteItem = (id) => {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "POST",
          url: "eliminarProducto.php",
          data: { id: id },
          success: () => {
            Swal.fire('¡Eliminado!', 'El producto ha sido eliminado.', 'success');
            mostrarProductos(); // Actualiza la tabla sin recargar la página
          },
          error: () => Swal.fire('Error', 'No se pudo eliminar el producto.', 'error')
        });
      }
    });
  };
  // Mostrar productos al cargar la página
  mostrarProductos();
  // Vincular el botón de cerrar para ambos modales
  $('#modalproduct .bg-gray-300').on('click', closeModal);
  $('#modalEditProduct .bg-gray-300').on('click', () => toggleModal('#modalEditProduct', 'close')); 
});
