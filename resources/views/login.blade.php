<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat RSI | Login</title>
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="icon" type="image/x-icon" href={{ asset("favicon-rsi.png")  }}>
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
    <script src="/js/script.js"></script>
    <script>
      function myFunction() {
        var x = document.getElementById("password");
        if (x.type == "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    </script>
  </body>
</html>