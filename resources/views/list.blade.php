@extends('contenedor')

@section('content')

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
            <td><a class="btn waves-effect waves-light red "  href="#modal1" >Eliminar</a></td>
          </tr>
          <tr>
            <td>Alan</td>
            <td>Jellybean</td>
            <td>$3.76</td>
            <td><a class="btn waves-effect waves-light red" href="#modal1" >Eliminar</a></td>
          </tr>
          <tr>
            <td>Jonathan</td>
            <td>Lollipop</td>
            <td>$7.00</td>
            <td>
              <a class="btn waves-effect waves-light red" href="#modal1" >Eliminar</a>
            </td>
          </tr>
        </tbody>
      </table>

    </div>

 @endsection   