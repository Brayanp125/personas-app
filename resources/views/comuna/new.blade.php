<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add comuna</title>
  </head>
  <body>
    <div class="container">
    <h1>Add Comuna</h1>
   <form method="POST" action="{{ route('comunas.store') }}">
    @csrf

    <div class="mb-3">
        <label for="id" class="form-label">Code</label>
        <input type="text" class="form-control" id="id" name="comu_codi" disabled>
        <div id="idHelp" class="form-text">Commune code</div>
    </div>

    <div class="mb-3">
        <label for="comu_nomb" class="form-label">Comuna</label>
        <input type="text" class="form-control" id="comu_nomb" name="comu_nomb" placeholder="Comuna Name" required>
    </div>

    <div class="mb-3">
        <label for="muni_codi" class="form-label">Municipality:</label>
        <select class="form-select" id="muni_codi" name="muni_codi" required>
            <option selected disabled value="">Choose one...</option>
            @foreach ($municipios as $municipio)
                <option value="{{ $municipio->muni_codi }}">{{ $municipio->muni_nomb }}</option>
            @endforeach
        </select>
    </div>

     <div class="mb-3">
        <label for="pais_codi" class="form-label">Pais:</label>
        <select class="form-select" id="pais_codi" name="pais_codi" required>
            <option selected disabled value="">Choose one...</option>
            @foreach ($paises as $pais)
                <option value="{{ $pais->pais_codi }}">{{ $pais->pais_nomb }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('comunas.index') }}" class="btn btn-warning">Cancel</a>
    </div>
</form>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>