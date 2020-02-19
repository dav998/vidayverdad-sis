@extends('layouts.sidebar')

@section('content')
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}

        #myImg {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #myImg:hover {opacity: 0.7;}

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
        }

        /* Modal Content (image) */
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        /* Caption of Modal Image */
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            height: 150px;
        }

        /* Add Animation */
        .modal-content, #caption {
            -webkit-animation-name: zoom;
            -webkit-animation-duration: 0.6s;
            animation-name: zoom;
            animation-duration: 0.6s;
        }

        @-webkit-keyframes zoom {
            from {-webkit-transform:scale(0)}
            to {-webkit-transform:scale(1)}
        }

        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }

        /* The Close Button */
        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        /* 100% Image Width on Smaller Screens */
        @media only screen and (max-width: 700px){
            .modal-content {
                width: 100%;
            }
        }
        @media print {
            #printbtn {
                display :  none;
            }
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Reportes/Modificaci&oacute;n de Vacaci&oacute;n/Ver</div>
                    <div class="panel-body">
                        <legend>Ver Modificaci&oacute;n de Vacaci&oacute;n </legend>
                        <div class="form-group">
                            <label for="">Modificaci&oacute;n Realizadas en Fecha:</label>
                            <input readonly  value="{{$data->created_at}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Nombre del Solicitante</label>
                            <input readonly  value="{{$user->nombre}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Cargo</label>
                            <input readonly required value="{{$data->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
                        </div>
                        <div class="form-group">
                            <label for="">D&iacute;as</label>
                            <input readonly required value="{{$data->dias_repuestos}}"  type="text" class="form-control" name="dias" id="dias">
                        </div>

                        <div class="form-group">
                            <label for="">Motivo</label>
                            <textarea readonly type="text" class="form-control" name="observacion" id="observacion" placeholder="Observaciones" >{{$data->motivo}}</textarea>
                        </div>
                        <!--div class="form-group">
                            <label for="">Agrega Imagenes de Respaldo</label>
                            <input accept="image/*" type="file" class="-file-photo-o" name="imagen" id="imagen">
                        </div-->
                        <button id="printbtn" onclick="myFunction()" class="btn-primary">Pasar a PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById("myImg");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        function myFunction() {
            window.print();
        }
    </script>
@endsection