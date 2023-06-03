
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
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                </div>
                <div class="col-sm-6">
                    <h5>Data Siswa</h5>
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
                                <button type="button" data-toggle="modal" data-target="#modalcreate" class="btn btn-primary btn-sm rounded"><i class="fa fa-plus-square"></i>&nbsp; Tambah Siswa</button>
                            </div>
                        @endif
                            <div class="card-body">
                              <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                <thead>
                                  <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>NIS</th>
                                    <th>Jurusan</th>
                                    @if(auth()->user()->role == 'TU')
                                    <th>Action</th>
                                    @endif
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswa as $siswas)
                                      <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$siswas->nama_siswa}}</td>
                                        <td>{{$siswas->nis}}</td>
                                        <td>{{$siswas->jurusan}}</td>
                                        @if(auth()->user()->role == 'TU')
                                        <form action="{{ url('delete_siswa/' . $siswas->id) }}" method="POST">
                                            <td class="d-flex justify-content-around">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger rounded"
                                                    onclick="return confirm('Anda yakin Ingin Menghapus {{ $siswas->nama_siswa }}')"><i
                                                        style="font-size: 1.5em;"
                                                        class="menu-icon fa fa-trash-o"></i></button>
                                                <a class="btn btn-warning rounded" data-toggle="modal"
                                                    data-target="#editsiswa{{ $siswas->id }}"><i
                                                        style="font-size: 1.5em; padding-top: 1.5px;"
                                                        class="menu-icon fa fa-edit"></i></a>

                                                <a class="btn btn-secondary rounded" data-toggle="modal"
                                                data-target="#detailsiswa{{ $siswas->id }}"> <i style="font-size: 1.5em;" class="menu-icon fa fa-info-circle"></i></a>
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
            </div>
        </div>


        <!-- Modal create -->
    <div class="modal fade" id="modalcreate">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h1 class="modal-title">Tambah Data Siswa</h1>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ url('store_siswa') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">NIS</label>
                            <input type="number" class="form-control" name="nis">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nama Kelas</label>
                            <select class="form-control select2" style="width: 100%;" name="id_kelas" id="id_kelas">

                                <option selected disabled value>-- Pilih Kelas --</option>
                                @foreach ($kelas as $kel)
                                    <option value="{{ $kel->id }}">{{ $kel->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama_siswa">
                        </div>
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan :</label>
                            <select name="jurusan" class="form-control select2" style="width: 100%;" id="jurusan" required>
                                <option selected disabled value="">--Pilih Jurusan--</option>
                                <option value="IPA">IPA</option>
                                <option value="IPS">IPS</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama :</label>
                            <select name="agama" class="form-control select2" style="width: 100%;" id="agama" required>
                                <option selected disabled value="">--Pilih Agama--</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tgl_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin :</label>
                            <select name="jenis_kelamin" class="form-control select2" style="width: 100%;" id="jenis_kelamin" required>
                                <option selected disabled value="">--Jenis Kelamin--</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_produk" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal edit -->
    @foreach ($siswa as $item)
        <div class="modal fade" id="editsiswa{{ $item->id }}">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Edit Data Siswa</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{ url('/update_siswa/' . $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">NIS</label>
                              <input type="number" class="form-control" name="nis"
                                  value="{{ $item->nis }}">
                            </div>

                            <div class="form-group">
                              <label class="form-label">Kelas</label>
                              <select class="form-control select2" style="width: 100%;" name="id_kelas" id="id_kelas">
                                  <option value>-- Pilih kelas --</option>
                                  @foreach ($kelas as $kel)
                                      <option value="{{ $kel->id }}">{{ $kel->nama_kelas }}</option>
                                  @endforeach
                              </select>
                            </div>

                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">Nama Siswa</label>
                              <input type="text" class="form-control" name="nama_siswa"
                                  value="{{ $item->nama_siswa }}">
                            </div>
                            {{-- <option value="Islam" {{$pemilikTanah->agama === 'Islam' ? 'selected' : '' }}>Islam</option> --}}

                            <div class="mb-3">
                                <label for="jurusan" class="form-label">Jurusan :</label>
                                <select name="jurusan" class="form-control select2" style="width: 100%;" id="jurusan" required>
                                    <option value="IPA" {{$item->jurusan === 'IPA' ? 'selected' : ''}}>IPA</option>
                                    <option value="IPS" {{$item->jurusan === 'IPS' ? 'selected' : ''}}>IPS</option>
                                </select>
                            </div>
                            <div class="mb-3">
                            <label for="agama" class="col-form-label">Agama :</label>
                                <select name="agama" class="form-control select2" style="width: 100%;" id="agama" required>
                                    <option selected disabled value="">Pilih Agama</option>
                                    <option value="islam" {{$item->agama === 'islam' ? 'selected' : '' }}>islam</option>
                                    <option value="kristen" {{$item->agama === 'kristen' ? 'selected' : '' }}>kristen</option>
                                    <option value="hindu" {{$item->agama === 'hindu' ? 'selected' : '' }}>hindu</option>
                                    <option value="budha" {{$item->agama === 'budha' ? 'selected' : '' }}>budha</option>
                                    <option value="konghucu" {{$item->agama === 'konghucu' ? 'selected' : '' }}>konghucu</option>
                                </select>
                            </div>
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">Tempat Lahir</label>
                              <input type="text" class="form-control" name="tempat_lahir"
                                  value="{{ $item->tempat_lahir }}">
                            </div>
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">Tanggal Lahir</label>
                              <input type="date" class="form-control" name="tgl_lahir"
                                  value="{{ $item->tgl_lahir }}">
                            </div>
                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin :</label>
                                <select name="jenis_kelamin" class="form-control select2" style="width: 100%;" id="jenis_kelamin" required>
                                    <option value="laki-laki" {{$item->jenis_kelamin === 'laki-laki' ? 'selected' : ''}}>laki-laki</option>
                                    <option value="perempuan" {{$item->jenis_kelamin === 'perempuan' ? 'selected' : ''}}>perempuan</option>
                                </select>
                            </div>
                            <div class="mb-3">
                              <label for="nama_produk" class="form-label">Alamat</label>
                              <input type="text" class="form-control" name="alamat"
                                  value="{{ $item->alamat }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Detail -->
    @foreach ($siswa as $item)
        <div class="modal fade" id="detailsiswa{{ $item->id }}">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h1 class="modal-title">Detail Siswa</h1>
                        <button type="button" class="close" data-dismiss="modal">×</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body mb-5">
                        <h5>Nama : {{ $item->nama_siswa }}</h5>
                        <br>
                        <h5>NIS : {{ $item->nis }}</h5>
                        <br>
                        <h5>Kelas : {{ $item->Kelas->nama_kelas }}</h5>
                        <br>
                        <h5>Jurusan : {{ $item->jurusan }}</h5>
                        <br>
                        <h5>Agama : {{ $item->agama }}</h5>
                        <br>
                        <h5>Tempat Lahir : {{ $item->tempat_lahir }}</h5>
                        <br>
                        <h5>Tanggal Lahir : {{ $item->tgl_lahir }}</h5>
                        <br>
                        <h5>Jenis Kelamin : {{ $item->jenis_kelamin }}</h5>
                        <br>
                        <h5>Alamat : {{ $item->alamat }}</h5>
                        
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
