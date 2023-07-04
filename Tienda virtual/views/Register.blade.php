@extends('master') 

@section('content')


<form action="index.php" method="POST">
    <div class="header_register">
        <div class="logo">
            <li class="logo_inicio"><input type="submit" class="logo_login" name="Enviar" value="Volver" style="
                                           background-image: url(https://i.pinimg.com/originals/96/9c/b0/969cb05d88c675fadd1f340ede5e1c11.jpg)"></li>
        </div>
    </div>

<!-- CONTENEDOR REGISTRO -->
    <div class="contenedor_registro">
        <div class="menu_registro">  
            <div><h1>Registrar</h1></div>
            @if (!empty($mensaje))
            <div style="color:red">{{$mensaje}}</div>
            @endif


            @if (!empty($error_nombre))
            <div style="color:red">Nombre no valido</div>
            <div><input type="text" name="nombre" placeholder="Nombre*"  class="register_estilo"></div>
            <br>

            @else
            <?php if (!isset($nombre)) { ?>
                <div><input type="text" name="nombre" placeholder="Nombre*"  class="register_estilo"></div>
                <br>
            <?php } else { ?>
                <div><input type="text" name="nombre" value="<?php echo $nombre ?>"  class="register_estilo"></div>
                <br> 
            <?php } ?>

            @endif

            @if (!empty($error_email))
            <div style="color:red">Email no valido</div>
            <div><input type="text" name="email" placeholder="Email*"  class="register_estilo"></div>
            <br>

            @else
            <?php if (!isset($email)) { ?>
                <div><input type="text" name="email" placeholder="Email*"  class="register_estilo"></div>
                <br>
            <?php } else { ?>
                <div><input type="text" name="email" value="<?php echo $email ?>"  class="register_estilo"></div>
                <br> 
            <?php } ?>

            @endif

            @if (!empty($error_password))
            <div style="color:red">Contraseña no valida</div>
            <div><input type="password" name="passw" id="passw" placeholder="Contra*"  class="register_contra"><input style="margin-left:5px;" type="checkbox" onclick="toggle('passw')"></div>
            <br>

            @else
            <?php if (!isset($password)) { ?>
                <div><input type="password" name="passw" id="passw" placeholder="Contra*" class="register_contra"><input style="margin-left:5px;"type="checkbox" onclick="toggle('passw')"></div>
                <br>
            <?php } else { ?>
                <div><input type="password" name="passw"  id="passw" value="<?php echo $password ?>"  class="register_contra"><input style="margin-left:5px;"type="checkbox" onclick="toggle('passw')"></div>
                <br> 
            <?php } ?>
            @endif



            @if (!empty($error_contra))
            <div style="color:red">Contraseña no valida</div>
            <div><input type="password" name="pass" id="pass" placeholder="Repetir contra*"  class="register_contra"><input style="margin-left:5px;" type="checkbox" onclick="toggle('pass')"></div>
            <br>

            @else
            <?php if (!isset($password)) { ?>
                <div><input type="password" name="pass" id="pass" placeholder="Repetir contra*"  class="register_contra"><input style="margin-left:5px"; type="checkbox" onclick="toggle('pass')"></div>
                <br>
            <?php } ?>
            @endif






            <input type="submit" name="Enviar" value="Registrar"  class="register_enviar">
            <br>
            </form>
        </div>
    </div>



    @endsection