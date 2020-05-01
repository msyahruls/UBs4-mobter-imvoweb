<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand" style="margin-bottom: 20px;">
      <img src="{{asset('assets/img/sidebar-header.png')}}" width="250" height="80">
    </div>
    <div class="sidebar-brand sidebar-brand-sm" style="margin-bottom: 10px;">
      <img src="{{asset('assets/img/logo/imvo-no-txt.png')}}" width="50" height="70">
    </div>
    <ul class="sidebar-menu">
        <li class="">
          <a class="nav-link" title="Dashboard" href="{{ route('dashboard.index') }}"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a>
          @if(auth()->user())
            <a class="nav-link" title="Jurusan" href="{{ route('jurusan.index') }}"><i class="fas fa-book-reader"></i> <span>Jurusan</span></a>
            <a class="nav-link" title="Perusahaan" href="{{ route('perusahaan.index') }}"><i class="fas fa-building"></i> <span>Perusahaan</span></a>
            <a class="nav-link" title="Ulasan" href="{{ route('ulasan.index') }}"><i class="fas fa-comment-alt"></i> <span>Ulasan</span></a>
            <a class="nav-link" title="Berita" href="{{ route('berita.index') }}"><i class="fas fa-newspaper"></i><span>Berita</span></a>
          @endif
        </li>
    </ul>
  </aside>  
</div>