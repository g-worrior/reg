        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="dlabnav">
            <div class="dlabnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="dropdown header-profile">
                        <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                            <img src="{{ asset('images/user/' . Auth::user()->profile_picture) }}" width="20"
                                alt="">
                            <div class="header-info ms-3">
                                <span class="font-w600 "><b>{{ Auth::user()->name }}</b></span>
                                <small class="text-end font-w400">{{ Auth::user()->email }}</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="{{ url('executive/myprofile') }}" class="dropdown-item ai-icon">
                                <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary"
                                    width="18" height="18" viewbox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <span class="ms-2">Profile </span>
                            </a>
                            <a href="{{ url('executive/change_password') }}" class="dropdown-item ai-icon">
                                <svg id="c-pass" width="18" height="18" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <!-- Created with SVG-edit - http://svg-edit.googlecode.com/ -->
                                    <defs>
                                     <pattern id="gridpattern" patternUnits="userSpaceOnUse" x="0" y="0" width="100" height="100">
                                      <image id="svg_1" x="0" y="0" width="18" height="18"/>
                                     </pattern>
                                     <pattern height="18" width="100" y="0" x="0" patternUnits="userSpaceOnUse" id="gridpattern">
                                      <image height="18" width="18" y="0" x="0" id="svg_3"/>
                                     </pattern>
                                     <pattern height="18" width="100" y="0" x="0" patternUnits="userSpaceOnUse" id="gridpattern">
                                      <image height="18" width="18" y="0" x="0" id="svg_2"/>
                                     </pattern>
                                    </defs>
                                    <g>
                                     <title>Layer 1</title>
                                     <image xlink:href="data:image/png;base64,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" id="svg_4" height="21" width="21" y="-1" x="-1.5"/>
                                    </g>
                                   </svg>
                                <span class="ms-2">Change Password </span>
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item ai-icon"><svg id="icon-logout"
                                        xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                        height="18" viewbox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline>
                                        <line x1="21" y1="12" x2="9" y2="12"></line>
                                    </svg>
                                    <span class="ms-2">Logout </span></button>
                            </form>
                        </div>
                    </li>
                    <li><a href="{{ url('executive/dashboard') }}" aria-expanded="false">
                            <i class="flaticon-025-dashboard"></i>
                            <span class="nav-text">Dashboard</span>
                        </a>
                    </li>
                    <li><a class="has-arrow ai-icon" aria-expanded="false">
                            <i class="flaticon-050-info"></i>
                            <span class="nav-text">My Account</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('executive/myprofile') }}">Profile</a></li>
                            <li><a href="{{ url('executive/change_password') }}">Change Password</a></li>
                            <li><a href="{{ url('chatify') }}">Messages</a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="flaticon-072-printer"></i>
                            <span class="nav-text">Reports</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="{{ url('executive/customer')}}">Members </a></li>
                        </ul>
                    </li>
                    <li><a class="has-arrow ai-icon" aria-expanded="false">
                        <i class="flaticon-013-checkmark"></i>
                        <span class="nav-text">Information</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{ url('executive/business_categories')}}">Business Categories</a></li>
                        <li><a href="{{ url('executive/business_types')}}">Business Types</a></li>
                        <li><a href="{{ url('executive/district')}}">Districts</a></li>
                    </ul>
                </li>
                </ul>
                <div class="copyright">
                    <p><strong>Maravi Comodity Traders</strong> © 2022 All Rights Reserved</p>
                    <p class="fs-12">Made By <span class="heart"></span>Maravi</p>
                </div>
            </div>
        </div>
