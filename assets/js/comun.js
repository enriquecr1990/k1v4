$(document).ready(function(){

    $('body').on('click','.btn_test',function(e){
        e.preventDefault();
        Comun.prueba();
    });


});

var Comun = {
    prueba : function(){
        $.ajax({
            url: base_url + 'pruebas',
            dataType : 'html',
            data: {},
            success : function (respuesta){
                console.log(respuesta);
            },
            error : function (er){
                console.log(er.status);
            }
        });
    }
};