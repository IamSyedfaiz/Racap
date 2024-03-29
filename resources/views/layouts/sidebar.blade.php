       <!-- Sidebar -->
       @php
           use App\Models\Enquiry;
           use App\Models\Conversation;
           $is_seens = Enquiry::where('is_seen', 'N')
               ->where('receiver_id', auth()->id())
               ->get();
           //    $is_seen = Conversation::where('is_seen', 'N')->first();
           $is_seen = Conversation::where('is_seen', 'N')
               ->where('user_id', '!=', auth()->user()->id)
               ->first();
           
       @endphp
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion " id="accordionSidebar">

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


           @if (
               $is_seen &&
                   $is_seen->product_id ==
                       auth()->user()->productdetail->isNotEmpty())
               <li class="nav-item">
                   <form class="nav-link collapsed" action="{{ route('current.project') }}" method="POST">
                       @csrf

                       <div class="alert alert-warning alert-dismissible fade show" role="alert">
                           <strong>Attention !</strong> Please review the information provided below.
                           <button type="submit" class="close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                   </form>
               </li>
           @endif

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

           <!-- Divider -->
           <hr class="sidebar-divider">

           <!-- Heading -->
           <div class="sidebar-heading">
               Admin Rights
           </div>

           <!-- Nav Item - Pages Collapse Menu -->
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
                       <!--<h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>-->
                   </div>
               </div>
           </li>
           @if (auth()->user()->getRoleNames()->first() == 'Super Admin')
               <li class="nav-item">
                   <a class="nav-link collapsed" href="{{ route('add.subadmin') }}">
                       <i class="fas fa-fw fa-folder"></i>
                       <span>Add Sub Admin</span>
                   </a>
               </li>
           @endif
           @if (auth()->user()->getRoleNames()->first() == 'Sub Admin' ||
                   auth()->user()->getRoleNames()->first() == 'Super Admin')
               <li class="nav-item">
                   <a class="nav-link collapsed" href="{{ route('create.user') }}">
                       <i class="fas fa-fw fa-folder"></i>
                       <span>Create User</span>
                   </a>
               </li>
           @endif
           @if (auth()->user()->getRoleNames()->first() == 'Sub Admin' ||
                   auth()->user()->getRoleNames()->first() == 'Super Admin')
               <li class="nav-item">
                   <a class="nav-link collapsed" href="{{ route('new.enquiry') }}">
                       <i class="fas fa-fw fa-folder"></i>
                       <span>New Enquiry</span>
                       @foreach ($is_seens as $is_seen)
                           @if ($is_seen)
                               <svg class="ml-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                   fill="#32de84" class="bi bi-circle-fill" viewBox="0 0 16 16">
                                   <circle cx="8" cy="8" r="8" />
                               </svg>
                           @endif
                       @endforeach

                   </a>
               </li>
           @endif



           <!-- Nav Item - Charts -->
           <!--<li class="nav-item">
         <a class="nav-link" href="charts.html">
             <i class="fas fa-fw fa-chart-area"></i>
             <span>Charts</span></a>
     </li>-->


           <!-- Nav Item - Tables -->
           <!--<li class="nav-item">
         <a class="nav-link" href="tables.html">
             <i class="fas fa-fw fa-table"></i>
             <span>Tables</span></a>
     </li>-->

           <!-- Divider -->
           <!--<hr class="sidebar-divider d-none d-md-block">-->

           <!-- Sidebar Toggler (Sidebar) -->
           <div class="text-center d-none d-md-inline">
               <button class="rounded-circle border-0" id="sidebarToggle"></button>
           </div>

           <!-- Sidebar Message -->
           <!--<div class="sidebar-card d-none d-lg-flex">
         <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
         <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
         <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
     </div>-->

       </ul>
       <!-- End of Sidebar -->
