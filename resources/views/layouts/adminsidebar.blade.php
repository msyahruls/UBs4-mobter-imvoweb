      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">{{ config('app.name', 'Laravel') }}</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">S.in</a>
          </div>
          <ul class="sidebar-menu">
              <li class="">
                <a class="nav-link" href="{{-- route('dashboard') --}}"><i class="fas fa-square"></i> <span>Dashboard</span></a>
                @if(auth()->user())
                  <a class="nav-link" href="{{ route('jurusan.index') }}"><i class="far fa-square"></i> <span>Jurusan</span></a>
                  <a class="nav-link" href="{{ route('perusahaan.index') }}"><i class="far fa-square"></i> <span>Perusahaan</span></a>
                @endif
              </li>
          </ul>
        </aside>
      </div>