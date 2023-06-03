
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SMA 5</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">

    <link rel="stylesheet" href="{{ asset('style/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('style/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="{{ asset('style/assets/scss/style.css') }}">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->
    @include('templates.partials.navbar')

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>
                <div class="col-sm-6">
                    <h5>Data Guru</h5>
                </div>
                @include('templates.partials.header')
            </div>
        </header>
        <div class="content mt-3">
            <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        @if(auth()->user()->role == 'TU')
                            <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal"
                            data-target="#modalcreate"><i class="fa fa-plus-square"></i>&nbsp;
                            Tambah Guru</button>
                        @endif
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>NIP</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>No Telfon</th>
                                    @if(auth()->user()->role == 'TU')
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($guru as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{ $item->nama_guru }}</td>
                                        <td>{{ $item->nip }}</td>
                                        <td>{{ $item->jenis_kelamin }}</td>
                                        <td>{{ $item->alamat }}</td>
                                        <td>{{ $item->no_telefon }}</td>

                                        @if(auth()->user()->role == 'TU')
                                              <form action="{{ url('delete_guru/' . $item->id) }}" method="POST">
                                            <td class="d-flex justify-content-around">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Anda yakin Ingin Menghapus {{ $item->nama_siswa }}')"><i
                                                        style="font-size: 1.5em;"
                                                        class="menu-icon fa fa-trash-o"></i></button>

                                                <a class="btn btn-warning" data-toggle="modal"
                                                    data-target="#editguru{{ $item->id }}"><i
                                                        style="font-size: 1.5em; padding-top: 1.5px;"
                                                        class="menu-icon fa fa-edit"></i></a>

                                                {{-- <a class="btn btn-secondary" data-toggle="modal"
                                                data-target="#detailsiswa{{ $item->id }}"> <i style="font-size: 1.5em;"
                                                        class="menu-icon fa fa-info-circle"></i></a> --}}

                                            </td>
                                        </form>
                                        @endif
                                      
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{-- <div class="pagination ml-5">
                            {{ $guru->links() }}
                        </div> --}}
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal create -->
    <div class="modal fade" id="modalcreate">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title">Tambah Data Guru</h1>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('store_guru') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Guru</label>
                            <input type="text" class="form-control" name="nama_guru">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">NIP</label>
                            <input type="text" class="form-control" name="nip">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Jenis Kelamin</label>
                            <input type="text" class="form-control" name="jenis_kelamin">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">No Telfon</label>
                            <input type="number" class="form-control" name="no_telefon">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    @foreach ($guru as $item)
        <div class="modal fade" id="editguru{{ $item->id }}">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Edit Data Guru</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ url('/update_guru/' . $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">Nama Guru</label>
                              <input type="text" class="form-control" name="nama_guru"
                                  value="{{ $item->nama_guru }}">
                            </div>

                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">NIP</label>
                              <input type="number" class="form-control" name="nip"
                                  value="{{ $item->nip }}">
                            </div>
                            <div class="mb-3">
                                <label for="nama_produk" class="form-label">Jenis Kelamin</label>
                                <input type="text" class="form-control" name="jenis_kelamin"
                                    value="{{ $item->jenis_kelamin }}">
                              </div>
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">Alamat</label>
                              <input type="text" class="form-control" name="alamat"
                                  value="{{ $item->alamat }}">
                            </div>
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">No Telfon</label>
                              <input type="number" class="form-control" name="no_telefon"
                                  value="{{ $item->no_telefon }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
{{-- 
    <!-- Modal edit -->
    @foreach ($guru as $item)
        <div class="modal fade" id="editguru{{ $item->id }}">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Detail Guru</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                   
                </div>
            </div>
        </div>
    @endforeach --}}
        </div>
    </div>
    <!-- Right Panel -->

    <script src="{{ asset('style/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('style/assets/js/main.js') }}"></script>


    <script src="{{ asset('style/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('style/assets/js/lib/data-table/datatables-init.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
        } );
    </script>


</body>
</html>
