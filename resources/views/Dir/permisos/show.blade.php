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
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Administrar Solicitudes/Permiso/Tolerancia/Rechazadas/Ver</div>
                    <div class="panel-body">
                        <legend>Ver Permiso Rechazado</legend>
                        <div class="form-group">
                            <label for="">Nombre del Solicitante</label>
                            <input readonly  value="{{$user->nombre}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Solicitud Enviada en Fecha:</label>
                            <input readonly  value="{{$data->created_at}}" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>
                        <div class="form-group">
                            <label for="">Tipo de Solicitud</label>
                            @if($data->tipo == 1)
                                <input readonly  value="TOLERANCIA" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                            @else
                                @if($data->tipo == 2)
                                    <input readonly  value="SALIDA ANTICIPADA" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                                @else
                                    <input readonly  value="PERMISO" type="text" class="form-control" name="fecha_ausente" id="fecha_ausente">
                                @endif
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Fecha de Ausencia</label>
                            <input readonly  value="{{$data->fecha_ausencia}}" type="date" class="form-control" name="fecha_ausente" id="fecha_ausente">
                        </div>

                        <div class="form-group">
                            <label for="">Motivo de Ausencia</label>
                            <textarea  readonly value="{{$data->motivo}}" type="text" class="form-control" name="motivo" id="motivo" >{{$data->motivo}}</textarea>

                            <input type="hidden" class="hidden" name="id" id="id" value="{{$data->id}}">
                        </div>
                        <div class="form-group">
                            <label for="">Imagen Adjunta</label> <br>
                            @if (empty($data->url))
                                 No se adjunto imagen
                            @else
                                <img id="myImg" src="{{ URL::to('/uploads/' . $data->url) }}" alt="Imagen Adjunta" style="width:100%;max-width:300px">

                                <!-- The Modal -->
                                <div id="myModal" class="modal">
                                    <span class="close">&times;</span>
                                    <img class="modal-content" id="img01">
                                    <div id="caption"></div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Cargo</label>
                            <input readonly required value="{{$data->cargo}}"  type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo del solicitante">
                        </div>
                        <div class="form-group">
                            <label for="">Suplente</label>
                            <input readonly required value="{{$data->suplente}}"  type="text" class="form-control" name="suplente" id="suplente" placeholder="Nombre del Suplente">
                        </div>
                        <div class="form-group">
                            <label for="">Estado</label><br>
                            @if($data->aprobado == 0)
                                <button type="button" class="btn-primary btn-sm"> En Espera </button>
                            @else
                                @if($data->aprobado == 1)
                                    <button type="button" class="btn-success btn-sm"> Aceptada </button>
                                @else
                                    <button type="button" class="btn-danger btn-sm"> Rechazada </button>
                                @endif
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Observaciones</label>
                            <textarea readonly type="text" class="form-control" name="observacion" id="observacion" placeholder="Observaciones" >{{$data->observaciones}}</textarea>
                        </div>
                        <!--div class="form-group">
                            <label for="">Agrega Imagenes de Respaldo</label>
                            <input accept="image/*" type="file" class="-file-photo-o" name="imagen" id="imagen">
                        </div-->
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
    </script>
@endsection