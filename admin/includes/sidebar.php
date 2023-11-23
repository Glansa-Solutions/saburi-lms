<?php
include("../core/db_config.php");
?>
<nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=$mainlink?>admin/dashboard">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <!-- <li class="nav-item nav-category">UI Elements</li>   -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <!-- <span class="menu-title">UI Elements</span> -->
                            <span class="menu-title">Site Pages</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                <!-- <li class="nav-item"> <a class="nav-link" href="pages/ui-features/buttons.html">Buttons</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/dropdowns.html">Dropdowns</a></li>
                <li class="nav-item"> <a class="nav-link" href="pages/ui-features/typography.html">Typography</a></li> -->
                                <li class="nav-item"> <a class="nav-link" href="<?=$mainlink?>admin/home">Home</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="<?=$mainlink?>admin/about">About</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="<?=$mainlink?>admin/contact">Contact Details</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="<?=$mainlink?>admin/privacy">Privacy policy</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?=$mainlink?>admin/terms">Terms
                                        & Conditions</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="<?=$mainlink?>admin/development">Sustainable Development</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="nav-item nav-category">Forms and Datas</li> -->
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-card-text-outline"></i>
                            <!-- <span class="menu-title">Form elements</span> -->
                            <span class="menu-title">Master</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                <!-- <li class="nav-item"><a class="nav-link" href="pages/forms/basic_elements.html">Basic Elements</a></li> -->
                                <li class="nav-item"><a class="nav-link"
                                href="<?= $mainlink;?>admin/topic">Topics</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= $mainlink;?>admin/subtopic">Sub
                                        Topic admin</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= $mainlink;?>admin/manageCourse">Manage
                                        Courses</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?= $mainlink;?>admin/manageChapter">Manage
                                        Chapters</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?= $mainlink;?>admin/manageAssessment">Manage
                                        Assessment</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?= $mainlink;?>admin/manageStudents">Manage
                                        Students</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="<?=$mainlink?>admin/manageSubscriptions">Subscriptions</a></li>
                                <li class="nav-item"><a class="nav-link" href="<?=$mainlink?>admin/manageStudentSubscription">Student
                                        Subscriptions</a></li>
                                        <li class="nav-item"><a class="nav-link" href="<?=$mainlink?>admin/newsLetter">Newsletter</a></li>

                                <li class="nav-item"><a class="nav-link" href="<?=$mainlink?>admin/manageBulkRegistration">Bulk
                                        registrations</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="<?=$mainlink?>admin/managePayments">Payments</a></li>
                                <li class="nav-item"><a class="nav-link"
                                href="<?= $mainlink;?>admin/manageUser">Users</a></li>
                            </ul>
                        </div>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                            aria-controls="charts">
                            <i class="menu-icon mdi mdi-chart-line"></i>
                            <!-- <span class="menu-title">Charts</span> -->
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <!-- <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">ChartJs</a></li> -->
                                <li class="nav-item"> <a class="nav-link" href="#">MIS</a></li>
                                <li class="nav-item"> <a class="nav-link" href="#">Daily
                                        Payment</a></li>
                                <li class="nav-item"> <a class="nav-link"  href="<?= $mainlink;?>admin/pendingsubreport">Pending
                                        Subscriptions</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?= $mainlink;?>admin/courseslistreport">Courses
                                        List</a></li>
                                        <li class="nav-item"> <a class="nav-link" href="<?= $mainlink;?>admin/studentsListReport">Students
                                        List</a></li>
                                <li class="nav-item"> <a class="nav-link" href="<?= $mainlink;?>admin/userListReports">User List
                                        </a></li>
                                        <li class="nav-item"> <a class="nav-link" href="<?= $mainlink;?>admin/userContacReports">User Contact List
                                        </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                        href="<?= $mainlink;?>admin/blog">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Blog</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                        href="<?= $mainlink;?>admin/freeResources">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Free resources</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                        href="<?= $mainlink;?>admin/affiliate">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Affiliate</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                        href="<?= $mainlink;?>admin/career">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Career</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                        href="<?= $mainlink;?>admin/corpogov">
                            <i class="menu-icon mdi mdi-file-document"></i>
                            <span class="menu-title">Corporate Governance</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="menu-icon mdi mdi-table"></i>
                            <!-- <span class="menu-title">Tables</span> -->
                            <span class="menu-title">Auth</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="<?= $mainlink;?>admin/forgotPassword">Forgot
                                        Password</a></li>
                            </ul>
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="<?= $mainlink;?>admin/changePassword">Change
                                        Password</a></li>
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="menu-icon mdi mdi-layers-outline"></i>
              <span class="menu-title">Icons</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/icons/mdi.html">Mdi icons</a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item nav-category">pages</li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="menu-icon mdi mdi-account-circle-outline"></i>
              <span class="menu-title">User Pages</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="pages/samples/login.html"> Login </a></li>
              </ul>
            </div>
          </li> -->
          <!-- <li class="nav-item nav-category">help</li> -->
          <!-- <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="menu-icon mdi mdi-file-document"></i>
              <span class="menu-title">Documentation</span>
            </a>
          </li> -->
        </ul>
            </nav>
            <div class="main-panel">