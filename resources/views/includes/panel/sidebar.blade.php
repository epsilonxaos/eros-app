<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
	<div class="scrollbar-inner">
	<!-- Brand -->
	<div class="sidenav-header bg-default align-items-center">
		<a class="navbar-brand" href="javascript:void(0)">
			<img src="{{asset('img/logo-white.svg')}}" class="navbar-brand-img" alt="..." width="170">
		</a>
	</div>
	<div class="navbar-inner">
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidenav-collapse-main">
			<!-- Nav items -->
			<hr class="my-3">
			<h6 class="navbar-heading p-0 text-muted">Website - General</h6>
            <ul class="navbar-nav">
                <li class="nav-item">
					<a class="nav-link {{request() -> is('admin/website/catalogo-pdf*') ? 'active' : '' }}" href="{{route('panel.website.catalogo', ['id' => 1])}}">
						<i class="fas fa-home text-default"></i>
						<span class="nav-link-text">Catalogo PDF</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/faqs*') ? 'active' : '' }}" href="{{route('panel.faqs.index')}}">
						<i class="fas fa-info-circle text-default"></i>
						<span class="nav-link-text">Faqs</span>
					</a>
				</li>
			</ul>
			<hr class="my-3">
			<h6 class="navbar-heading p-0 text-muted">Website - Catalogo</h6>
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/eros/establecimientos*') ? 'active' : '' }}" href="{{route('panel.eros.establecimientos.index')}}">
						<i class="fas fa-hotel text-default"></i>
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
					<a class="nav-link {{request() -> is('admin/eros/habitaciones*') ? 'active' : '' }}" href="{{route('panel.eros.habitaciones.index')}}">
						<i class="fas fa-bed text-default"></i>
						<span class="nav-link-text">Habitaciones</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/eros/productos*') ? 'active' : '' }}" href="{{route('panel.eros.productos.index')}}">
						<i class="ni ni-cart text-default"></i>
						<span class="nav-link-text">Productos</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link {{request() -> is('admin/eros/amenidades*') ? 'active' : '' }}" href="{{route('panel.eros.amenidades.index')}}">
						<i class="fas fa-tasks text-default"></i>
						<span class="nav-link-text">Amenidades</span>
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
