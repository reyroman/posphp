<header class="main-header"> 
	
	<!-- LOGOTIPO -->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini">
			<img src="view/img/template/icono-blanco.png" class="
			img-responsive" style="padding:10px">
		</span>

		<span class="logo-lg">
			<img src="view/img/template/logo-blanco-lineal2.png" class="
			img-responsive" style="padding:10px 0px">	
		</span>
	</a>

	<!-- BARRA DE NAVEGACION -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Boton de navegacion -->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>

		</a>
		<!-- Perfil de usuario -->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						
						<!-- <img src="view/img/users/anonymous.png" class="user-image"> -->

						<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
					</a>
					
					<!-- Dropdown -toggle --> 	

		<ul class="dropdown-menu">
			<li class="user-body">
				<div class="pull-right">
					<a href="salir" class="btn btn-default btn-flat">Salir</a>
				</div>
			</li>
			
		</ul>

				</li>
			</ul>			
		</div>

		

	</nav>

</header>
