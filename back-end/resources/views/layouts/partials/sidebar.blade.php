<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="{{ request()->routeIs('appointment*') ? 'active' : '' }}">
                    <a href="{{ route('appointment.index') }}"><i class="fe fe-layout"></i> <span>Cuộc hẹn</span></a>
                </li>
                <li class="submenu">
                    <a href="#">
                        <svg width="22px" height="22px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="#ffffff"> <path d="M6.834.33a2.25 2.25 0 012.332 0l5.25 3.182A2.25 2.25 0 0115.5 5.436V6A.75.75 0 0114 6v-.564a.75.75 0 00-.361-.642l-5.25-3.181a.75.75 0 00-.778 0l-5.25 3.181A.75.75 0 002 5.436v5.128a.75.75 0 00.361.642l4.028 2.44a.75.75 0 11-.778 1.283l-4.027-2.44A2.25 2.25 0 01.5 10.563V5.436a2.25 2.25 0 011.084-1.924L6.834.33z"></path> <path fill-rule="evenodd" d="M11.749 7.325l.001-.042v-.286a.75.75 0 00-1.5 0v.286l.001.042a3.73 3.73 0 00-1.318.546.76.76 0 00-.03-.03l-.201-.203a.75.75 0 00-1.06 1.06l.201.203.03.028c-.26.394-.45.84-.547 1.319a.878.878 0 00-.04-.001H7a.75.75 0 000 1.5h.286l.038-.001c.097.48.286.926.547 1.32a.71.71 0 00-.028.027l-.202.202a.75.75 0 001.06 1.06l.203-.202a.695.695 0 00.025-.026c.395.261.842.45 1.322.548l-.001.036v.286a.75.75 0 001.5 0v-.286-.036c.48-.097.926-.287 1.32-.548l.026.026.202.203a.75.75 0 001.06-1.061l-.201-.202a.667.667 0 00-.028-.026c.261-.395.45-.842.547-1.321H15a.75.75 0 000-1.5h-.286l-.04.002a3.734 3.734 0 00-.547-1.319l.03-.028.202-.202a.75.75 0 00-1.06-1.061l-.203.202-.029.03a3.73 3.73 0 00-1.318-.545zM11 8.75A2.247 2.247 0 008.75 11 2.247 2.247 0 0011 13.25 2.247 2.247 0 0013.25 11 2.247 2.247 0 0011 8.75z" clip-rule="evenodd"></path> </g> </g></svg>
                        <span> Dịch vụ</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('service-categories.*') ? 'active' : '' }}" href="{{ route('service-categories.index') }}">Danh mục dịch vụ</a></li>
                        <li><a class="{{ request()->routeIs('service.*') ? 'active' : '' }}" href="{{ route('service.index') }}">Dịch vụ</a></li>
                    </ul>
                </li>
                <li>
                    <a href="specialities.html"><i class="fe fe-users"></i> <span>Specialities</span></a>
                </li>
                <li>
                    <a href="doctor-list.html"><i class="fe fe-user-plus"></i> <span>Doctors</span></a>
                </li>
                <li>
                    <a href="patient-list.html"><i class="fe fe-user"></i> <span>Patients</span></a>
                </li>
                <li>
                    <a href="{{ route('reviews.index') }}"><i class="fe fe-star-o"></i> <span>Đánh giá</span></a>
                </li>
                @if(1==2)
                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-star-o"></i>
                        <span> Đánh giá</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('service-categories.*') ? 'active' : '' }}" href="{{ route('service-categories.index') }}">Danh mục dịch vụ</a></li>
                        <li><a class="{{ request()->routeIs('service.*') ? 'active' : '' }}" href="{{ route('service.index') }}">Dịch vụ</a></li>
                    </ul>
                </li>
                @endif
                <li>
                    <a href="transactions-list.html"><i class="fe fe-activity"></i> <span>Transactions</span></a>
                </li>
                <li>
                    <a href="settings.html"><i class="fe fe-vector"></i> <span>Settings</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span> Reports</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="invoice-report.html">Invoice Reports</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Pages</span>
                </li>
                @role('Admin')
                <li class="submenu">
                    <a href="#"><i class="fe fe-user-plus"></i> <span> Tài khoản </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}" href="{{ route('doctors.index') }}"> Doctor </a></li>
                        <li><a class="{{ request()->routeIs('people-account.*') ? 'active' : '' }}" href="{{ route('people-account.index') }}"> People </a></li>
                        <li><a class="{{ request()->routeIs('role.*') ? 'active' : '' }}" href="{{route('role.index')}}"> Role </a></li>
                        <li><a class="{{ request()->routeIs('permission.*') ? 'active' : '' }}" href="{{route('permission.index')}}"> Permission </a></li>
                    </ul>
                </li>
                @endrole
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="login.html"> Login </a></li>
                        <li><a href="register.html"> Register </a></li>
                        <li><a href="forgot-password.html"> Forgot Password </a></li>
                        <li><a href="lock-screen.html"> Lock Screen </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-warning"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="error-404.html">404 Error </a></li>
                        <li><a href="error-500.html">500 Error </a></li>
                    </ul>
                </li>
                <li>
                    <a href="blank-page.html"><i class="fe fe-file"></i> <span>Blank Page</span></a>
                </li>
                <li class="menu-title">
                    <span>UI Interface</span>
                </li>
                <li>
                    <a href="components.html"><i class="fe fe-vector"></i> <span>Components</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-layout"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="form-basic-inputs.html">Basic Inputs </a></li>
                        <li><a href="form-input-groups.html">Input Groups </a></li>
                        <li><a href="form-horizontal.html">Horizontal Form </a></li>
                        <li><a href="form-vertical.html"> Vertical Form </a></li>
                        <li><a href="form-mask.html"> Form Mask </a></li>
                        <li><a href="form-validation.html"> Form Validation </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="tables-basic.html">Basic Tables </a></li>
                        <li><a href="data-tables.html">Data Table </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="javascript:void(0);"><i class="fe fe-code"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li class="submenu">
                            <a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
                            <ul style="display: none;">
                                <li><a href="javascript:void(0);"><span>Level 2</span></a></li>
                                <li class="submenu">
                                    <a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
                                    <ul style="display: none;">
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                        <li><a href="javascript:void(0);">Level 3</a></li>
                                    </ul>
                                </li>
                                <li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);"> <span>Level 1</span></a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
