@extends('master') 

@section('content')



<form action="index.php" method="POST">
    <header>
        @if (!empty($texto))
        {{$texto}}
        @endif
          <!-- HEADER -->
        <div class="header_superior">
            <div class="logo">

                <li class="logo_inicio"><input type="submit" class="logo_inicio" name="Enviar" value="Volver" style="
                                               background-image: url(https://i.pinimg.com/originals/96/9c/b0/969cb05d88c675fadd1f340ede5e1c11.jpg)"></li>
            </div>
            <div class="search">

                <input type="text" placeholder="Buscar" name="busqueda" id="busqueda">
                <button type="submit" name="Enviar" value="buscar"><img src="/public/assets/imgs/lupa.png" height="12" width="18">

                    </div>
                    <div class="compromisos">
                        <img src="https://cdn-icons-png.flaticon.com/512/1067/1067555.png" height="30" width="30">
                        <input type="submit" name="Enviar" value="Compromisos"class="input_header"> 
                    </div>
                    <div class="login">
                        @if(empty($usuario))
                        <img src="https://img1.freepng.es/20181130/ibg/kisspng-computer-icons-scalable-vector-graphics-login-clip-5c020cab6b8720.4616597715436381874404.jpg" height="30" width="30"></a>
                        <input type="submit" name="Enviar" value="Mi cuenta" class="input_header"> 
                        @else
                        <img src="https://img1.freepng.es/20181130/ibg/kisspng-computer-icons-scalable-vector-graphics-login-clip-5c020cab6b8720.4616597715436381874404.jpg" height="30" width="30"></a>
                        <input type="submit" name="Enviar" value="Cerrar sesión" class="input_header"> 
                        @endif
                    </div>
                    <div class="cesta">
                        <img src="/public/assets/imgs/carrito.png" height="30" width="30">
                        <input type="submit" name="Enviar" value="Mi cesta" class="input_header"> 
                    </div>
            </div>  
          <!-- CONTAINER MENU -->
            <div class="container__menu">
                <div class="menu">
                    <nav>
                        <ul>

                            <li><div>Productos</div>
                                <ul>
                                    <li><input type="submit" name="Enviar" value="Comics"></li>
                                    <li><input type="submit" name="Enviar" value="Mangas"></li>
                                    <li><input type="submit" name="Enviar" value="Discos"></li>
                                    <li><input type="submit" name="Enviar" value="Vinilos"></li>
                                </ul>

                            </li>
                            <li><input type="submit" name="Enviar" value="Comics"></li>
                            <li><input type="submit" name="Enviar" value="Mangas"></li>
                            <li><input type="submit" name="Enviar" value="Discos"></li>
                            <li><input type="submit" name="Enviar" value="Vinilos"></li>

                        </ul>
                    </nav>
                </div>  
            </div>
    </header>
    <br><br><br>
    <!--  CONTAINER DONDE SE MUESTRAN TODOS COMICS DE LA TIENDA.-->
    <div class="container">
        <div class="card">    
            <div class="card-header">
                <h3 class="header-carrito">Comics</h3>
            </div>    
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                    <th></th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th></th>
                    </thead> 
                    <tbody>
                        @foreach($comics as $busqueda)
                        <tr>
                            <td><a href="referencia_producto.php?id={{$busqueda->getId()}}&stock={{$busqueda->getStock()}}&nombre={{$busqueda->getNombre()}}&precio={{$busqueda->getPrecio()}}&stock={{$busqueda->getStock()}}&imagen={{$busqueda->getImagen()}}&tipo={{$busqueda->getTipo()}}"><img  style="width:100px; height:100px;"src="{{$busqueda->getImagen()}}"></a></td>
                            <td><h5>{{$busqueda->getNombre()}}</h5></td>
                            <td><h5>{{$busqueda->getPrecio()}} $</h5></td>
                            
                            @if($disponibilidad[$cont++] == "true")
                            <td style="color:red">Este producto ya esta añadido en el carrito</td>
                            @elseif($busqueda->getStock()!=0)
                              <td><a href="Añadir.php?nombre={{$busqueda->getNombre()}}&stock={{$busqueda->getStock()}}&precio={{$busqueda->getPrecio()}}&cantidad=1&id={{$busqueda->getId()}}&imagen={{$busqueda->getImagen()}}&tipo={{$busqueda->getTipo()}}">Añadir Al carrito</a></td>
                           
                            @else
                             <td style="color:red">No hay Stock</td>
                            @endif
                        </tr>

                        @endforeach    
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>

    <!-- footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h6>Sobre nosotros</h6>
                    <p class="text-justify">Pow.com <i>POW WANTS TO BE SIMPLE </i> es una iniciativa para ofrecer el mejor producto posible a nuestros clientes , nos comprometos además a tener los precios más competitivos para nuestros clientes. Y ofrecer una asistencia a nuestros clientes de calidad</p>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6></h6>
                    <ul class="footer-links">

                    </ul>
                </div>

                <div class="col-xs-6 col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="footer-links">
                        <li><input  class="ft-link" type="submit" name="Enviar" value="Compromisos"> </li>
                        <li><input class="ft-link"type="submit" name="Enviar" value="Comics"></li>
                        <li><input class="ft-link" type="submit" name="Enviar" value="Mangas"></li>
                        <li><input class="ft-link" type="submit" name="Enviar" value="Discos"></li>
                        <li><input class="ft-link" type="submit" name="Enviar" value="Vinilos"></li>
                    </ul>
                </div>
            </div>
            <hr>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2022 All Rights Reserved by 
                        <a href="#">Pow</a>.
                    </p>
                </div>
                </footer>









                @endsection
