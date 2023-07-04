@extends('master') 

@section('content')
<form action="index.php" method="POST">
    <header>
        @if (!empty($texto))
        {{$texto}}
        @endif

        <div class="header_superior">
            <div class="logo">

                <li class="logo_inicio"><input type="submit" class="logo_inicio" name="Enviar" value="Volver" style="
                                               background-image: url(https://i.pinimg.com/originals/96/9c/b0/969cb05d88c675fadd1f340ede5e1c11.jpg)"></li>
            </div>
    </header>


<!--  CONTENEDOR RESUMEN-->
    <br> 
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Compra realizada con exito</h3>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <td><h3>Resumen</h3></td>

                                <td>




                                    <h3 style="float:right">{{$precio_total}} $</h3>
                                </td>
                            </tr>
                        </thead>  
                    </table>   
                </div>   
            </div>
        </div>    
    </div>
    <br>
    <!-- INFORMACIÓN DE LA FACTURACIÓN -->
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Datos de facturación</h3>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th><th>{{$nombre}}</th>
                            </tr>
                            <tr>
                                <th>Provincia</th><th>{{$ciudad}}</th>
                            </tr>
                            <tr>
                                <th>Calle</th><th>{{$via}}</th>
                            </tr>
                            <tr>
                                <th>Dirección</th><th>{{$direccion}}</th>
                            </tr>
                            <tr>
                                <th>Código Postal</th><th>{{$cp}}</th>
                            </tr>
                        </thead> 
                        <tbody>

                        </tbody>
                    </table>   
                </div>   
            </div>
        </div>    
    </div> 

    <br><br><br><br><br>

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