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
        <!-- CONTAINER DONDE SE MUESTRA LA INFORMACIÓN DE UN PRODUCTO. -->
        <div class="container">
            <div class="card">    
                <div class="card-header">
                    <h3>Producto</h3>
                </div>    
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                        </thead> 
                        <tbody>
                            <tr>
                                <td> <img style="width:370px;height:370px" src="{{$imagen}}"></td> 
                                <td>


                                    <h2>{{$nombre}}.</h2>
                                    <h3 style="color:#f55a00;">{{$precio}}$.</h3>
                                    Envío:<h5 style="display:inline; color:greenyellow"> Envío GRATIS.</h5></br>
                                    Devolución:<h5 style="display:inline; color:greenyellow"> Devolución GRATIS.</h5></br>

                                    Cantidad:   <input  style="width:50px"; type="number" min="1" max="10" value="1" name="cantidad"><br> 
                                    @if(isset($aviso))
                                    <h5 style="color:red">{{$aviso}}</h5>
                                    @endif
                                    @if($stock > 0)
                                    Stock:<h5 style="display:inline; color:greenyellow"> En stock.</h5></br>
                                    @else
                                    Stock:<h5 style="display:inline; color:red"> Fuera de stock.</h5></br>
                                    @endif
                                    Garantía: <h5 style="display:inline;  background-color:wheat; color:purple"> Garantía de sustitución en 24h.</h5></br><br>
                                    <div style="background: wheat; margin-top: 5px">
                                        Nuestro servicio de garantía integral durante 1 mes te garantiza la sustitución o rembolso en un plazo de 24h*
                                        de aquellos productos que resulten defectuosos.
                                    </div><br>
                                    @if($stock > 0)
                                    <input class="boton_comprar" type="submit" name="Enviar" value="Comprar">
                                    <input class="boton_carrito" type="submit" name="Enviar" value="Añadir al carrito"> 
                                    @else
                                    <input class="boton_comprar" disabled type="submit" name="Enviar" value="Comprar">
                                    <input class="boton_carrito"  disabled type="submit" name="Enviar" value="Añadir al carrito"> 
                                    @endif
                                </td>

                            </tr>
                        </tbody>
                    </table>   
                </div>
            </div>    
        </div>
        <input type="text" name="id"  value="{{$id}}" hidden>
        <input type="text" name="nomb" value="{{$nombre}}" hidden>
        <input type="text" name="precio" value="{{$precio}}" hidden>
        <input type="text" name="imagen" value="{{$imagen}}" hidden>
        <input type="text" name="tipo" value="{{$tipo}}" hidden>
        <input type="text" name="stock" value="{{$stock}}" hidden>

        </tbody>
        </table>
        </div>
        </div>
        </div>
        <br><br>
        <!-- OTROS PRODUCTOS POSIBLES -->
   <h4 style="text-align: center">Otros Productos</h4>
<div id="carouselExampleControls" class="carousel-styles  carousel slide" data-ride="carousel">
    <div class="carousel-inner ">
        <div class="carousel-item active carro1">
            @foreach($otros_productos as $item)
            <a href="referencia_producto.php?id={{$item->getId()}}&nombre={{$item->getNombre()}}&precio={{$item->getPrecio()}}&stock={{$item->getStock()}}&imagen={{$item->getImagen()}}&tipo={{$item->getTipo()}}"><img class="carousel_img" src="{{$item->getImagen()}}"></a>

            @endforeach
        </div>
    </div>
</div>


        
        
        
        
        
        
        <br><br>

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