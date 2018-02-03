@if (Auth::check())
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{ Auth::user()->name }}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
          </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">{{ trans('backpack::base.administration') }}</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/users') }}"><i class="fa fa-users"></i> <span>Users</span></a></li>

          <li class="header">PAYMENTS</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/plans') }}"><i class="fa fa-cc-stripe"></i> <span>Plans</span></a></li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/coupons') }}"><i class="fa fa-usd"></i> <span>Coupons</span></a></li>

          <li class="header">ITEMS MANAGEMENT</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/units-of-measure') }}"><i class="fa fa-cogs"></i> <span>Units of Measure</span></a></li>

          <!-- ======================================= -->
          <li class="header">{{ trans('backpack::base.user') }}</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/setting') }}"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>
@endif
