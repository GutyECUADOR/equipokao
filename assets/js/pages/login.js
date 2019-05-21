$(function() {

    let registerForm = $('#registerForm');
    registerForm.submit(function (event) {
        event.preventDefault();
       
        UIkit.modal.confirm('Nos contactaremos contigo gracias a los datos que has ingresado. Deseas finalizar tu registro? ', function() {
            $.ajax({
                url: 'index.php/registro/register',
                method: 'POST',
                data: registerForm.serialize(),

                success: function( response ) {
                    let responseJSON = JSON.parse(response);
                    console.log(responseJSON);
                    UIkit.modal.alert(responseJSON.message, {labels: {'Ok': 'Listo!'}});
                    registerForm.trigger("reset");
                },
                error: function(error) {
                    alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
                }

            });
        },  {labels: {'Ok': 'Si, registrame', 'Cancel': 'Cancelar'}});
    })
    
    let inputPhone = $('#celular');
    if(inputPhone.length) {
        inputPhone.kendoMaskedTextBox({
            mask: "(999) 000-0000"
        });
    }


});