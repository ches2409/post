<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

			<!-- <li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>

			<li>
				<a href="usuarios">
					<i class="fa fa-user"></i>
					<span>Usuarios</span>
				</a>
			</li>

			<li>
				<a href="categorias">
					<i class="fa fa-th"></i>
					<span>Categorías</span>
				</a>
			</li>

			<li>
				<a href="productos">
					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>
				</a>
			</li>

			<li>
				<a href="clientes">
					<i class="fa fa-users"></i>
					<span>Clientes</span>
				</a>
			</li>

			<li>
				<a href="proveedores">
					<i class="fa fa-briefcase"></i>
					<span>Proveedores</span>
				</a>
			</li>

			<li class="treeview">

				<a href="#">
					<i class="fa fa-usd"></i>					
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
							<span>Crear venta</span>
						</a>
					</li>

					<li>
						<a href="reportes">							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>
						</a>
					</li>

				</ul>

			</li>

			<li class="treeview">

				<a href="#">

					<i class="fa fa-shopping-cart"></i>
					
					<span>compras</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">
					
					<li>

						<a href="compras">
							
							<i class="fa fa-circle-o"></i>
							<span>Administrar compras</span>

						</a>

					</li>

					<li>

						<a href="crear-compra">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear compra</span>

						</a>

					</li>

					<li>

						<a href="reportes-compras">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de compras</span>

						</a>

					</li>

				</ul>

			</li>

			<li>
				<a href="ayuda">
					<i class="fa fa-book"></i>
					<span>Ayuda</span>
				</a>
			</li>

			<li>
				<a href="acerca">
					<i class="fa fa-info-circle"></i>
					<span>Acerca de</span>
				</a>
			</li> -->


			<?php

				if($_SESSION["perfil"] == "Administrador"){

					echo '<li class="active">

						<a href="inicio">

							<i class="fa fa-home"></i>
							<span>Inicio</span>

						</a>

					</li>

					<li>

						<a href="usuarios">

							<i class="fa fa-user"></i>
							<span>Usuarios</span>

						</a>

					</li>';

				}

				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){

					echo '<li>

						<a href="categorias">

							<i class="fa fa-th"></i>
							<span>Categorías</span>

						</a>

					</li>

					<li>

						<a href="productos">

							<i class="fa fa-product-hunt"></i>
							<span>Productos</span>

						</a>

					</li>';

				}

				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

					echo '<li>

						<a href="clientes">

							<i class="fa fa-users"></i>
							<span>Clientes</span>

						</a>

					</li>
					
					<li>
						<a href="proveedores">
							<i class="fa fa-briefcase"></i>
							<span>Proveedores</span>
						</a>
					</li>'

					;

				}

				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Vendedor"){

					echo '<li class="treeview">

						<a href="#">

							<i class="fa fa-usd"></i>
							
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
									<span>Crear venta</span>

								</a>

							</li>';

							if($_SESSION["perfil"] == "Administrador"){

							echo '<li>

								<a href="reportes">
									
									<i class="fa fa-circle-o"></i>
									<span>Reporte de ventas</span>

								</a>

							</li>';

							}

						

						echo '</ul>

					</li>';

				}
				if($_SESSION["perfil"] == "Administrador" || $_SESSION["perfil"] == "Especial"){
					echo '<li class="treeview">

							<a href="#">

								<i class="fa fa-shopping-cart"></i>
								
								<span>compras</span>
								
								<span class="pull-right-container">
								
									<i class="fa fa-angle-left pull-right"></i>

								</span>

							</a>

							<ul class="treeview-menu">
								
								<li>

									<a href="compras">
										
										<i class="fa fa-circle-o"></i>
										<span>Administrar compras</span>

									</a>

								</li>

								<li>

									<a href="crear-compra">
										
										<i class="fa fa-circle-o"></i>
										<span>Crear compra</span>

									</a>

								</li>

								<li>';
									if($_SESSION["perfil"] == "Administrador"){
									echo'<li>
									<a href="reportes-compras">
										
										<i class="fa fa-circle-o"></i>
										<span>Reporte de compras</span>

									</a>

								</li>';
									}

								echo '
							</ul>

						</li>';
				}

			?>

			<li>
				<a href="ayuda">
					<i class="fa fa-book"></i>
					<span>Ayuda</span>
				</a>
			</li>

			<li>
				<a href="acerca">
					<i class="fa fa-info-circle"></i>
					<span>Acerca de</span>
				</a>
			</li> 



		</ul>

	 </section>

</aside>