@extends('contenedor')

@section('content')


<div class="container">

<div class="row">
    <form class="col s12">
      <div class="row">
        
        <div class="input-field col s5">
          <input id="last_name" type="text" class="validate">
          <label for="last_name">Frase</label>
        </div>

        <div class="input-field col s5">
          <select multiple>
      <option value="" disabled selected></option>
      <option value="1">Frase  1</option>
      <option value="2">frase  2</option>
      <option value="3">Frase  3</option>
    </select>
    <label>Selecciona un estado de animo</label>
        </div>

        <div class="input-field col s2">
          <button class="btn waves-effect waves-light blue" type="submit" name="action">Agregar
          </button>
        </div>

      </div>
      

    </form>

</div>

</div>


<!-- -->
<div class="container">
      <table  class="striped">
        <thead>
          <tr>
              <th data-field="id">Name</th>
              <th data-field="name">Item Name</th>
              <th data-field="price">Item Price</th>
              <th data-field="acciones">Acciones</th>
          </tr>
        </thead>

        <tbody>
          <tr>
            <td>Alvin</td>
            <td>Eclair</td>
            <td>$0.87</td>
            <td><a class="btn waves-effect waves-light red">Eliminar</a></td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
            <td><a class="btn waves-effect waves-light red">Eliminar</a></td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>
            <td>
              <a class="btn waves-effect waves-light red">Eliminar</a>
            </td>
          </tr>
        </tbody>
      </table>

    </div>

@endsection 