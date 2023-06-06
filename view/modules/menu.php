<aside class="main-sidebar">
	
	<section class="sidebar">

		<ul class="sidebar-menu">

		<?php

		if($_SESSION["perfil"] == "Administrador"){

			echo '<li class="active">

				<a href="inicio" >
					<i class="fa fa-home"></i>
					<span>Inicio</span>

				</a>
				
			</li>
			<li>

				<a href="usuarios" >
					<i class="fa fa-user"></i>
					<span>Usuarios</span>

				</a>
				
			</li>
			<li>

				<a href="dolar" >
					<i class="fa fa-usd"></i>
					<span>Dolar</span>

				</a>
				
			</li>';
		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

			echo'<li>

				<a href="categorias" >
					<i class="fa fa-th"></i>
					<span>Categorias</span>

				</a>
				
			</li>
			
			<li>

				<a href="productos" >
					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>
				
			</li>
			
			<li class="treeview">

				<a href="#" >
					<i class="fa fa-refresh"></i>
					<span>Inventario</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>				

				</a>
				<ul class="treeview-menu">
					<li>
						<a href="movimientos">
							<i class="fa fa-circle-o"></i>
							<span>Administrar inventario</span>
						</a>
					</li>
					<li>
						<a href="crear-entrada">
							<i class="fa fa-circle-o"></i>
							<span>Crear entrada</span>
						</a>
					</li>
					<li>
						<a href="crear-salida">
							<i class="fa fa-circle-o"></i>
							<span>Crear salida</span>
						</a>
					</li>

				</ul>
				
			</li>';

		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

			echo'<li>

				<a href="clientes" >
					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>
				
			</li>';
		}

		if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){


			echo'<li class="treeview">

				<a href="#" >
					<i class="fa fa-list-ul"></i>
					<span>Ventas</span>
					<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					</span>				

				</a>
				<ul class="treeview-menu">
					<li>
						<a href="ventas">
							<i class="fa fa-circle-o"></i>
							<span>Administrar ventas</span>
						</a>
					</li>
					<li>
						<a href="crear-venta">
							<i class="fa fa-circle-o"></i>
							<span>Venta al detal</span>
						</a>
					</li>
					<li>
						<a href="crear-venta-mayor">
							<i class="fa fa-circle-o"></i>
							<span>Venta al mayor</span>
						</a>
					</li>';
		

		if($_SESSION["perfil"] == "Administrador"){

					echo'<li>
						<a href="reportes">
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>
						</a>
					</li>';
		}
		
				echo'</ul>
				
			</li>';
	}
	?>
			
		</ul>
		
	</section>

</aside>