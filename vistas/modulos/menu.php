<aside class="main-sidebar">
	 <section class="sidebar">
		<ul class="sidebar-menu">
			
			<li class="active">
				<a href="inicio">
					<i class="fa fa-home"></i>
					<span>Inicio</span>
				</a>
			</li>
           
            <?php
			 if($_SESSION["perfil"] == "Administrador"){
			 	echo '<li>
						<a href="usuarios">
							<i class="fa fa-user"></i>
							<span>Usuarios</span>
						</a>
					</li>';
			 }// fin if	
            ?>  
		  	         
  	        <li>
				<a href="pagos">
					<i class="fa fa-money"></i>
					<span>Gastos</span>
				</a>
			</li>
  			

  			<li>
				<a href="clientes">
					<i class="fa fa-users"></i>
					<span>Clientes</span>
				</a>
			</li>

			<li>
				<a href="facturas">
					<i class="fa fa-newspaper-o"></i>
					<span>USA</span>
				</a>
			</li>

			<li>
				<a href="proveedores">
					<i class="fa fa-cubes"></i>
					<span>Proveedores</span>
				</a>
			</li>
			
			<li>
				<a href="casos">
					<i class="fa fa-list-alt"></i>
					<span>Recepción</span>
				</a>
			</li>

			<li>
				<a href="productos">
					<i class="fa fa-clipboard"></i>
					<span>Inventario</span>
				</a>
			</li> 
		    
			<li>
				<a href="ordenes">
					<i class="fa fa-ship"></i>
					<span>Dima Ordenes</span>
				</a>
			</li>
			<li> 
				<a href="ordenesDima">
					<i class="fa fa-car"></i>
					<span>Dima Old</span>
				</a>
			</li>
			<li> 
				<a href="aseguradoras">
					<i class="fa fa-file"></i>
					<span>Aseguradoras</span>
				</a>
			</li>

			
		</ul>

	 </section>

</aside>