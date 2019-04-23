<div class="page-sidebar-wrapper col-md-2">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <li class="nav-item open">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-settings"></i>
                    <span class="title">Меню</span>
                    <span class="arrow open"></span>
                </a>
                <ul class="sub-menu" style="display: block;">
                    <li class="nav-item @if (session('menuModule') == 'home') active @endif">
                        <a href="{{ url('/admin/home') }}">
                            <i class="icon-graduation"></i>
                            <span class="title">Училища</span>
                            <span class="badge badge-success"></span>
                        </a>
                    </li>
                    <li class="nav-item @if (session('menuModule') == 'grades') active @endif">
                        <a href="{{ url('/admin/grades') }}">
                            <i class="icon-book-open"></i>
                            <span class="title">Класове</span>
                            <span class="badge badge-default"></span>
                        </a>
                    </li>
                    <li class="nav-item @if (session('menuModule') == 'users') active @endif">
                        <a href="{{ url('/admin/users') }}">
                            <i class="icon-user"></i>
                            <span class="title">Потребители</span>
                            <span class="badge badge-danger"></span>
                        </a>
                    </li>
                    <li class="nav-item @if (session('menuModule') == 'curricula') active @endif">
                        <a href="{{ url('/admin/curricula') }}">
                            <i class="icon-calendar"></i>
                            <span class="title">Програми</span>
                            <span class="badge badge-info"></span>
                        </a>
                    </li>
                    <li class="nav-item @if (session('menuModule') == 'subjects') active @endif">
                        <a href="{{ url('/admin/subjects') }}">
                            <i class="icon-list"></i>
                            <span class="title">Предмети</span>
                            <span class="badge badge-info"></span>
                        </a>
                    </li>
                    <li class="nav-item @if (session('menuModule') == 'absences') active @endif">
                        <a href="{{ url('/admin/absences') }}">
                            <i class="icon-question"></i>
                            <span class="title">Отсъствия</span>
                            <span class="badge badge-info"></span>
                        </a>
                    </li>
                    <li class="nav-item @if (session('menuModule') == 'verify') active @endif">
                        <a href="{{ url('/admin/verify') }}">
                            <i class="icon-check"></i>
                            <span class="title">Потвърди акаунти</span>
                            <span class="badge badge-info"></span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>