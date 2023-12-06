<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}"><i class="fe fe-home"></i> <span>Bảng điều khiển</span></a>
                </li>
                {{--                <li class="{{ request()->routeIs('statistic.index') ? 'active' : '' }}">--}}
                {{--                    <a href="{{ route('statistic.index') }}">--}}
                {{--                        <i class="fe fe-bar-chart"></i>--}}
                {{--                        <span>Thống kê</span></a>--}}
                {{--                </li>--}}
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
                <li class="submenu">
                    <a href="#">
                        <i class="fa-solid fa-user-doctor"></i>
                        <span>Bác sĩ</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ request()->routeIs('doctors.*') ? 'active' : '' }}" href="{{ route('doctors.index') }}">Danh sách bác sĩ</a></li>
                        <li><a class="{{ request()->routeIs('schedules.*') ? 'active' : '' }}" href="{{ route('schedules.index') }}">Lịch làm việc</a></li>
                    </ul>
                </li>
                <li>
                    <a class="{{ request()->routeIs('type-pet.*') ? 'active' : '' }}" href="{{ route('type-pet.index') }}">
                        <svg fill="#fff" height="19px" width="19px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 228.804 228.804" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path d="M184.475,161.189c-2.368-3.731-19.724-30.767-34.558-45.068c-12.376-11.883-30.9-12.227-33-12.227 c-0.191,0.001-0.383,0.008-0.571,0.023h-4.491c-1.984,0-19.761,0.338-32.763,12.042C63.05,130.416,45.3,159.575,44.058,161.63 c-9.403,14.867-15.166,24.536-15.166,35.286c0,19.371,14.193,31.888,36.158,31.888h98.711c21.959,0,36.148-12.529,36.148-31.92 c0-10.845-5.777-20.5-15.205-35.353C184.63,161.415,184.554,161.3,184.475,161.189z M163.761,213.804H65.05 c-7.902,0-21.158-2.194-21.158-16.888c0-6.279,4.126-13.489,12.885-27.334c0.029-0.046,0.058-0.093,0.087-0.14 c0.175-0.29,17.631-29.146,32.267-42.336c8.925-8.034,22.597-8.187,22.73-8.188h5.08c0.143,0,0.284-0.004,0.426-0.012 c2.441,0.092,14.739,0.907,22.152,8.024c14.283,13.772,32.324,42.347,32.505,42.634c0.081,0.129,0.165,0.254,0.253,0.376 c9.316,14.698,12.633,21.018,12.633,26.942C184.909,210.868,173.408,213.804,163.761,213.804z"></path> <path d="M78.198,85.731c16.929,0,30.189-18.831,30.189-42.87C108.388,18.827,95.127,0,78.198,0 C61.271,0,48.011,18.827,48.011,42.861C48.011,66.901,61.271,85.731,78.198,85.731z M78.198,15 c7.184,0,15.189,11.442,15.189,27.861c0,16.424-8.006,27.87-15.189,27.87s-15.188-11.446-15.188-27.87 C63.011,26.442,71.015,15,78.198,15z"></path> <path d="M38.664,137.296c2.951,0,5.77-0.607,8.413-1.82c13.162-6.12,16.827-25.327,8.34-43.731 C48.832,77.493,36.65,67.918,25.101,67.918c-2.954,0-5.777,0.609-8.401,1.817C3.52,75.834-0.157,95.045,8.332,113.481 c6.585,14.244,18.774,23.814,30.33,23.815H38.664z M21.952,107.197c-5.076-11.024-3.635-21.683,1.033-23.842 c0.639-0.294,1.33-0.437,2.115-0.437c4.71,0,12.162,5.298,16.697,15.113c5.076,11.008,3.635,21.668-1.011,23.828 c-0.642,0.294-1.336,0.438-2.123,0.438C33.947,122.296,26.486,117,21.952,107.197z"></path> <path d="M150.591,85.731c16.923,0,30.18-18.831,30.18-42.87C180.771,18.827,167.514,0,150.591,0 c-16.939,0-30.207,18.827-30.207,42.861C120.384,66.901,133.652,85.731,150.591,85.731z M150.591,15 c7.18,0,15.18,11.442,15.18,27.861c0,16.424-8,27.87-15.18,27.87c-7.192,0-15.207-11.446-15.207-27.87 C135.384,26.442,143.399,15,150.591,15z"></path> <path d="M212.104,69.737c-2.617-1.212-5.447-1.827-8.411-1.827c-11.532,0-23.71,9.578-30.299,23.827 c-8.525,18.396-4.863,37.61,8.368,43.756c2.609,1.197,5.429,1.804,8.38,1.804c11.559,0,23.745-9.572,30.324-23.822 C228.962,95.052,225.287,75.839,212.104,69.737z M206.846,107.19c-4.53,9.812-11.987,15.106-16.704,15.106 c-0.788,0-1.482-0.143-2.093-0.423c-4.696-2.181-6.141-12.835-1.043-23.835c4.544-9.827,11.988-15.129,16.687-15.129 c0.781,0,1.47,0.143,2.107,0.438C210.484,85.517,211.926,96.175,206.846,107.19z"></path> </g> </g></svg>
                        <span>Thú cưng</span> </a>
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
                        <li><a class="{{ request()->routeIs('people-account.*') ? 'active' : '' }}" href="{{ route('people-account.index') }}"> Tài khoản người dùng </a></li>
                        <li><a class="{{ request()->routeIs('role.*') ? 'active' : '' }}" href="{{route('role.index')}}"> Cấp vai trò </a></li>
                        <li><a class="{{ request()->routeIs('permission.*') ? 'active' : '' }}" href="{{route('permission.index')}}"> Cấp quyền </a></li>
                    </ul>
                </li>
                @endrole
            </ul>
        </div>
    </div>
</div>
