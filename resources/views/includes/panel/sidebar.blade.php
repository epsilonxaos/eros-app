<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
	<!-- Brand -->
	<div class="sidenav-header  align-items-center">
		<a class="navbar-brand" href="javascript:void(0)">
			<img src="{{asset('img/logo.svg')}}" class="navbar-brand-img" alt="..." width="170" style="filter: invert(1)">
		</a>
	</div>
	<div class="navbar-inner">
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidenav-collapse-main">
			<!-- Nav items -->
			<hr class="my-3">
			<h6 class="navbar-heading p-0 text-muted">Eros - Catálogo</h6>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/eros/establecimientos*') ? 'active' : '' }}" href="{{route('panel.eros.establecimientos.index')}}">
						<i class="ni ni-building text-default"></i>
						<span class="nav-link-text">Establecimientos</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/eros/categorias*') ? 'active' : '' }}" href="{{route('panel.eros.categorias.index')}}">
						<i class="ni ni-bullet-list-67 text-default"></i>
						<span class="nav-link-text">Categorias</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">
						<i class="ni ni-single-02 text-default"></i>
						<span class="nav-link-text">Habitaciones</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/eros/productos*') ? 'active' : '' }}" href="{{route('panel.eros.productos.index')}}">
						<i class="ni ni-cart text-default"></i>
						<span class="nav-link-text">Productos</span>
					</a>
				</li>
			</ul>
			<hr class="my-3">
			<h6 class="navbar-heading p-0 text-muted">Administrador</h6>
			<ul class="navbar-nav">
				@can(PermissionKey::Admin['permissions']['index']['name'])
					<li class="nav-item">
						<a class="nav-link {{request() -> is('admin/cuentas/usuarios*') ? 'active' : '' }}" href="{{ route('panel.admins.index') }}">
							<i class="ni ni-single-02 text-default"></i>
							<span class="nav-link-text">Usuarios</span>
						</a>
					</li>
				@endcan
			</ul>
		</div>
	</div>
	</div>
</nav>
