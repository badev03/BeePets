<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#">
                        <i class="fe fe-layout"></i>
                        <span> Cuộn hẹn</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li>
                            <a href="{{ route('appointment.index') }}" class="{{ request()->routeIs('appointment.*') ? 'active' : '' }}"> <span>Cuộc hẹn</span></a>
                        </li>
                        <li><a class="{{ request()->routeIs('appointments.trash-can') ? 'active' : '' }}" href="{{ route('appointments.trash-can') }}">Lịch Đã Hủy</a></li>
                        <li><a class="{{ request()->routeIs('appointments.statistics') ? 'active' : '' }}" href="{{ route('appointments.statistics') }}">Thống kế cuộc hẹn</a></li>
                        <li><a class="{{ request()->routeIs('appointments.cancel.requirements') ? 'active' : '' }}" href="{{ route('appointments.cancel.requirements') }}">Cuộc hẹn yêu cầu hủy</a></li>
                        <li><a class="{{ request()->routeIs('appointments.cancel.requirements') ? 'active' : '' }}" href="{{ route('appointments.cancel.requirements') }}">Hóa đơn cuộc hẹn</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        dkddl
                        <svg width="22px" height="22px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g fill="#ffffff"> <path d="M6.834.33a2.25 2.25 0 012.332 0l5.25 3.182A2.25 2.25 0 0115.5 5.436V6A.75.75 0 0114 6v-.564a.75.75 0 00-.361-.642l-5.25-3.181a.75.75 0 00-.778 0l-5.25 3.181A.75.75 0 002 5.436v5.128a.75.75 0 00.361.642l4.028 2.44a.75.75 0 11-.778 1.283l-4.027-2.44A2.25 2.25 0 01.5 10.563V5.436a2.25 2.25 0 011.084-1.924L6.834.33z"></path> <path fill-rule="evenodd" d="M11.749 7.325l.001-.042v-.286a.75.75 0 00-1.5 0v.286l.001.042a3.73 3.73 0 00-1.318.546.76.76 0 00-.03-.03l-.201-.203a.75.75 0 00-1.06 1.06l.201.203.03.028c-.26.394-.45.84-.547 1.319a.878.878 0 00-.04-.001H7a.75.75 0 000 1.5h.286l.038-.001c.097.48.286.926.547 1.32a.71.71 0 00-.028.027l-.202.202a.75.75 0 001.06 1.06l.203-.202a.695.695 0 00.025-.026c.395.261.842.45 1.322.548l-.001.036v.286a.75.75 0 001.5 0v-.286-.036c.48-.097.926-.287 1.32-.548l.026.026.202.203a.75.75 0 001.06-1.061l-.201-.202a.667.667 0 00-.028-.026c.261-.395.45-.842.547-1.321H15a.75.75 0 000-1.5h-.286l-.04.002a3.734 3.734 0 00-.547-1.319l.03-.028.202-.202a.75.75 0 00-1.06-1.061l-.203.202-.029.03a3.73 3.73 0 00-1.318-.545zM11 8.75A2.247 2.247 0 008.75 11 2.247 2.247 0 0011 13.25 2.247 2.247 0 0013.25 11 2.247 2.247 0 0011 8.75z" clip-rule="evenodd"></path> </g> </g></svg>
                        <span> Dịch vụ</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('service-categories.*') ? 'active' : '' }}" href="{{ route('service-categories.index') }}">Danh mục dịch vụ</a></li>
                        <li><a class="{{ request()->routeIs('service.*') ? 'active' : '' }}" href="{{ route('service.index') }}">Dịch vụ</a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#">
                        <svg width="22px" height="22px" viewBox="0 0 32 32" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="none"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>new</title> <desc>Created with Sketch Beta.</desc> <defs> </defs> <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage"> <g id="Icon-Set" sketch:type="MSLayerGroup" transform="translate(-516.000000, -99.000000)" fill="#fff"> <path d="M527.786,122.02 L522.414,125.273 C521.925,125.501 521.485,125.029 521.713,124.571 L524.965,119.195 L527.786,122.02 L527.786,122.02 Z M537.239,106.222 L540.776,109.712 L529.536,120.959 C528.22,119.641 526.397,117.817 526.024,117.444 L537.239,106.222 L537.239,106.222 Z M540.776,102.683 C541.164,102.294 541.793,102.294 542.182,102.683 L544.289,104.791 C544.677,105.18 544.677,105.809 544.289,106.197 L542.182,108.306 L538.719,104.74 L540.776,102.683 L540.776,102.683 Z M524.11,117.068 L519.81,125.773 C519.449,126.754 520.233,127.632 521.213,127.177 L529.912,122.874 C530.287,122.801 530.651,122.655 530.941,122.365 L546.396,106.899 C547.172,106.124 547.172,104.864 546.396,104.088 L542.884,100.573 C542.107,99.797 540.85,99.797 540.074,100.573 L524.619,116.038 C524.328,116.329 524.184,116.693 524.11,117.068 L524.11,117.068 Z M546,111 L546,127 C546,128.099 544.914,129.012 543.817,129.012 L519.974,129.012 C518.877,129.012 517.987,128.122 517.987,127.023 L517.987,103.165 C517.987,102.066 518.902,101 520,101 L536,101 L536,99 L520,99 C517.806,99 516,100.969 516,103.165 L516,127.023 C516,129.22 517.779,131 519.974,131 L543.817,131 C546.012,131 548,129.196 548,127 L548,111 L546,111 L546,111 Z" id="new" sketch:type="MSShapeGroup"> </path> </g> </g> </g></svg>
                        <span> Tin tức</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('new-categories.*') ? 'active' : '' }}" href="{{ route('new-categories.index') }}">Danh mục tin tức</a></li>
                        <li><a class="{{ request()->routeIs('new.*') ? 'active' : '' }}" href="{{ route('new.index') }}">Tin tức</a></li>
                    </ul>
                </li>
                @role('Admin')
                <li>
                    <a class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}" href="{{ route('doctors.index') }}"><i class="fe fe-user-plus"></i> <span>Bác sĩ</span> </a>
                </li>
                @endrole
                <li>
                    <a href="{{ route('reviews.index') }}"><i class="fe fe-star-o"></i> <span>Đánh giá</span></a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}"><i class="fe fe-activity"></i> <span>Sản phẩm</span></a>
                </li>
                <li>
                    <a href="{{ route('purchase.index') }}"><i class="fe fe-activity"></i> <span>Đơn hàng</span></a>
                </li>
                <li>
                    <a href="{{ route('setting') }}"><i class="fe fe-vector"></i> <span>Cấu hình</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="fe fe-document"></i> <span> Báo cáo</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="invoice-report.html">Báo cáo hóa đơn</a></li>
                    </ul>
                </li>
                @role('Admin')
                <hr class="text-white"/>
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
