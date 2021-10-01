<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
       <!-- sidebar menu -->
       <ul class="sidebar-menu">
          <li class="active">
             <a href="{{route('admin.home')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
             <span class="pull-right-container">
             </span>
             </a>
          </li>

          <li class="treeview">
            <a href="#">
            <i class="fa fa-list" aria-hidden="true"></i> <span>Categories Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{route('categories.create')}}">Add Category</a></li>
               <li><a href="{{route('categories.index')}}">View Category</a></li>
            </ul>
         </li>

          <li class="treeview">
             <a href="#">
             <i class="fa fa-product-hunt" aria-hidden="true"></i> <span>Products Management</span>
             <span class="pull-right-container">
             <i class="fa fa-angle-left pull-right"></i>
             </span>
             </a>
             <ul class="treeview-menu">
                <li><a href="{{route('products.create')}}">Add Product</a></li>
                <li><a href="{{route('products.index')}}">View Product</a></li>
             </ul>
          </li>

          <li class="treeview">
            <a href="#">
            <i class="fa fa-image" aria-hidden="true"></i> <span>Banners Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{route('banners.create')}}">Add Banner</a></li>
               <li><a href="{{route('banners.index')}}">View Banner</a></li>
            </ul>
         </li>

         <li class="treeview">
            <a href="#">
            <i class="fa fa-tags" aria-hidden="true"></i> <span>Cupons Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{route('cupons.create')}}">Add Cupon</a></li>
               <li><a href="{{route('cupons.index')}}">View Cupon</a></li>
            </ul>
         </li>


         <li class="treeview">
            <a href="#">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>Orders Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{route('admin.orders')}}">View Orders</a></li>
            </ul>
         </li>

              <li class="treeview">
            <a href="#">
            <i class="fa fa-user" aria-hidden="true"></i> <span>Customer Management</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{route('admin.users')}}">View Customers</a></li>
            </ul>
         </li>
         
       </ul>
    </div>
    <!-- /.sidebar -->
 </aside>