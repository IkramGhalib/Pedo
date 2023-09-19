<div class="site-menubar-body">
    <div>
        <div>
            <ul class="site-menu" data-plugin="menu">
                <!-- <li class="site-menu-category">General</li> -->
                <li class="site-menu-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="site-menu-icon wb-dashboard" aria-hidden="true"></i>
                        <span class="site-menu-title">Dashboard</span>
                    </a>
                </li>
                <li class="site-menu-item {{ request()->is('admin/user*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users') }}">
                        <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                        <span class="site-menu-title">Users Management</span>
                    </a>
                </li>

                <li class="site-menu-item {{ request()->is('admin/group*') ? 'active' : '' }}">
                    <a href="{{ route('admin.groups') }}">
                        <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                        <span class="site-menu-title">Group</span>
                    </a>
                </li>

                <li class="site-menu-item {{ request()->is('admin/test*') ? 'active' : '' }}">
                    <a href="{{ route('admin.test.list') }}">
                        <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                        <span class="site-menu-title">Test</span>
                    </a>
                </li>

                <li class="site-menu-item {{ request()->is('admin/question*') ? 'active' : '' }}">
                    <a href="{{ route('admin.question.list') }}">
                        <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                        <span class="site-menu-title">Questions</span>
                    </a>
                </li>

                <li class="site-menu-item {{ request()->is('admin/result*') ? 'active' : '' }}">
                    <a href="{{ route('admin.result.list') }}">
                        <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                        <span class="site-menu-title">Result</span>
                    </a>
                </li>


              
            {{-- <li class="site-menu-item {{ request()->is('admin/categor*') ? 'active' : '' }}">
                    <a href="{{ route('admin.categories') }}">
                        <i class="site-menu-icon wb-tag" aria-hidden="true"></i>
                        <span class="site-menu-title">Categories</span>
                    </a>
                </li> 
                <li class="site-menu-item {{ request()->is('instructor-course-*') ? 'active' : '' }}">
                    <a href="{{ route('instructor.course.list') }}">
                        <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                        <span class="site-menu-title">Courses</span>
                    </a>
                </li>
                
                --}}


                <li class="site-menu-item {{ request()->is('instructor-lists-*') ? 'active' : '' }}">
                    <a href="{{ route('instructor.lists') }}">
                        <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                        <span class="site-menu-title">Instructors</span>
                    </a>
                </li>


                  
                
                
                {{-- <li class="site-menu-item {{ request()->is('admin/withdraw-requests') ? 'active' : '' }}">
                    <a href="{{ route('admin.withdraw.requests') }}">
                        <i class="site-menu-icon fas fa-hand-holding-usd" aria-hidden="true"></i>
                        <span class="site-menu-title">Withdraw Requests</span>
                    </a>
                </li> 
                <li class="site-menu-item {{ request()->is('admin/blog*') ? 'active' : '' }}">
                    <a href="{{ route('admin.blogs') }}">
                        <i class="site-menu-icon fas fa-blog" aria-hidden="true"></i>
                        <span class="site-menu-title">Blogs</span>
                    </a>
                </li>
                --}}

               
                <li class="site-menu-item {{ request()->is('admin/invoice-form-*') ? 'active' : '' }}">
                    <a href="{{ route('admin.invoice.list') }}">
                        <i class="site-menu-icon wb-user" aria-hidden="true"></i>
                        <span class="site-menu-title">Invoice</span>
                    </a>
                </li>
                

                <li class="site-menu-item has-sub {{ request()->is('admin/config/page-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Pages</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/config/page-home') ? 'active' : '' }}">
                            <a href="{{ route('admin.pageHome') }}">
                                <span class="site-menu-title">Home</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/page-about') ? 'active' : '' }}">
                            <a href="{{ route('admin.pageAbout') }}">
                                <span class="site-menu-title">About Us</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/page-contact') ? 'active' : '' }}">
                            <a href="{{ route('admin.pageContact') }}">
                                <span class="site-menu-title">Contact Us</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="site-menu-item has-sub {{ request()->is('admin/config/setting-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon fas fa-cogs" aria-hidden="true"></i>
                        <span class="site-menu-title">Settings</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/config/setting-general') ? 'active' : '' }}">
                            <a href="{{ route('admin.settingGeneral') }}">
                                <span class="site-menu-title">General</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/setting-payment') ? 'active' : '' }}">
                            <a href="{{ route('admin.settingPayment') }}">
                                <span class="site-menu-title">Payment</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/setting-category') ? 'active' : '' }}">
                            <a href="{{ route('admin.categoryIndex') }}">
                                <span class="site-menu-title">Category</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/setting-course') ? 'active' : '' }}">
                            <a href="{{ route('admin.course.list') }}">
                                <span class="site-menu-title">Subject</span>
                            </a>
                        </li>

                        {{-- <li class="site-menu-item {{ request()->is('admin/config/setting-course') ? 'active' : '' }}">
                            <a href="{{ route('admin.course.list') }}">
                                <span class="site-menu-title">Course</span>
                            </a>
                        </li> --}}
                        <!-- <li class="site-menu-item {{ request()->is('admin/config/setting-email') ? 'active' : '' }}">
                  <a href="{{ route('admin.settingEmail') }}">
                    <span class="site-menu-title">Email</span>
                  </a>
                </li> -->
                    </ul>
                </li>

            </ul>


        </div>
    </div>
</div>
