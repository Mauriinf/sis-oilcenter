<!DOCTYPE html>
<html>
<head>
  <title>Reporte de Ingreso</title>
  <style type="text/css">
    body{
      font-family: sans-serif;
      font-size: 12px;
    }
    @page {
      margin: 10px 10px 10px;
    }
    body {
      margin: 10px 10px 10px;
    }
    .header {
      background-color: #E0E0E0;
      padding: 7px;
      height: 180px; /*o lo necesario*/
    }
    .header::before {
      position: absolute;
      top:-80%;
      bottom: 0px;
      left: 0px;
      right: 0px; 
      background-image: url("img/logs/log_activity.png");
      background-size: 150px;
      background-repeat: no-repeat;
      background-position: center;
      opacity: 0.1;
    }
    footer {
      position: fixed;
      left: 0px;
      bottom: 10px;
      margin: 10px 10px 10px;
      border-bottom: 2px solid #ddd;
    }
    footer .page:after {
      content: counter(page);
    }
    footer table {
      width: 100%;
    }
    footer p {
      text-align: right;
      font-size: 10px;
    }
    footer .izq {
      text-align: left;
    }
    .table {
      width: 100%;
      max-width: 100%;
      min-width: 10%;
      margin-bottom: 1rem;
    }
    .table th,
    .table td {
      padding: 0.75rem;
      vertical-align: top;
      border-top: 1px solid #E0E0E0;
    }

    .table thead th {
      vertical-align: bottom;
      border-bottom: 2px solid #E0E0E0;
    }
    .table tfoot td {
      font-weight: bold;
    }
    .table tbody + tbody {
      border-top: 2px solid #E0E0E0;
    }

    .table .table {
      background-color: #fff;
    }

    .table-sm th,
    .table-sm td {
      padding: 0.3rem;
    }

    .table-bordered {
      border: 1px solid #E0E0E0;
    }

    .table-bordered th,
    .table-bordered td {
      border: 1px solid #E0E0E0;
    }

    .table-bordered thead th,
    .table-bordered thead td {
      border-bottom-width: 2px;
    }
    .p-title-pry {
      font-size: 2rem;
    }
    .p-title {
      font-size: 1.5rem;
    }
    .bg-danger {
      background-color: #FFA18C;
    }
    .text-ver {
      writing-mode: vertical-lr;
      transform: rotate(-90deg);
      padding-bottom: 5px;
      padding-top: 5px;
    }
    .border-top {
      border-color: #889900 1px solid;

    }
    .header-left {
      float:left;
      width: 50%;
      height: 70px;

    }
    .header-right {
      float:left;
      width: 50%;
      height: 70px;
      text-align: right;
    }
    .container {
      font-size: 13px;
      line-height: 5px;
      text-align: center;

    }
    .bg-headtab {
      background: #F0F1F1;
    }
    .table-title {
      padding: 5px;
      background: #F0F0F0;
      font-size: 14px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="header-left" align="left">
      <img src="./landing/assets/images/logo.png" class="img-avatar" width="150px">
    </div>
    <div class="header-right">
      <span>OILCENTER</span><br>
      <span>Zona: Calle: Nro. </span><br>
      <span>Email: </span><br>
      <span>Telf: </span><br>
    </div>
    <div class="container">
      <p style="font-size : 20px;"><b><u>REPORTE DE FRECUENCIA DE CLIENTES</u></b></p>
      <p>OILCENTER</p>
    </div><br>
  </div>
  <footer>
    <p class="page">Página </p>
  </footer>
  <table class="table table-striped table-bordered table-sm" cellspacing="0" id="TablaVenta">
    <thead>
      <tr>
        <th>#</th>
        <th>PATERNO</th>
        <th>MATERNO</th>
        <th>NOMBRES</th>
        <th>CANTIDAD</th>
      </tr>
    </thead>
    <tbody>
      @foreach($cliente as $cli)
      <tr>
        <td>{{$loop->index+1}}</td>
        <td>{{$cli->paterno}}</td>
        <td>{{$cli->materno}}</td>
        <td>{{$cli->nombres}}</td>
        <td>{{$cli->cliente_count.' compras'}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>
</html>