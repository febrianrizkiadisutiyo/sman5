
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
                    <h5>Data Kelas</h5>
                </div>
                @include('templates.partials.header')
            </div>
        </header>
        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        @if(auth()->user()->role == 'TU')
                            <div class="card-header d-flex justify-content-between">
                                <button  type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#modalcreate"><i class="fa fa-plus-square"></i>&nbsp; Tambah Kelas</button>
                            </div>
                        @endif
                            <div class="card-body">
                              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Wali Kelas</th>
                                    @if(auth()->user()->role == 'TU')
                                    <th>Action</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jumlah as $index => $itemKelas)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$kelas[$index]->nama_kelas}}</td>
                                                <td>{{$jumlah[$index]->jumlah_siswa}}</td>
                                                <td>{{$kelas[$index]->Guru->nama_guru}}</td>
                                                @if(auth()->user()->role == 'TU')
                                                    <form action="{{ url('delete_kelas/' . $kelas[$index]->id) }}" method="POST">
                                                    <td class="d-flex justify-content-around">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger rounded"
                                                            onclick="return confirm('Anda yakin Ingin Menghapus {{ $kelas[$index]->nama_kelas }}')"><i
                                                                style="font-size: 1.5em;"
                                                                class="menu-icon fa fa-trash-o"></i></button>

                                                        <a class="btn btn-warning rounded" data-toggle="modal"
                                                            data-target="#editkelas{{ $kelas[$index]->id }}"><i
                                                                style="font-size: 1.5em; padding-top: 1.5px;"
                                                                class="menu-icon fa fa-edit"></i></a>
                                                    </td>

                                                    </form>
                                                @endif
                                            </tr>
                                    @endforeach
                                </tbody>
                              </table>
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
                    <h1 class="modal-title">Tambah Data Kelas</h1>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('store_kelas') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Guru</label>
                            <select class="form-control select2" style="width: 100%;" name="id_guru" id="id_guru">
                                {{-- <option value="{{ $produk->satuanProduk_id }}">{{ $produk->satuanProduk->satuan_produk }}</option> --}}
                                <option disabled value>-- Pilih Wali Kelas --</option>
                                @foreach ($guru as $gur)
                                    <option value="{{ $gur->id }}">{{ $gur->nama_guru }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
        @foreach ($kelas as $item)
            <div class="modal fade" id="editkelas{{ $item->id }}">
                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h1 class="modal-title">Edit Data Kelas</h1>
                            <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form action="{{ url('/update_kelas/' . $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="nama_produk" class="form-label">Nama Kelas</label>
                                    <input type="text" class="form-control" name="nama_kelas" id="nama_kelas"
                                        value="{{ $item->nama_kelas }}">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Wali Kelas</label>
                                    <select class="form-control select2" style="width: 100%;" name="id_guru" id="id_guru">
                                        <option value>-- Pilih Wali kelas --</option>
                                        @foreach ($guru as $gur)
                                            <option value="{{ $gur->id }}">{{ $gur->nama_guru }}</option>
                                        @endforeach
                                        {{-- <option value="{{ $item->id }}">{{ $item->Guru->nama_guru }}</option> --}}
                                        {{-- <p>{{ $item->nama_kelas }}</p> --}}
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
