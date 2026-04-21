<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <span class="brand-logo">
                        <img src="{{ asset('backend/assets/logo.png') }}" alt="">
                    </span>
                    <h2 class="brand-text">{{ config('app.name') }}</h2>
                </a>
            </li>

        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-item text-truncate">Home</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.property.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.property.index') }}">
                    <i data-feather="map-pin"></i>
                    <span class="menu-title text-truncate">Properties</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.category.index') }}">
                    <i data-feather="layers"></i>
                    <span class="menu-title text-truncate">Article Category</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('admin.article.*') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('admin.article.index') }}">
                    <i data-feather="file-text"></i>
                    <span class="menu-title text-truncate">Articles</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('user.list') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('user.list') }}">
                    <i data-feather="users"></i>
                    <span class="menu-title text-truncate">Users</span>
                </a>
            </li>

            <li class="nav-item {{ request()->routeIs('faq.index') ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="{{ route('faq.index') }}">
                    <i data-feather="help-circle"></i>
                    <span class="menu-title text-truncate">FAQ</span>
                </a>
            </li>

            {{-- CMS --}}
            <li class="nav-item has-sub {{ request()->routeIs('cms.*') ? 'open' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="layout"></i>
                    <span class="menu-title text-truncate">CMS</span>
                </a>
                <ul class="menu-content">
                    <li class="has-sub {{ request()->routeIs('cms.home_page.*') ? 'open sidebar-group-active' : '' }}">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Home Page</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cms.home_page.top_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cms.home_page.top_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Top Section</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cms.home_page.middle_file_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.home_page.middle_file_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Middle File Section</span>
                                </a>
                            </li>

                            <!-- common -->
                            <li class="{{ request()->routeIs('cms.common_page.about_owner_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.common_page.about_owner_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">About Owner Section</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('cms.common_page.about_pertnership_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.common_page.about_pertnership_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">About Pertnership Section</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('cms.common_page.advisor_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.common_page.advisor_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Advisor Section</span>
                                </a>
                            </li>
                            <!-- common/ -->

                            <li class="{{ request()->routeIs('cms.home_page.coming_soon_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.home_page.coming_soon_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Coming Soon Section</span>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="has-sub {{ request()->routeIs('cms.buy_page.*') ? 'open' : '' }}">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Buy Page</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cms.buy_page.top_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cms.buy_page.top_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Top Section</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('cms.buy_page.buying_property_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.buy_page.buying_property_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Buying Property Section</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('cms.buy_page.challenging_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.buy_page.challenging_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Challenging Section</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cms.buy_page.work_with_us_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.buy_page.work_with_us_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Work With Us Section</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cms.buy_page.buying_process_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.buy_page.buying_process_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Buying Process Section</span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->routeIs('cms.buy_page.cost_consider_buying_property_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.buy_page.cost_consider_buying_property_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Cost Consider Buying Property Section</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cms.buy_page.get_clarity_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.buy_page.get_clarity_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Get Clarity Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-sub {{ request()->routeIs('cms.sell_page.*') ? 'open' : '' }}">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Sell Page</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cms.sell_page.top_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cms.sell_page.top_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Top Section</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('cms.sell_page.selling_property_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.sell_page.selling_property_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Selling Property Section</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('cms.sell_page.challenging_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.sell_page.challenging_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Challenging Section</span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->routeIs('cms.sell_page.property_choose_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.sell_page.property_choose_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Property Choose Section</span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->routeIs('cms.sell_page.selling_process_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.sell_page.selling_process_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Selling Process Section</span>
                                </a>
                            </li>

                            <li
                                class="{{ request()->routeIs('cms.sell_page.cost_consider_selling_property_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.sell_page.cost_consider_selling_property_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Cost Consider Selling Property Section</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('cms.sell_page.get_clarity_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.sell_page.get_clarity_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Get Clarity Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-sub {{ request()->routeIs('cms.masterclass_page.*') ? 'open' : '' }}">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Masterclass Page</span>
                        </a>
                        <ul class="menu-content">
                            <li
                                class="{{ request()->routeIs('cms.masterclass_page.masterclass_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.masterclass_page.masterclass_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Masterclass Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-sub {{ request()->routeIs('cms.insight_page.*') ? 'open' : '' }}">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">Insight Page</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cms.insight_page.top_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cms.insight_page.top_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Top Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="has-sub {{ request()->routeIs('cms.about_page.*') ? 'open' : '' }}">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate">About Page</span>
                        </a>
                        <ul class="menu-content">
                            <li class="{{ request()->routeIs('cms.about_page.top_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center" href="{{ route('cms.about_page.top_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Top Section</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('cms.about_page.about_us_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.about_page.about_us_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">About Us Section</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('cms.about_page.our_values_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.about_page.our_values_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Our Values Section</span>
                                </a>
                            </li>

                            <!-- common -->
                            <li class="{{ request()->routeIs('cms.common_page.about_owner_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.common_page.about_owner_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">About Owner Section</span>
                                </a>
                            </li>
                            <li
                                class="{{ request()->routeIs('cms.common_page.about_pertnership_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.common_page.about_pertnership_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">About Pertnership Section</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('cms.common_page.advisor_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.common_page.advisor_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">Advisor Section</span>
                                </a>
                            </li>
                            <!-- common/ -->

                            <li class="{{ request()->routeIs('cms.about_page.end_file_section') ? 'active' : '' }}">
                                <a class="d-flex align-items-center"
                                    href="{{ route('cms.about_page.end_file_section') }}">
                                    <i data-feather="circle"></i>
                                    <span class="menu-item text-truncate">End File Section</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
            </li>

            <li class=" navigation-header">
                <span data-i18n="Charts &amp; Maps">
                    Settings
                </span>
                <i data-feather="more-horizontal"></i>
            </li>

            <li
                class="nav-item {{ request()->routeIs(['admin.setting', 'admin.setting.*', 'social_media', 'profile.*']) ? 'active' : '' }}">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate">System Settings</span>
                    <!-- <span class="badge badge-light-success badge-pill ml-auto mr-2">4</span> -->
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('admin.setting') ? 'active' : '' }}">
                        <a href="{{ route('admin.setting') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item">General Setting</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('social_media') ? 'active' : '' }}">
                        <a href="{{ route('social_media') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item">Social Media</span>
                        </a>
                    </li>

                    <li class="{{ request()->routeIs('profile') ? 'active' : '' }}">
                        <a href="{{ route('profile') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item">Profile Settings</span>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('dynamicpages.index') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('dynamicpages.index') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Dynamic Pages
                            </span>
                        </a>
                    </li> --}}
                </ul>
            </li>
            {{-- <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-gear"></i>
                    <span class="menu-title text-truncate" data-i18n="Charts">
                        Role Permissions
                    </span>
                </a>
                <ul class="menu-content">
                    <li class="{{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.role.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Apex">
                                Role
                            </span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.permissions.list') ? 'active' : '' }}">
                        <a class="d-flex align-items-center" href="{{ route('admin.permissions.list') }}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="Chartjs">
                                Permissions
                            </span>
                        </a>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </div>
</div>