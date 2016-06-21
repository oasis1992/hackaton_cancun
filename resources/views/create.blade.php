@extends('contenedor')

@section('content')


<div class="container">
    <div class="alert-info">
        <p>Escriba un # donde quiera que vaya la palabra</p>
    </div>
    <div class="row">
        {!! Form::open(['route' => 'admin.preguntas.store', 'method' => 'POST', 'files'=>'true']) !!}
          <div class="row">

            <div class="input-field col s5">
              <input id="response" name="text" type="text" class="validate">
              <label for="last_name">Frase</label>
            </div>

            <div class="input-field col s5">
                <select id="select-create" name="responses[]" multiple>
                  <option id="1" value="" disabled selected></option>
                  <option id="2" value="afraid">Afraid</option>
                  <option id="3" value="happy">Happy</option>
                  <option id="4" value="angry">Hangry</option>
                  <option id="5" value="disgusted">Disgusted</option>
                  <option id="6" value="sad">Sad</option>
                </select>
                <label>Selecciona un estado de animo</label>
            </div>


            <div class="input-field col s2">
              <button class="btn waves-effect waves-light blue" type="submit" name="action">Agregar
              </button>
            </div>

          </div>

        <div class="div-aux">
            <input type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />
            <label for="filled-in-box">Filled in</label>
        </div>
        {!! Form::close() !!}

    </div>
</div>
@section('js')
    <script>
        $(document).ready(function(){

            $("#select-create").change(function() {
                var options = $( "#select-create" ).val();
                $(".div-aux").empty();
                for(var i = 0; i < options.length;  i++ ){
                    if(options[i] != undefined){

                        //$(".div-aux").html(<input" "type="checkbox" class="filled-in" id="filled-in-box" checked="checked" />");
                        // limpiar el div
                        // poner inputs
                    }
                }
            });
        });
    </script>

@endsection
@endsection 