<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('favicon.svg') }}" />
  <title>{{ config('app.name', 'Laravel') }}</title>

  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript"
    src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
</head>

<body>
  <header>
    <div>
      <h4>📰[<b>AKTRIS</b>]</h4>
    </div>
    <div>Aplikasi Katalog Berita Statistik</div>
  </header>
  <main class="container">
    <table class="table" id="datatable">
      <thead>
        <tr>
          <th>Sumber</th>
          <th>Tanggal</th>
          <th>Link</th>
          <th>Judul</th>
          <th>Tag</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>
  </main>
  <footer><b>
      <script>
      document.write(new Date().getFullYear())
      </script> © Made by <a href="https://github.com/blankon123/"> blankon123 </a> with 💔
  </footer>
  </b>
</body>

<style>
  body{
    background-color: rgb(239, 250, 255);
    color: #636b6f;
    font-weight: 200;
  }
  main{
    padding:2%;
    border-radius: 2%;
    background-color: white;
    -webkit-box-shadow: 0px 0px 30px 15px rgba(0,0,0,0.15);
    -moz-box-shadow: 0px 0px 30px 15px rgba(0,0,0,0.15);
    box-shadow: 0px 0px 30px 15px rgba(0,0,0,0.15);
  }
header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  text-align: center;
  margin-bottom: 5%;
  padding: 10px;
  -webkit-box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.25);
  box-shadow: 0px 4px 5px 0px rgba(0, 0, 0, 0.25);
}

h4 b {
  color: cornflowerblue;
}

footer {
  text-align: center;
  margin-top: 5%;
  padding: 10px;
  -webkit-box-shadow: 0px -4px 5px 0px rgba(0, 0, 0, 0.25);
  -moz-box-shadow: 0px -4px 5px 0px rgba(0, 0, 0, 0.25);
  box-shadow: 0px -4px 5px 0px rgba(0, 0, 0, 0.25);
}

</style>
<script>
$(document).ready(function() {
  $('#datatable').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "{{ route('api.beritas.index') }}",
    "pageLength": 50,
    "columns": [
      {
        "data": "sumber"
      },
      {
        "data": "tanggal"
      },
      {
        "data": "link"
      },
      {
        "data": "judul"
      },
      {
        "data": "tag"
      }
    ],
    "columnDefs": [
      {
        "render": function(data, type, row) {
          return data.substring(0, 10);
        },
        "targets": 1
      },{
        "type": "html",
        "targets": [4] 
      },{
        "visible": false,
        "targets": [0,2,1]
      }
    ]
  });
});
</script>

</html>