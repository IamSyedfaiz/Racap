 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

     <!-- Sidebar - Brand -->
     <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
         <div class="sidebar-brand-icon rotate-n-15">
             <i class="fas fa-laugh-wink"></i>
         </div>
         <div class="sidebar-brand-text mx-3">RACAP PMS</div>
     </a>

     <!-- Divider -->
     <hr class="sidebar-divider my-0">

     <!-- Nav Item - Dashboard -->
     <li class="nav-item active">
         <a class="nav-link" href="{{ route('dashboard') }}">
             <i class="fas fa-fw fa-tachometer-alt"></i>
             <span>Dashboard</span></a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">

     <!-- Heading -->
     <div class="sidebar-heading">
         Projects
     </div>

     <!-- Nav Item - Pages Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
             aria-expanded="true" aria-controls="collapseTwo">
             <i class="fas fa-fw fa-cog"></i>
             <span>Projects</span>
         </a>
         <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <!--<h6 class="collapse-header">View Projects:</h6>-->
                 <a class="collapse-item" href="{{ route('currentprojects') }}">Current Projects</a>
                 <a class="collapse-item" href="{{ route('upcoming.project') }}">Upcoming Projects</a>
                 <a class="collapse-item" href="{{ route('past.projects') }}">Past Projects</a>
             </div>
         </div>
     </li>

     <!-- Nav Item - Utilities Collapse Menu -->
     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
             aria-expanded="true" aria-controls="collapseUtilities">
             <i class="fas fa-fw fa-wrench"></i>
             <span>Reports</span>
         </a>
         <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
             data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Generate Reports</h6>
                 <a class="collapse-item" href="{{ route('project.report') }}">Projects Report</a>

             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
             aria-expanded="true" aria-controls="collapsePages">
             <i class="fas fa-fw fa-folder"></i>
             <span>Management</span>
         </a>
         <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
             <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Provisions:</h6>
                 <a class="collapse-item" href="{{ route('create_teams') }}">Create Teams</a>
                 <div class="collapse-divider"></div>
             </div>
         </div>
     </li>

     <li class="nav-item">
         <a class="nav-link collapsed" href="{{ route('create.user') }}">
             <i class="fas fa-fw fa-folder"></i>
             <span>Create User</span>
         </a>
     </li>
     <li class="nav-item">
         <a class="nav-link collapsed" href="{{ route('new.enquiry') }}">
             <i class="fas fa-fw fa-folder"></i>
             <span>New Enquiry</span>
         </a>
     </li>

     <!-- Divider -->
     <hr class="sidebar-divider">



     <!-- Divider -->
     <!--<hr class="sidebar-divider d-none d-md-block">-->

     <!-- Sidebar Toggler (Sidebar) -->
     <div class="text-center d-none d-md-inline">
         <button class="rounded-circle border-0" id="sidebarToggle"></button>
     </div>

 </ul>
 <!-- End of Sidebar -->
