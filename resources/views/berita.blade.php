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
  <main class="container">
    <div class="row">
      <div class="col-12 col-sm-6 my-auto searchPanel">
        <h1 style="margin-bottom: 0;">📰[<b>AKTRIS</b>]</h1>
        <div style="margin-bottom: 3%;">Aplikasi Katalog Berita Statistik</div>
        <input type="text" name="searchKey" class="form-control form-control-lg" id="searchKey" placeholder="🔎Cari berita disini...">
        {{-- <div class="searchDate input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="">Tanggal</span>
          </div>
          <input type="date" class="form-control" placeholder="mulai dari">
          <input type="date" class="form-control" placeholder="hingga">
        </div>
        <div class="advancedSearchAnchor">Pencarian Lewat Tanggal</div> --}}
      </div>
      <div class="col-12 col-sm-6 tablePanel">
        <table class="table table-striped" id="datatable">
          <thead>
            <tr>
              <th>Sumber</th>
              <th>Tanggal</th>
              <th>Link</th>
              <th>Daftar Berita</th>
              <th>Tag</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      
    </div>
    
  </main>
  <footer><b>
      <script>
      document.write(new Date().getFullYear())
      </script> © Made by <a href="https://github.com/blankon123/"> blankon123 </a> with 💔
  </footer>
  </b>
</body>

<style>
  body::-webkit-scrollbar {
    width: 5px;               /* width of the entire scrollbar */
  }
  body::-webkit-scrollbar-track {
    background: rgba(0, 0, 0, 0);        /* color of the tracking area */
  }
  body::-webkit-scrollbar-thumb {
    background-color: rgb(56, 181, 219);    /* color of the scroll thumb */
    border-radius: 20px;       /* roundness of the scroll thumb */
  }
  .container{
    margin-top: 5%;
    background: rgb(255,255,255);
  }
  .searchPanel{
    text-align: center;
  }

  #searchKey::placeholder{
    filter: grayscale(1);
  }

  #searchKey{
    margin-bottom: 1%;
  }

  .tablePanel{
    border-left: 1px solid rgba(0, 0, 0, 0.25);
  }

  .advancedSearchAnchor{
    text-align: right;
    cursor: pointer;
    transition: all ease 0.2s;
  }
  .advancedSearchAnchor:hover{
    color: black;
    font-weight: 400;
  }
  body{
    background-color: rgb(216, 255, 252);
    color: #636b6f;
    font-weight: 200;
  }
  main{
    padding:2%;
    background-color: white;
    -webkit-box-shadow: 0px 0px 30px 15px rgba(0,0,0,0.15);
    -moz-box-shadow: 0px 0px 30px 15px rgba(0,0,0,0.15);
    box-shadow: 0px 0px 30px 15px rgba(0,0,0,0.15);
  }

h1 b {
  color: #3dcaf2;
}

footer {
  margin:0;
  background-color: whitesmoke;
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
    "pagingType": 'simple',
    "ordering": false,
    "sDom":"tipr",
    "lengthChange": false,
    "ajax": "{{ route('api.beritas.index') }}",
    "pageLength": 5,
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
        "targets": [0,1,2,4]
      }
    ]
  });

  tabel = $('#datatable').DataTable();
  $('#searchKey').keyup(function(){
      tabel.search($(this).val()).draw() ;
  });
});
</script>

</html>