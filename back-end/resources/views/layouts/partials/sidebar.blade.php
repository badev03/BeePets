<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Bảng điều khiển</span></a>
                </li>

                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-layout"></i>
                        <span> Thống kê</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <a class="{{ request()->routeIs('statistic.index') ? 'active' : '' }}" href="{{ route('statistic.index') }}">
                                {{--                                <i class="fe fe-bar-chart"></i>--}}
                                <span>Thống kê doanh thu</span></a>
                        </li>
                        <li><a class="{{ request()->routeIs('appointments.statistics') ? 'active' : '' }}" href="{{ route('appointments.statistics') }}">Thống kế cuộc hẹn</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-layout"></i>
                        <span> Cuộc hẹn</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs(['appointments.add-appointments', 'create-data.appointments']) ? 'active' : '' }}
                        " href="{{ route('appointments.add-appointments') }}">Thêm cuộc hẹn</a></li>
                        <li><a class="{{ request()->routeIs('appointments.wait-for-confirmation') ? 'active' : '' }}" href="{{ route('appointments.wait-for-confirmation') }}">Lịch chờ xác nhận</a></li>
                        <li>
                            <a href="{{ route('appointment.index') }}" class="{{ request()->routeIs('appointment.*') ? 'active' : '' }}"> <span>Cuộc hẹn</span></a>
                        </li>
                        <li>
                            <a href="{{ route('appointments.history-appointment') }}" class="{{ request()->routeIs('appointments.history-appointment') ? 'active' : '' }}"> <span>Lịch sử cuộc hẹn</span></a>
                        </li>
                        {{--                        <li><a class="{{ request()->routeIs('appointments.statistics') ? 'active' : '' }}" href="{{ route('appointments.statistics') }}">Thống kế cuộc hẹn</a></li>--}}
                        <li><a class="{{ request()->routeIs('appointments.bills-appointment') ? 'active' : '' }}" href="{{ route('appointments.bills-appointment') }}">Hóa đơn cuộc hẹn</a></li>
                    </ul>
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

                @role('Admin')
          
                <li class="submenu">
                    <a href="#">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Bác sĩ</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}" href="{{ route('doctors.index') }}">Danh sách bác sĩ</a></li>
                        <li><a class="{{ request()->routeIs('schedules.*') ? 'active' : '' }}" href="{{ route('schedules.index') }}">Lịch làm việc</a></li>
                    </ul>
                </li>

                @endrole
                <li>
                    <a href="{{ route('reviews.index') }}"><i class="fe fe-star-o"></i> <span>Đánh giá</span></a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}"><i class="fa-brands fa-product-hunt"></i> <span>Sản phẩm</span></a>
                </li>
                <li>
                    <a href="{{ route('purchase.index') }}"><i class="fa-solid fa-cart-shopping"></i><span>Đơn hàng</span></a>
                </li>
                <li class="{{ request()->routeIs('about.*') ? 'active' : '' }}">
                    <a href="{{ route('about.index') }}"><i class="fa-solid fa-address-card"></i> <span>Giới Thiệu</span></a>
                </li>
                <li class="{{ request()->routeIs('setting') ? 'active' : '' }}">
                    <a href="{{ route('setting') }}"><i class="fe fe-vector"></i> <span>Cấu hình</span></a>
                </li>

                @role('Admin')
                <hr class="text-white"/>
                <li>
                    <a href="{{ route('myProfile') }}"><i class="fe fe-user-plus"></i> <span>Hồ sơ</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-user-plus"></i> <span> Tài khoản </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li></li>
                        <li><a class="{{ request()->routeIs('people-account.*') ? 'active' : '' }}" href="{{ route('people-account.index') }}"> People </a></li>
                        <li><a class="{{ request()->routeIs('role.*') ? 'active' : '' }}" href="{{route('role.index')}}"> Role </a></li>
                        <li><a class="{{ request()->routeIs('permission.*') ? 'active' : '' }}" href="{{route('permission.index')}}"> Permission </a></li>
                    </ul>
                </li>
                @endrole
            </ul>
        </div>
    </div>
</div>
