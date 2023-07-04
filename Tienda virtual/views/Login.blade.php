@extends('master') 

@section('content')
<form action="index.php" method="POST">
    <div class="header_login">
        <div class="logo">
            <li class="logo_inicio"><input type="submit" class="logo_login" name="Enviar" value="Volver" style="
                                           background-image: url(https://i.pinimg.com/originals/96/9c/b0/969cb05d88c675fadd1f340ede5e1c11.jpg)"></li>
        </div>
    </div>
<!-- CONTENEDOR LOGIN -->
    <div class="contenedor_login">
        <div class="menu_login">
            <div><h1>Iniciar sesión</h1></div>
            @if (!empty($mensaje))
            <div style="color:red">{{$mensaje}}</div>
            @endif

            <div><input type="text" name="email" placeholder="E-mail*" class="login_input"></div>
            <br>
            <div><input type="password" name="passw" id="passw" placeholder="Contra*"  class="login_contra" ><input style="margin-left:5px;"type="checkbox" onclick="toggle('passw')"></div>
            <br>
            <input type="submit" name="Enviar" value="Iniciar sesión"class="login_enviar">
            
            <br>
              <input type="submit" name="Enviar" value="Has olvidado la contraseña"class="login_enviar">

            <br>
            <div>
                ¿Eres nuevo cliente?
            </div>
            <br>
            <input type="submit" name="Enviar" value="Crear cuenta" class="login_enviar" >
            <br>
            </form>   
            <div>
            </div>            


            @endsection