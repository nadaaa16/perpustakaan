<div class="min-height-300 bg-primary position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Perpustakaan</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'pustakawan')
                <li class="menu-header">Dashboard</li>
                <li class="dropdown {{ $active === 'Dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-header">Perpustakaan</li>
                <li class="dropdown {{ $active === 'Buku' ? 'active' : '' }}">
                    <a href="{{ route('buku.index') }}" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>Data Buku</span>
                    </a>
                </li>
                <li class="dropdown {{ $active === 'Kategori' ? 'active' : '' }}">
                    <a href="{{ route('kategori.index') }}" class="nav-link">
                        <i class="fas fa-paperclip"></i>
                        <span>Kategori Buku</span>
                    </a>
                </li>
                <li class="dropdown {{ $active === 'Peminjaman' ? 'active' : '' }}">
                    <a href="{{ route('peminjaman.admin') }}" class="nav-link">
                        <i class="fas fa-paperclip"></i>
                        <span>Data Peminjam</span>
                    </a>
                </li> 
                <li class="menu-header">Pengaturan</li>
                @if (Auth::user()->role === 'admin')
                    <li class="dropdown {{ $active === 'User' ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="fas fa-users"></i>
                            <span>Kelola Pengguna</span>
                        </a>
                    </li>
                @endif
               
                
            @else
                <li class="menu-header">Dashboard</li>
                <li class="dropdown {{ $active === 'Dashboard' ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="fas fa-fire"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="menu-header">Perpustakaan</li>
                <li class="dropdown {{ $active === 'Pustaka' ? 'active' : '' }}">
                    <a href="{{ route('pustaka.index') }}" class="nav-link">
                        <i class="fas fa-book"></i>
                        <span>Pustaka Buku</span>
                    </a>
                </li>
                <li class="dropdown {{ $active === 'Koleksi' ? 'active' : '' }}">
                    <form action="{{ route('koleksi.index') }}" method="GET">
                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                        <a href="{{ route('koleksi.index') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-bookmark"></i>
                            <span>Koleksi Buku</span>
                        </a>
                    </form>
                </li>
                <li class="dropdown {{ $active === 'Peminjaman' ? 'active' : '' }}">
                    <form action="{{ route('peminjaman.index') }}" method="GET">
                        <input type="hidden" name="user" value="{{ Auth::user()->id }}">
                        <a href="{{ route('peminjaman.index') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Buku Yang Dipinjam</span>
                        </a>
                    </form>
                </li>
              
            @endif
      </ul>
    </div>
    {{-- <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
    </div> --}}
  </aside>