$(function() {

    let registerForm = $('#registerForm');
    let inputPhone = $('#celular');
    let s

    registerForm.submit(function (event) {
       
        event.preventDefault();
       
        UIkit.modal.confirm('Nos contactaremos contigo gracias a los datos que has ingresado. Deseas finalizar tu registro? ', function() {
            
            var modalBlocked = UIkit.modal.blockUI('<div class=\'uk-text-center\'>Registrando, espere por favor...<br/><img class=\'uk-margin-top\' src=\'assets/img/spinners/spinner.gif\' alt=\'\'>');
            modalBlocked.show();

            $.ajax({
                url: 'registro/register',
                method: 'POST',
                data: registerForm.serialize(),

                success: function(response) {
                    console.log(response);
                    let responseJSON = JSON.parse(response);
                    console.log(responseJSON);
                    UIkit.modal.alert(responseJSON.message, {labels: {'Ok': 'Listo!'}});
                    registerForm.trigger("reset");
                },
                error: function(error) {
                    alert('No se pudo completar la operación. #' + error.status + ' ' + error.statusText, '. Intentelo mas tarde.');
                },
                complete: function(data) {
                    modalBlocked.hide();
                }

            });
        },  {labels: {'Ok': 'Si, registrame', 'Cancel': 'Cancelar'}});
    })
    
    
    if(inputPhone.length) {
        inputPhone.kendoMaskedTextBox({
            mask: "(999) 000-0000"
        });
    }

    $("#deporteFavorito").select2({
        placeholder: "Seleccione al menos 1 deporte",
        allowClear: true
    });

    $("#testButton").click(function() {
        let data = registerForm.serialize();
        console.log(data);
      });


});