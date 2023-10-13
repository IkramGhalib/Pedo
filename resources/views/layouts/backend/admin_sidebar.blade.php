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
               
                <li class="site-menu-item has-sub {{ request()->is('admin/config/paged-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Consumer</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/configc/page-home') ? 'active' : '' }}">
                            <a href="{{ route('admin.ccategory.list') }}">
                                <span class="site-menu-title"> Type</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/pagedd-about') ? 'active' : '' }}">
                            <a href="{{ route('admin.cons-sub-category.list') }}">
                            
                                <span class="site-menu-title">Sub Type</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/pagedd-contact') ? 'active' : '' }}">
                            <a href="{{ route('admin.slab.list') }}">
                                <span class="site-menu-title">Slabs</span>
                            </a>
                        </li>

                        <li class="site-menu-item {{ request()->is('admin/config/pagedd-contact') ? 'active' : '' }}">
                            <a href="{{ route('consumer.lists') }}">
                                <span class="site-menu-title">Consumer</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- meter add -->

                <li class="site-menu-item has-sub {{ request()->is('admin/config/paged-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Meters</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/configc/page-home') ? 'active' : '' }}">
                            <a href="{{ route('admin.meter.list') }}">
                                <span class="site-menu-title"> Meter Stock</span>
                            </a>
                        </li>
                        <!-- <li class="site-menu-item {{ request()->is('admin/config/pagedd-about') ? 'active' : '' }}">
                            <a href="{{ route('admin.cons-sub-category.list') }}">
                            
                                <span class="site-menu-title">Meter Assign</span>
                            </a>
                        </li> -->
                        

                        
                    </ul>
                </li>


                <li class="site-menu-item has-sub {{ request()->is('admin/configd/page-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Charges</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/config/page-home2') ? 'active' : '' }}">
                            <a href="{{ route('admin.tax.type.list') }}">
                                <span class="site-menu-title">Tax Title</span>
                            </a>
                        </li>

                        <li class="site-menu-item {{ request()->is('admin/config/page-home2') ? 'active' : '' }}">
                            <a href="{{ route('admin.general-tax.list') }}">
                                <span class="site-menu-title">Tax </span>
                            </a>
                        </li>

                        <li class="site-menu-item {{ request()->is('admin/config/page-home2') ? 'active' : '' }}">
                            <a href="{{ route('admin.charges.type.list') }}">
                                <span class="site-menu-title">Charges Types </span>
                            </a>
                        </li>

                        <li class="site-menu-item {{ request()->is('admin/config/page-home2') ? 'active' : '' }}">
                            <a href="{{ route('admin.charges.list') }}">
                                <span class="site-menu-title">Charges </span>
                            </a>
                        </li>

                        
                        <!-- <li class="site-menu-item {{ request()->is('admin/config/page-about1') ? 'active' : '' }}">
                            <a href="{{ route('admin.pageAbout') }}">
                                <span class="site-menu-title">Special </span>
                            </a>
                        </li> -->
                        
                    </ul>
                </li>

                

                <li class="site-menu-item has-sub {{ request()->is('admin/config/paged-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Area</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/config/page-homec') ? 'active' : '' }}">
                            <a href="{{ route('admin.division.list') }}">
                                <span class="site-menu-title">Division </span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/page-aboutb') ? 'active' : '' }}">
                            <a href="{{ route('admin.sub_division.list') }}">
                                <span class="site-menu-title">Sub Division </span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/page-abouta') ? 'active' : '' }}">
                            <a href="{{route('admin.feeder.list')}}">
                                <span class="site-menu-title">Feeder </span>
                            </a>
                        </li>
                        
                    </ul>
                </li>


                <li class="site-menu-item has-sub {{ request()->is('admin/config/paged-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Reading</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                    <!-- if(Auth::user()->hasRole('reader')) -->
                        <li class="site-menu-item {{ request()->is('admin/config/page-homec') ? 'active' : '' }}">
                            <a href="{{ route('reading.lists') }}">
                                <span class="site-menu-title">Meter Reading </span>
                            </a>
                        </li>
                        
                        <li class="site-menu-item {{ request()->is('admin/config/page-aboutb') ? 'active' : '' }}">
                            <a href="{{ route('reading.approve.lists') }}">
                                <span class="site-menu-title">Verify Reading </span>
                            </a>
                        </li>
                       
                       
                        
                    </ul>
                </li>


                <li class="site-menu-item has-sub {{ request()->is('admin/config/paged-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Payments</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                    <!-- if(Auth::user()->hasRole('reader')) -->
                        <li class="site-menu-item {{ request()->is('admin/config/page-homec') ? 'active' : '' }}">
                            <a href="{{ route('receive.payment.lists') }}">
                                <span class="site-menu-title">Receive Payement </span>
                            </a>
                        </li>
                        
                        
                       
                       
                        
                    </ul>
                </li>

                <li class="site-menu-item has-sub {{ request()->is('admin/config/paged-*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon wb-file" aria-hidden="true"></i>
                        <span class="site-menu-title">Bill</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/config/page-homec') ? 'active' : '' }}">
                            <a href="{{ route('bill.generate.lists') }}">
                                <span class="site-menu-title">Generat Bill </span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/config/page-aboutb') ? 'active' : '' }}">
                            <a href="{{ route('reading.approve.lists') }}">
                                <span class="site-menu-title">Bill History </span>
                            </a>
                        </li>
                       
                        
                    </ul>
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
                       <!--  <li class="site-menu-item  request()->is('admin/config/setting-general') ? 'active' : '' ">
                            <a href=" route('admin.settingGeneral') ">
                                <span class="site-menu-title">General</span>
                            </a>
                        </li> -->

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
                         <li class="site-menu-item {{ request()->is('admin/config/setting-charge') ? 'active' : '' }}">
                            <a href="{{ route('admin.settingCharge') }}">
                                <span class="site-menu-title">Charges</span>
                            </a>
                        </li>
                        <!-- <li class="site-menu-item {{ request()->is('admin/config/setting-email') ? 'active' : '' }}">
                  <a href="{{ route('admin.settingEmail') }}">
                    <span class="site-menu-title">Email</span>
                  </a>
                </li> -->
                    </ul>
                </li>

                <li class="site-menu-item has-sub {{ request()->is('admin/report/*') ? 'active open' : '' }}">
                    <a href="javascript:void(0)">
                        <i class="site-menu-icon fas fa-cogs" aria-hidden="true"></i>
                        <span class="site-menu-title">Reports</span>
                        <span class="site-menu-arrow"></span>
                    </a>
                    <ul class="site-menu-sub">
                        <li class="site-menu-item {{ request()->is('admin/report/reading_report_form') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.reading.form') }}">  
                                <span class="site-menu-title">Reading</span>
                            </a>
                        </li>

                        <li class="site-menu-item {{ request()->is('admin/report/bill_report_form') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.bill.form') }}">  
                                <span class="site-menu-title">Bills</span>
                            </a>
                        </li>
                        <li class="site-menu-item {{ request()->is('admin/report/payment_report_form') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.payment.form') }}">  
                                <span class="site-menu-title">Payments</span>
                            </a>
                        </li>

                        <li class="site-menu-item {{ request()->is('admin/report/consumer_report_form') ? 'active' : '' }}">
                            <a href="{{ route('admin.report.consumer.form') }}">  
                                <span class="site-menu-title">Consumer</span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </li>

            </ul>


        </div>
    </div>
</div>
