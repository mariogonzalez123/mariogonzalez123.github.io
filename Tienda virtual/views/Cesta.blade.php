@extends('master') 

@section('content')
<form action="index.php" method="POST">
    <header>
        @if (!empty($texto))
        {{$texto}}
        @endif
          <!-- HEADER-->
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
                        <input type="submit" name="Enviar" value="Compromisos" class="input_header"> 
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
          <!-- MENU DEL CONTAINER-->
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
    <br><br><br><br>

       <!--CONTAINER DONDE SE MUESTRAN LOS PRODUCTOS REGISTRADOS EN LA CESTA-->
    <div class="container">
        <div class="card">    
            <div class="card-header">
                <h3 class="header-carrito">Productos</h3>
            </div>    
            <div class="card-body">
                <table class="table table-hover">
                    @if(empty($carrito))
                    <th>No hay productos en la cesta</th>

                    @else
                    <thead>
                    <th></th>
                    <th>Nombre</th>
                    <th>Unidades</th>
                    <th>Precio</th>
                    <th></th>
                    </thead> 
                    <tbody>
                        @foreach($carrito as $producto)
                        <tr>
                            <td><img  class="img_cesta" src="{{$producto->getImagen()}}"></td>
                            <td><h5>{{$producto->getNombre()}}</h5></td>
                            <td><h5>{{$producto->getCantidad()}}</h5></td>
                            <td><h5>{{$producto->getPrecio()}} $</h5></td>
                            <td><h5><a href="Eliminar.php?id={{$producto->getId()}}">Eliminar</a></h5></td>
                        </tr>
                        @endforeach    
                    </tbody>
                    @endif

                </table>   
            </div>
        </div>    
    </div>
    <br>
    <!-- VACIAR CESTA Y SEGUIR COMPRANDO-->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <input  class="input_vaciar_cesta" type="submit" name="Enviar" value="Vaciar Cesta">
                <input  class="input_comprando" type="submit" name="Enviar" value="Seguir Comprando">

            </div>
        </div>    
    </div> 

    <br> 
    <!-- PRECIO TOTAL DE LA COMPRA -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Resumen</h3>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td><h3>Total</h3></td>
                                <td>
                                    <h3 style="float:right">{{$precio_total}} €</h3>
                                </td>
                            </tr>
                        </thead>  
                    </table>   
                </div>   
            </div>
        </div>    
    </div> 

    <div class="container">
        <div class="card">
            <div class="card-header" style="text-align: center">
                @if(empty($carrito) || empty($usuario))
                <input class="guardar" type="submit" name="Enviar"  disabled value="Guardar y comprar">
                @else
                <input class="guardar" type="submit" name="Enviar"   value="Guardar y comprar">
                @endif
            </div>   
        </div> 
    </div> 
</tbody>
</table>
</div>
</div>
</div>
<br><br><br>

<!-- Site footer -->
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



            </form>   

            @endsection