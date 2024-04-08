<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat RSI | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1 class="text-center text-success mt-5 fw-bold">Aplikasi Surat</h1>
    <h1 class="text-center text-success fw-bold">RSI Sultan Agung Banjarbaru</h1>

    <div class="card p-4 mt-5 shadow m-auto" style="width: 400px;">
        <img src="/img/logorsi.png" class="card-img-top mb-5" alt="Logo RSI">
        <form method="POST" action="/login">
          @csrf
          <div class="mb-3">
            <input type="text" class="form-control form-control-lg @error('username')
            {{ 'is-invalid' }}
            @enderror " id="username" name="username" placeholder="Username" required>
          </div>
          <div class="mb-3">
            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
          </div>
          <button type="submit" class="btn btn-success container-fluid py-2 fs-5">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>