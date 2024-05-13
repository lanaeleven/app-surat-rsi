<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    {{-- <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome-free-6.5.2-web/css/all.min.css') }}">
    {{-- <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
    {{-- <link rel="stylesheet" href="/css/bootstrap.css" /> --}}
    <link rel="stylesheet" href="/css/style.css" />
    <link rel="stylesheet" href="/css/bootstrap.css">
    
  </head>

  <body class="d-flex flex-column min-vh-100">
    
    <div class="wrapper">
      @can('dashboard-sekre')
      <aside id="sidebar" class="d-none d-md-block d-lg-block d-xl-block d-xxl-block">
        <div class="d-flex">
          <button class="toggle-btn" type="button">
            {{-- <i class="lni lni-grid-alt"></i> --}}
            <i class="fa-solid fa-hospital" style="color: #ffffff;"></i>
          </button>
          <div class="sidebar-logo">
            <a href="/" style="text-decoration: none;">Aplikasi Surat</a>
          </div>
        </div>
        <ul class="sidebar-nav">
          
          <li class="sidebar-item
          @if ($active === "dashboard")
              active-tab
          @endif
           ">
            <a href="/" class="sidebar-link">
              {{-- <i class="lni lni-dashboard"></i> --}}
              <i class="fa-solid fa-house" style="color: #ffffff;"></i>
              <span>Dashboard</span>
            </a>
          </li>

          {{-- NAVBAR ADMIN --}}       
              
          <li class="sidebar-item
          @if ($active === "surat masuk")
              active-tab
          @endif
           ">
            <a href="/surat-masuk/index" class="sidebar-link">
              {{-- <i class="lni lni-inbox"></i> --}}
              <i class="fa-solid fa-folder-closed" style="color: #ffffff;"></i>
              <span>Surat Masuk</span>
            </a>
          </li>
          <li class="sidebar-item
          @if ($active === "surat keluar")
              active-tab
          @endif
           ">
            <a href="/surat-keluar/index" class="sidebar-link">
              {{-- <i class="lni lni-upload"></i> --}}
              <i class="fa-solid fa-paper-plane" style="color: #ffffff;"></i>
              <span>Surat Keluar</span>
            </a>
          </li>
          <li class="sidebar-item
          @if ($active === "spo")
              active-tab
          @endif
           ">
            <a href="/spo/index" class="sidebar-link">
              {{-- <i class="lni lni-upload"></i> --}}
              <i class="fa-solid fa-briefcase" style="color: #ffffff;"></i>
              <span>SPO</span>
            </a>
          </li>
          <li class="sidebar-item
          @if ($active === "laporan")
              active-tab
          @endif">
            <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#multi" aria-expanded="false" aria-controls="multi"
            >
            {{-- <i class="lni lni-book"></i> --}}
            <i class="fa-solid fa-file-lines" style="color: #ffffff;"></i>
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
                  data-bs-parent="#multi"
                >
                  <li class="sidebar-item">
                    <a href="/laporan/surat-masuk/per-direksi" class="sidebar-link">Per Direksi</a>
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
                    <a href="/laporan/surat-keluar/per-jenis-surat" class="sidebar-link">Per Jenis Surat</a>
                  </li>
                  <li class="sidebar-item">
                    <a href="/laporan/surat-keluar/per-direksi" class="sidebar-link">Per Direktorat</a>
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
                    <a href="/laporan/distribusi-surat/posisi-terakhir" class="sidebar-link"
                      >Posisi Distribusi Terakhir</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/laporan/distribusi-surat/rekap/per-tujuan" class="sidebar-link"
                      >Rekap Posisi Distribusi Terakhir</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/laporan/distribusi-surat/sudah-selesai" class="sidebar-link"
                      >Distribusi Surat Sudah Selesai</a
                    >
                  </li>
                  <li class="sidebar-item">
                    <a href="/laporan/distribusi-surat/pernah-distribusi" class="sidebar-link"
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
            {{-- <i class="lni lni-database"></i> --}}
            <i class="fa-solid fa-database" style="color: #ffffff;"></i>
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
                <a href="/user/index" class="sidebar-link">Tujuan Disposisi</a>
              </li>
            </ul>
          </li>
        </ul>
      </aside>
      @endcan

      <div class="main">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid mx-3">
            <a class="navbar-brand" href="#"><img src="/img/logorsi.png" width="150" alt="Logo RSI"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              @can('dashboard-sekre')
              <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-md-none d-lg-none d-xl-none d-xxl-none">
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "dashboard")
                      fw-bold
                  @endif
                   " href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "surat masuk")
                      fw-bold
                  @endif
                   " href="/surat-masuk/index">Surat Masuk</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "surat keluar")
                      fw-bold
                  @endif
                   " href="/surat-keluar/index">Surat Keluar</a>
                </li>
              </ul>

              <ul class="navbar-nav me-auto mb-2 mb-lg-0 d-none d-md-block d-lg-block d-xl-block d-xxl-block">
                <li class="nav-item">
                </li>
              </ul>
              @endcan

              @can('dashboard-not-sekre')
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "dashboard")
                      fw-bold
                  @endif
                   " href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "belum diteruskan")
                      fw-bold
                  @endif
                   " href="/surat-masuk/ns/belum-diteruskan">Belum Diteruskan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "sudah diteruskan")
                      fw-bold
                  @endif
                   " href="/surat-masuk/ns/sudah-diteruskan">Sudah Diteruskan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-center fs-6
                  @if ($active === "akun")
                      fw-bold
                  @endif
                   " href="/user/akun-ns">Akun</a>
                </li>
              </ul>
              @endcan
              
              <span class="me-5 d-none d-md-block">{{ auth()->user()->namaJabatan }}</span>
              
              <form action="/logout" method="post">
                @csrf
                  <button type="button" class="btn btn-danger container-fluid btn-sm" data-bs-toggle="modal" data-bs-target="#modalLogout">Logout</button>

                  <!-- Modal Tombol Logout -->
                <div class="modal fade" data-bs-backdrop="static" id="modalLogout" tabindex="-1" aria-labelledby="modalLogoutLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalLogoutLabel">Keluar dari aplikasi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        Anda yakin ingin keluar dari aplikasi?
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Logout</button>
                        </div>
                    </div>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </nav>

        <main class="content px-3 py-4">
          <div class="container-fluid">
            {{-- @dd($active) --}}
        @yield('container')

          </div>
        </main>

        <footer class="bg-body-tertiary text-center text-lg-start mt-auto">
          <!-- Copyright -->
          <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright: IT Dept Banjarbaru
          </div>
          <!-- Copyright -->
        </footer>

      </div>
    </div>
    {{-- <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
      crossorigin="anonymous"
    ></script> --}}
    <script src="/js/bootstrap.js"></script>
    <script src="/js/script.js"></script>
  </body>
</html>
