<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Paris Admin</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="/admin/home">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/category*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categoryManagement"
            aria-expanded="true" aria-controls="categoryManagement">
            <i class="fas fa-stream"></i>
            <span>Category</span>
        </a>
        <div id="categoryManagement" class="collapse {{Request::is('admin/category*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Category Management:</h6>
                <a class="collapse-item {{Request::is('admin/category') ? 'active' : ''}}" href="/admin/category">List Category</a>
                <a class="collapse-item {{Request::is('admin/category/*') ? 'active' : ''}}" href="/admin/category/edit">Create Category</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/product*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#productManagement"
            aria-expanded="true" aria-controls="productManagement" active>
            <i class="fas fa-ring"></i>
            <span>Product</span>
        </a>
        <div id="productManagement" class="collapse {{Request::is('admin/product*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Product Management:</h6>
                <a class="collapse-item {{Request::is('admin/product') ? 'active' : ''}}" href="/admin/product">List Product</a>
                <a class="collapse-item {{Request::is('admin/product/*') ? 'active' : ''}}" href="/admin/product/create">Create Product</a>
            </div>
        </div>
    </li>

    


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/stock*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#stockManagement"
            aria-expanded="true" aria-controls="stockManagement">
            <i class="fas fa-warehouse"></i>
            <span>Stock</span>
        </a>
        <div id="stockManagement" class="collapse {{Request::is('admin/stock*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Stock Management:</h6>
                <a class="collapse-item {{Request::is('admin/stock') ? 'active' : ''}}" href="/admin/stock">List Stock</a>
                <a class="collapse-item {{Request::is('admin/stock/*') ? 'active' : ''}}" href="/admin/stock/edit">Create Stock</a>
            </div>
        </div>
    </li>

    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/order*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#orderManagement"
            aria-expanded="true" aria-controls="orderManagement">
            <i class="fas fa-cart-plus"></i>
            <span>Order</span>
        </a>
        <div id="orderManagement" class="collapse {{Request::is('admin/order*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Order Management:</h6>
                <a class="collapse-item {{Request::is('admin/order') ? 'active' : ''}}" href="/admin/order">List Order</a>
                <a class="collapse-item {{Request::is('admin/order/*') ? 'active' : ''}}" href="/admin/order/edit">Create Order</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/coupon*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#couponManagement"
            aria-expanded="true" aria-controls="couponManagement">
            <i class="fas fa-ticket-alt"></i>
            <span>Coupon</span>
        </a>
        <div id="couponManagement" class="collapse {{Request::is('admin/coupon*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Coupon Management:</h6>
                <a class="collapse-item {{Request::is('admin/coupon') ? 'active' : ''}}" href="/admin/coupon">List Coupon</a>
                <a class="collapse-item {{Request::is('admin/coupon/*') ? 'active' : ''}}" href="/admin/coupon/edit">Create Coupon</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/payment*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#paymentManagement"
            aria-expanded="true" aria-controls="paymentManagement">
            <i class="fas fa-money-bill-wave"></i>
            <span>Payment</span>
        </a>
        <div id="paymentManagement" class="collapse {{Request::is('admin/payment*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Payment Management:</h6>
                <a class="collapse-item {{Request::is('admin/payment') ? 'active' : ''}}" href="/admin/payment">List Payment</a>
                <a class="collapse-item {{Request::is('admin/payment/*') ? 'active' : ''}}" href="/admin/payment/edit">Create Payment</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/ship*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#shipManagement"
            aria-expanded="true" aria-controls="shipManagement">
            <i class="fas fa-shipping-fast"></i>
            <span>Ship</span>
        </a>
        <div id="shipManagement" class="collapse {{Request::is('admin/ship*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Ship Management:</h6>
                <a class="collapse-item {{Request::is('admin/ship') ? 'active' : ''}}" href="/admin/ship">List Ship</a>
                <a class="collapse-item {{Request::is('admin/ship/*') ? 'active' : ''}}" href="/admin/ship/edit">Create Ship</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/customer*') || Request::is('admin/customer-address*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customerManagement"
            aria-expanded="true" aria-controls="customerManagement">
            <i class="fas fa-user-shield"></i>
            <span>Customer</span>
        </a>
        <div id="customerManagement" class="collapse {{Request::is('admin/customer*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customer Management:</h6>
                <a class="collapse-item {{Request::is('admin/customer') ? 'active' : ''}}" href="/admin/customer">List Customer</a>
                <a class="collapse-item {{Request::is('admin/customer/*') || Request::is('admin/customer-address*') ? 'active' : ''}}" href="/admin/customer/edit">Create Customer</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/review*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reviewManagement"
            aria-expanded="true" aria-controls="reviewManagement">
            <i class="fas fa-comments"></i>
            <span>Review</span>
        </a>
        <div id="reviewManagement" class="collapse {{Request::is('admin/review*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Customer Management:</h6>
                <a class="collapse-item {{Request::is('admin/review*') ? 'active' : ''}}" href="/admin/review">List Product</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>

    
    @role('admin')
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/role*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#roleManagement"
            aria-expanded="true" aria-controls="roleManagement">
            <i class="fas fa-shield-alt"></i>
            <span>Role</span>
        </a>
        <div id="roleManagement" class="collapse {{Request::is('admin/role*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Role Management:</h6>
                <a class="collapse-item {{Request::is('admin/role') ? 'active' : ''}}" href="/admin/role">List Role</a>
                <a class="collapse-item {{Request::is('admin/role/*') ? 'active' : ''}}" href="/admin/role/edit">Create Role</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/permission*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#permissionManagement"
            aria-expanded="true" aria-controls="permissionManagement">
            <i class="fas fa-shield-alt"></i>
            <span>Permission</span>
        </a>
        <div id="permissionManagement" class="collapse {{Request::is('admin/permission*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Permission Management:</h6>
                <a class="collapse-item {{Request::is('admin/permission') ? 'active' : ''}}" href="/admin/permission">List Permission</a>
                <a class="collapse-item {{Request::is('admin/permission/*') ? 'active' : ''}}" href="/admin/permission/edit">Create Permission</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{Request::is('admin/user*') ? 'active' : ''}}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#userManagement"
            aria-expanded="true" aria-controls="userManagement">
            <i class="fas fa-shield-alt"></i>
            <span>User</span>
        </a>
        <div id="userManagement" class="collapse {{Request::is('admin/user*') ? 'show' : ''}}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item {{Request::is('admin/user') ? 'active' : ''}}" href="/admin/user">List User</a>
                <a class="collapse-item {{Request::is('admin/user/*') ? 'active' : ''}}" href="/admin/user/edit">Create User</a>
            </div>
        </div>
    </li>
    @endRole


    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="login.html">Login</a>
                <a class="collapse-item" href="register.html">Register</a>
                <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('admin/img/undraw_rocket.svg') }}" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
<!-- End of Sidebar -->