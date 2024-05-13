<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat RSI | Login</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    <link rel="stylesheet" href="/css/bootstrap.css">
  </head>
  <body>
    <h2 class="text-center text-success mt-5 fw-bold">Aplikasi Surat</h2>
    <h2 class="text-center text-success fw-bold">RSI Sultan Agung Banjarbaru</h2>

    <div class="card p-4 mt-5 m-auto shadow col-10 col-md-3">
        <img src="/img/logorsi.png" class="card-img-top mb-5" alt="Logo RSI">
        <form method="POST" action="/login">
          @csrf
          <div class="mb-3">
            <input type="text" class="form-control @error('username')
            {{ 'is-invalid' }}
            @enderror " id="username" name="username" placeholder="Username" required>
          </div>
          <div class="mb-3">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="passwordToggle" onclick="myFunction()">
            <label class="form-check-label" for="passwordToggle" >Show Password</label>
          </div>
          <button type="submit" class="btn btn-success container-fluid py-2 fs-5">Login</button>
        </form>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <script src="/js/script.js"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </body>
</html>