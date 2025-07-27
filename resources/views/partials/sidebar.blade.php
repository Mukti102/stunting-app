<div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
          <div id="sidebar-menu" class="sidebar-menu">
            <ul>
              <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}"
                  ><img src="{{ asset('assets/img/icons/dashboard.svg')}}" alt="img" /><span>
                    Dashboard</span
                  >
                </a>
              </li>
              <li class="{{ request()->is('desa*') ? 'active' : '' }}">
                <a href="{{ route('desa.index') }}"
                  ><img src="{{ asset('assets/img/icons/dashboard.svg')}}" alt="img" /><span>
                    Desa</span
                  >
                </a>
              </li>
              <li class="{{ request()->is('balita*') ? 'active' : '' }}">
                <a href="{{ route('balita.index') }}"
                  ><img src="{{ asset('assets/img/icons/users1.svg')}}" alt="img" /><span>
                    Data Balita</span
                  >
                </a>
              </li>
              <li class="{{ request()->is('pemeriksaan*') ? 'active' : '' }}">
                <a href="{{ route('pemeriksaan.index') }}"
                  ><img src="{{ asset('assets/img/icons/users1.svg')}}" alt="img" /><span>
                    Data Pemeriksaan</span
                  >
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>