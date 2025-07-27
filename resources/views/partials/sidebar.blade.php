<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->is('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/img/icons/dashboard.svg') }}"
                            alt="img" /><span>
                            Dashboard</span>
                    </a>
                </li>
                <li class="{{ request()->is('desa*') ? 'active' : '' }}">
                    <a href="{{ route('desa.index') }}">
                        <i class="fa fa-road"></i>
                        <span>
                            Desa</span>
                    </a>
                </li>
                <li class="{{ request()->is('reference*') ? 'active' : '' }}">
                    <a href="{{ route('reference.index') }}">
                        <i class="fa  fa-server"></i>
                        <span>
                            Data WHO</span>
                    </a>
                </li>
                <li class="{{ request()->is('balita*') ? 'active' : '' }}">
                    <a href="{{ route('balita.index') }}">
                        <i class="fa fa-users"></i>
                        <span>
                            Data Balita</span>
                    </a>
                </li>
                <li class="{{ request()->is('pemeriksaan*') ? 'active' : '' }}">
                    <a href="{{ route('pemeriksaan.index') }}">
                        <i class="fa fa-thermometer-half"></i><span>
                            Data Pemeriksaan</span>
                    </a>
                </li>
                <li class="{{ request()->is('normal-child*') ? 'active' : '' }}">
                    <a href="{{ route('normal.child') }}">
                        <i class="fa fa-user-plus"></i>
                        <span>
                            Data Balita Normal</span>
                    </a>
                </li>
                <li class="{{ request()->is('tidak-normal-child*') ? 'active' : '' }}">
                    <a href="{{ route('!normal.child') }}">
                        <i class="fa fa-user-times"></i>

                        <span>
                            Data Balita Non Normal</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
