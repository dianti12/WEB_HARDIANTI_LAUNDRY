 <!-- Nav Item - Search Dropdown (Visible Only XS) -->
 <li class="nav-item dropdown no-arrow d-sm-none">
     <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-search fa-fw"></i>
     </a>
     <!-- Dropdown - Messages -->

 </li>

 <!-- Nav Item - Messages -->


 <div class="topbar-divider d-none d-sm-block"></div>

 <!-- Nav Item - User Information -->
 <li class="nav-item dropdown no-arrow">
     <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= isset($rowNav['username']) ? $rowNav['username'] : '-- your name --' ?></span>
         <img class="img-profile rounded-circle"
             src="<?= !empty($rowNav['profile_picture']) && file_exists('admin/img/profile_picture/' . $rowNav['profile_picture']) ? 'admin/img/profile_picture/' . $rowNav['profile_picture'] : 'https://placehold.co/100' ?>">
     </a>
     <!-- Dropdown - User Information -->
     <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
         aria-labelledby="userDropdown">
         <a class="dropdown-item" href="?page=my-profile">
             <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
             Profile
         </a>
         <a class="dropdown-item" href="#">
             <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
             Settings
         </a>
         <a class="dropdown-item" href="#">
             <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
             Activity Log
         </a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="index.php" data-toggle="modal" data-target="#logoutModal">
             <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
             Logout
         </a>
     </div>
 </li>