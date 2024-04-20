<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="/css/style.css" />
  </head>

  <body>
    
    <div class="wrapper">
      <aside id="sidebar">
        <div class="d-flex">
          <button class="toggle-btn" type="button">
            <i class="lni lni-grid-alt"></i>
          </button>
          <div class="sidebar-logo">
            <a href="/">Aplikasi Surat</a>
          </div>
        </div>
        <ul class="sidebar-nav">
          
          <li class="sidebar-item
          @if ($active === "dashboard")
              active-tab
          @endif
           ">
            <a href="/" class="sidebar-link">
              <i class="lni lni-dashboard"></i>
              <span>Dashboard</span>
            </a>
          </li>

          {{-- NAVBAR ADMIN --}}

          @can('admin')
              
          <li class="sidebar-item
          @if ($active === "surat masuk")
              active-tab
          @endif
           ">
            <a href="/surat-masuk/index" class="sidebar-link">
              <i class="lni lni-inbox"></i>
              <span>Surat Masuk</span>
            </a>
          </li>
          <li class="sidebar-item
          @if ($active === "surat keluar")
              active-tab
          @endif
           ">
            <a href="/surat-keluar/index" class="sidebar-link">
              <i class="lni lni-upload"></i>
              <span>Surat Keluar</span>
            </a>
          </li>
          <li class="sidebar-item">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target="#multi"
              aria-expanded="false"
              aria-controls="multi"
            >
            <i class="lni lni-book"></i>
              <span>Laporan</span>
            </a>
            <ul
              id="multi"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a
                  href="#"
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#suratmasuk"
                  aria-expanded="false"
                  aria-controls="suratmasuk"
                >
                  Surat Masuk
                </a>
                <ul
                  id="suratmasuk"
                  class="sidebar-dropdown list-unstyled collapse"
                >
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Per Direksi</a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  href="#"
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#suratkeluar"
                  aria-expanded="false"
                  aria-controls="suratkeluar"
                >
                  Surat Keluar
                </a>
                <ul
                  id="suratkeluar"
                  class="sidebar-dropdown list-unstyled collapse"
                >
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Per Jenis Surat</a>
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link">Per Direktorat</a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a
                  href="#"
                  class="sidebar-link collapsed"
                  data-bs-toggle="collapse"
                  data-bs-target="#distribusisurat"
                  aria-expanded="false"
                  aria-controls="distribusisurat"
                >
                  Distribusi Surat
                </a>
                <ul
                  id="distribusisurat"
                  class="sidebar-dropdown list-unstyled collapse"
                >
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                      >Posisi Distribusi Terakhir</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                      >Rekap Posisi Distribusi Terakhir</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                      >Distribusi Surat Sudah Selesai</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="#" class="sidebar-link"
                      >Yang Pernah Didistribusikan</a
                    >
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="sidebar-item @if ($active === "data master")
          active-tab
          @endif
          ">
            <a
              href="#"
              class="sidebar-link collapsed has-dropdown"
              data-bs-toggle="collapse"
              data-bs-target="#auth"
              aria-expanded="false"
              aria-controls="auth"
            >
            <i class="lni lni-database"></i>
              <span>Data Master</span>
            </a>
            <ul
              id="auth"
              class="sidebar-dropdown list-unstyled collapse"
              data-bs-parent="#sidebar"
            >
              <li class="sidebar-item">
                <a href="/direksi/index" class="sidebar-link">Direksi</a>
              </li>
              <li class="sidebar-item">
                <a href="/jenis-surat/index" class="sidebar-link">Jenis Surat</a>
              </li>
              <li class="sidebar-item">
                <a href="#" class="sidebar-link">Tujuan Disposisi</a>
              </li>
            </ul>
          </li>

          @endcan

        </ul>
        <!-- <div class="sidebar-footer">
          <a href="#" class="sidebar-link">
            <i class="lni lni-exit"></i>
            <span>Logout</span>
          </a>
        </div> -->
      </aside>
      <div class="main">
        <nav class="navbar navbar-expand px-4 py-3">
          <div>
            <img src="/img/logorsi.png" width="150" alt="Logo RSI">
          </div>
          <form action="#" class="d-none d-sm-inline-block"></form>
          <div class="navbar-collapse collapse">
            <ul class="navbar-nav ms-auto">
                  <li>
                    <div class="me-5">
                      <h5 class="fw-bold m-auto">{{ Auth::user()->namaJabatan }}</h5>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <form action="/logout" method="post">
                      @csrf
                        <button type="submit" class="btn btn-white container-fluid">Logout</button>
                    </form>
                    {{-- <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                      <img src="account.png" class="avatar img-fluid" alt="" />
                    </a>
                    <div class="dropdown-menu dropdown-menu-end rounded"></div> --}}
                  </li>
            </ul>
          </div>
        </nav>

        <main class="content px-3 py-4">
          <div class="container-fluid">

        @yield('container')

          </div>
        </main>

        {{-- <footer class="footer">
          <div class="container-fluid">
            <div class="row text-body-secondary">
              <div class="col-6 text-start">
                <a class="text-body-secondary" href=" #">
                  <strong>CodzSwod</strong>
                </a>
              </div>
              <div class="col-6 text-end text-body-secondary d-none d-md-block">
                <ul class="list-inline mb-0">
                  <li class="list-inline-item">
                    <a class="text-body-secondary" href="#">Contact</a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-body-secondary" href="#">About Us</a>
                  </li>
                  <li class="list-inline-item">
                    <a class="text-body-secondary" href="#"
                      >Terms & Conditions</a
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </footer> --}}
      </div>
    </div>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script>
    <script src="/js/script.js"></script>
  </body>
</html>
