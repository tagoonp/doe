<div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
                <li class=" nav-item  <?php if($page == 'home'){ echo "active"; }?>"><a href="./"><i class="menu-livicon" data-icon="home"></i><span class="menu-title text-truncate" data-i18n="First page">Home</span></a></li>
                <li class=" nav-item"><a href="../../../html/ltr/vertical-menu-template-dark/index.html"><i class="menu-livicon" data-icon="desktop"></i><span class="menu-title text-truncate" data-i18n="Dashboard">Dashboard</span><span class="badge badge-light-danger badge-pill badge-round float-right mr-50 ml-auto">2</span></a>
                    <ul class="menu-content">
                        <li><a class="d-flex align-items-center" href="dashboard-analytics.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Analytics">Analytics</span></a></li>
                    </ul>
                </li>
                
                <li class=" navigation-header text-truncate"><span data-i18n="Apps">Your account</span></li>
                <li class=" nav-item <?php if($page == 'page-user-profile'){ echo "active"; }?>"><a href="page-user-profile"><i class="menu-livicon" data-icon="user"></i><span class="menu-title text-truncate" data-i18n="User Profile">User Profile</span></a></li>

                <?php 
                if($role == 'admin'){
                    ?>
                    <li class=" navigation-header text-truncate"><span data-i18n="Apps">Management</span></li>
                    <li class="nav-item "><a href="#"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title text-truncate" data-i18n="Invoice">Users</span></a>
                        <ul class="menu-content">
                            <li class="<?php if($page == 'app-user-list'){ echo "active"; }?>" ><a class="d-flex align-items-center" href="app-user-list"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Invoice List">User List</span></a>
                            </li>
                            <li class="<?php if($page == 'app-user-add'){ echo "active"; }?>"><a class="d-flex align-items-center" href="app-user-add"><i class="bx bx-right-arrow-alt"></i><span class="menu-item text-truncate" data-i18n="Invoice Add">Create new account</span></a>
                            </li>
                        </ul>
                    </li>
                    <?php
                }
                ?>
                

                <li class=" navigation-header text-truncate"><span data-i18n="Apps">App</span></li>
                <li class=" nav-item"><a href="https://medipe2.psu.ac.th/app/wfh"><i class="menu-livicon" data-icon="calendar"></i><span class="menu-title text-truncate" data-i18n="Calendar">DOE-WFH</span></a>
                <li class=" nav-item"><a href="https://medipe2.psu.ac.th/app/personal"><i class="menu-livicon" data-icon="users"></i><span class="menu-title text-truncate" data-i18n="Calendar">DOE Personnal</span></a>
                <li class=" nav-item"><a href="https://medipe2.psu.ac.th/app/sis"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title text-truncate" data-i18n="Calendar">DOE-SIS</span></a>
                </li>
                



                
                <li class=" navigation-header text-truncate"><span data-i18n="Support">Support</span>
                </li>
                <li class=" nav-item"><a href="https://pixinvent.com/demo/frest-clean-bootstrap-admin-dashboard-template/documentation" target="_blank"><i class="menu-livicon" data-icon="morph-folder"></i><span class="menu-title text-truncate" data-i18n="Documentation">Documentation</span></a>
                </li>
            </ul>
        </div>