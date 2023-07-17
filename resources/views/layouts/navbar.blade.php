<aside class="left-sidebar">
   <!-- Sidebar scroll-->
   <div>
      <div class="brand-logo d-flex align-items-center justify-content-between">
         <a href="/" class="text-nowrap logo-img">
         <img src="{{ asset('assets/images/logos/logo.png') }}" width="100" alt="" />
         </a>
         <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="bi bi-list fs-8 dark"></i>
         </div>
      </div>
      <!-- Sidebar navigation-->
      <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
         <ul id="sidebarnav">
            <li class="nav-small-cap">
               <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
               <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="/" aria-expanded="false">
               <span>
               <i class="bi bi-house"></i>
               </span>
               <span class="hide-menu">Inicio</span>
               </a>
            </li>
            <li class="nav-small-cap">
               <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
               <span class="hide-menu">Funciones</span>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="/bisection" aria-expanded="false">
               <span>
               <i class="bi bi-person"></i>
               </span>
               <span class="hide-menu">Método de bisección</span>
               </a>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="/fixed-point" aria-expanded="false">
               <span>
               <i class="bi bi-file-earmark-text"></i>
               </span>
               <span class="hide-menu">Punto fijo</span>
               </a>
            </li>
            <li class="nav-small-cap">
               <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
               <span class="hide-menu">Sesión</span>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="/login" aria-expanded="false">
               <span>
               <i class="bi bi-person"></i>
               </span>
               <span class="hide-menu">Iniciar sesión</span>
               </a>
            </li>
            <li class="sidebar-item">
               <a class="sidebar-link" href="/register" aria-expanded="false">
               <span>
               <i class="bi bi-file-earmark-text"></i>
               </span>
               <span class="hide-menu">Crear cuenta</span>
               </a>
            </li>
         </ul>
      </nav>
      <!-- End Sidebar navigation -->
   </div>
   <!-- End Sidebar scroll-->
</aside>
