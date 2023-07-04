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
        <!--  CONTAINER MENU -->
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
    <section class="carousel">
        <div  id="Carousel" class="slide" data-ride="carousel">
            <div class="carousel-inner slide">
                <div  class="carousel-item active" data-interval="1000">
                    <img  class="d-block w-100" src="https://www.ironmaiden.com/media/tour/359749.jpg" alt="First slide">
                </div>

                <div class="carousel-item" data-interval="1000">
                    <img class="d-block w-100" src="https://i0.wp.com/rockandblog.net/wp-content/uploads/2018/09/73134.jpg?resize=1920%2C300" alt="Third slide">
                </div>
                <div class="carousel-item" data-interval="1000">
                    <img class="d-block w-100" src="https://www.ironmaiden.com/media/tour/359749.jpg" alt="Fourth slide">

                </div>  
            </div>
        </div>
    </section>         
<!-- CONTAINER CATEGORIAS -->
    <div class="container_categorias">
        <div class="categorias">
            <nav>
                <ul>
                    <div class="categorias_forma">
                        <li>

                            <ul>

                                <li><input type="submit" class="categoria" name="Enviar" value="Vinilos" style="
                                           background-image: url(https://www.vinyliciously.com/images/uploads/JUDAS-PRIEST---BRITISH-STEEL-RSD-2013-0.jpg)"></li>

                                <li><h5>Vinilos</h5</li>
                            </ul>
                        </li>

                        <li>
                            <ul>

                                <li><input type="submit" class="categoria" name="Enviar" value="Discos" style="
                                           background-image: url(https://widudesign.com/wp-content/uploads/2016/12/1973-Aladdin-Sane-David-Bowie-billboard-1000.jpg)"></li>

                                <li><h5>Discos</h5></li>
                            </ul>
                        </li>
                    </div>
                    <div class="categorias_forma">
                        <li>
                            <ul>
                                <li><input type="submit" class="categoria" name="Enviar" value="Comics" style="
                                           background-image: url(https://www.nopuedocreer.com/wp-content/images/2020/01/mandalorian2.jpg)"></li>
                                <li><h5>Comics</h5></li>
                            </ul>
                        </li>
                        <li>
                            <ul>
                                <li><input type="submit" class="categoria" name="Enviar" value="Mangas" style="
                                           background-image: url(https://areajugones.sport.es/wp-content/uploads/2021/08/one-piece-vol-100.jpg)"></li></li>
                        <li><h5>Mangas</h5></li>
                </ul>
                </li>

                </ul>
        </div>
        </nav>
    </div>
</div> 
<!--  MENU PRODUCTOS-->
<div class="Productos">
    <div class="menu_productos">
        <nav>
            <h4 style="text-align:center">Productos destacados</h4>
            <ul>

                <div class="categorias_forma2">
                    <li>

                        <a href="referencia_producto.php?id={{$mangasObj->getId()}}&nombre={{$mangasObj->getNombre()}}&precio={{$mangasObj->getPrecio()}}&stock={{$mangasObj->getStock()}}&imagen={{$mangasObj->getImagen()}}&tipo={{$mangasObj->getTipo()}}"><img src="{{$mangasObj->getImagen()}}"></a>
                    </li>
                    <li>
                        <a href="referencia_producto.php?id={{$discosObj->getId()}}&nombre={{$discosObj->getNombre()}}&precio={{$discosObj->getPrecio()}}&stock={{$discosObj->getStock()}}&imagen={{$discosObj->getImagen()}}&tipo={{$discosObj->getTipo()}}"><img src="{{$discosObj->getImagen()}}"></a>
                    </li>
                </div>
                <div class="categorias_forma2">
                    <li>
                        <a href="referencia_producto.php?id={{$comicsObj->getId()}}&nombre={{$comicsObj->getNombre()}}&precio={{$comicsObj->getPrecio()}}&stock={{$comicsObj->getStock()}}&imagen={{$comicsObj->getImagen()}}&tipo={{$comicsObj->getTipo()}}"><img src="{{$comicsObj->getImagen()}}"></a>
                    </li>
                    <li>
                        <a href="referencia_producto.php?id={{$vinilosObj->getId()}}&nombre={{$vinilosObj->getNombre()}}&precio={{$vinilosObj->getPrecio()}}&stock={{$vinilosObj->getStock()}}&imagen={{$vinilosObj->getImagen()}}&tipo={{$vinilosObj->getTipo()}}"><img src="{{$vinilosObj->getImagen()}}"></a>
                    </li>
                </div>
            </ul>
        </nav> 
    </div> 
</div>          
<!-- SELECCION  -->
<h4 style="text-align: center">Nuestra selección para ti</h4>
<div id="carouselExampleControls" class="carousel-styles  carousel slide" data-ride="carousel">
    <div class="carousel-inner ">
        <div class="carousel-item active carro1">
            @foreach($productos_random as $item)
            <a href="referencia_producto.php?id={{$item->getId()}}&nombre={{$item->getNombre()}}&precio={{$item->getPrecio()}}&stock={{$item->getStock()}}&imagen={{$item->getImagen()}}&tipo={{$item->getTipo()}}"><img class="carousel_img" src="{{$item->getImagen()}}"></a>

            @endforeach
        </div>
        <div class="carousel-item">
            @foreach($productos_sugeridos as $item)
            <a href="referencia_producto.php?id={{$item->getId()}}&nombre={{$item->getNombre()}}&precio={{$item->getPrecio()}}&stock={{$item->getStock()}}&imagen={{$item->getImagen()}}&tipo={{$item->getTipo()}}"><img  class="carousel_img" src="{{$item->getImagen()}}"></a>

            @endforeach
        </div>
        <div class="carousel-item">
            @foreach($productos_sugeridos2 as $item)
            <a href="referencia_producto.php?id={{$item->getId()}}&nombre={{$item->getNombre()}}&precio={{$item->getPrecio()}}&stock={{$item->getStock()}}&imagen={{$item->getImagen()}}&tipo={{$item->getTipo()}}"><img class="carousel_img" src="{{$item->getImagen()}}"></a>

            @endforeach
        </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>





<br><br>  
<!--  footer -->
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
