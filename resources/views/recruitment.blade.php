<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPKUM Jakarta - Recruitment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center mt-5">DINAS PPUKM</h1>
    <div id="login">
        <h3 class="text-center pt-5">Recruitment form</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="{{ route('recruitment.store') }}" method="post">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <p class="alert alert-danger">{{ Session::get('error') }}</p>
                            @endif
                            @if(Session::has('success'))
                                <p class="alert alert-success">{{ Session::get('success') }}</p>
                            @endif
                            <div class="form-group">
                                <label for="username" class="text-dark">Nama Pengumuman:</label><br>
                                <input type="text" name="nm_pengumuman" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Kuota:</label><br>
                                <input type="number" name="kuota" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Tanggal Batas Pendaftaran:</label><br>
                                <input type="date" name="tanggal_batas_pendaftaran" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-dark">Penyelenggara:</label><br>
                                <textarea class="form-control" name="penyelenggara"></textarea>
                            </div>

                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-info btn-md mt-3" value="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>