<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
    <style>
        #mensaje{
            color: #f00;
            font-size: 40px;
            background-color: black;
            width: 500px;
        }
    </style>


    <script src="jquery-3.3.1.min.js"></script>
    <script>
        function enviaAjax(){
            var numero = $('#numero').val();
            if(numero == '' || numero <= 0){
                $('#mensaje').html('Faltan campos por llenar');
                setTimeout("$('#mensaje').html('');", 5000);
            }
            else{
                //Hace algo
                $.ajax({
                    url     : 'respuesta.php',
                    type    : 'post',
                    dataType: 'text',
                    data    : 'numero='+numero,
                    success : function(res){
                        console.log(res);

                        if(res == 1){
                            $('#mensaje').html('APROBASTE MI BRO');
                        }
                        else {
                            $('#mensaje').html('REPROBASTE MI BRO');
                        }
                        setTimeout("$('#mensaje').html('');", 5000);
                    },
                    error: function(){
                        alert('Error archivo no encontrado...');
                    }

                })
            }
        }
    </script>
</head>



<body>
    <input type="text" name="numero" id="numero" /> <br>
    <br>
    <a href="javascript:void(0);" onClick="enviaAjax();">
        Enviar con ajax
    </a><br>
    <div id="mensaje"></div>
    
</body>
</html>