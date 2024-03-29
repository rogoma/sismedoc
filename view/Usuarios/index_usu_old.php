<?php 
 include("../../config/conexion.php");
 include("../../config/conexion2.php");
if (!isset($_SESSION["idusuarios"])) {
  header("Location: http://localhost/sismedoc/login/");
}
$iduser=$_SESSION["idusuarios"];
$foto=$_SESSION["foto"];
$dni=$_SESSION["dni"];

$consulta=mysqli_query($conexion,"select idinstitucion, area from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea and dni='$dni';");
$area = mysqli_fetch_assoc($consulta);

$institucion=mysqli_query($conexion,"select * from institucion where idinstitucion='1'");
$row = mysqli_fetch_assoc($institucion);

$query1=mysqli_query($conexion,"SELECT * FROM roles");

$query2=mysqli_query($conexion,"SELECT * FROM roles");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISMEDOC-SENASA</title>

  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="/sismedoc/public/assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="/sismedoc/public/assets/dist/css/adminlte.min.css">
  <link rel="icon shortcut" href="/sismedoc/public/assets/img/logo.png">
  <link rel="stylesheet" href="/sismedoc/public/assets/fonts/ionicons.css">
  <link rel="stylesheet" href="/sismedoc/public/assets/fonts/feather.css">
  <link rel="stylesheet"  href="/sismedoc/public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/sismedoc/public/assets/plugins/select2/css/select2.min.css">

  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> 

</head>

<body class="hold-transition sidebar-mini layout-fixed">

  <!-- MODAL CONFIRMACION CERRAR SESION -->
  <div class="modal fade" id="mimodal" aria-modal="true" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">Confirmación:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>¿Seguro que quiere cerrar la Sesión Actual?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">No. Continuar </button>
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" onclick="salir()">Sí. Salir</button>
        </div>
      </div>
    </div>
  </div>

      <!-- MODAL EDICIÓN DE USUARIO-->
      <div class="modal fade" id="modalUsu">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">DATOS DEL  PERFIL DEL USUARIO</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="formperfil">
                      <input type="hidden" class="form-control" name="idusup" id="idusup">
                      <input type="hidden" class="form-control" name="idperp" id="idperp">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Cédula</label>
                              <input type="text" class="form-control" name="idnip" id="idnip" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Nombres</label>
                              <input type="text" class="form-control" name="inombrep" id="inombrep">
                          </div>
                        </div>
                      </div>

                      <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputName">Apellido Paterno</label>
                                <input type="text" class="form-control" name="iappatp" id="iappatp">
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Apellido Materno</label>
                              <input type="text" class="form-control" name="iapmatp" id="iapmatp">
                          </div>
                        </div>
                      </div>                                        

                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Celular</label>
                              <input type="text" class="form-control"  name="icelp" id="icelp">
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Dirección</label>
                              <input type="text" class="form-control"  name="idirp" id="idirp">
                          </div>
                        </div>                      
                      </div>
                      
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputMessage">Email</label>
                              <input type="email" class="form-control1"  name="iemailp" id="iemailp">
                          </div>
                        </div>
                        
                        <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputEmail">Nombre Usuario</label>
                              <input type="text" class="form-control1"  name="inomusup"  id="inomusup">
                          </div>
                        </div>
                      </div>
                   
                </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button style="height: 40px;width: 180px;" type="button" class="btn btn-primary" id="Actualizar">Actualizar Datos</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>

  <!-- MODAL FOTO-->
  <div class="modal fade" id="modalfotop"  >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">ACTUALIZAR FOTO DE PERFIL:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="FormFotop">
        <div style="text-align:center;" class="modal-body">
          <h1 style="font-family:arial;font-size:20px;font-weight:600">Foto de perfil Actual</h1>  
            <img style="widht: 150px; height:150px;" src="/sismedoc/<?php echo $foto?>" id="Fotope" name="Fotope">
          <br><br>
          <div class="form-group">
              <label>Elegir Foto (jpg)</label><span style="color: red;font-weight: 600;"> (*)</span>
              <div class="file">
                  <input type="hidden" id="opcion" name="opcion" value='13'>
                  <input type="hidden" id="iddni2" name="iddni2" value="<?php echo $dni;?>">
                  <input type="hidden" id="idusua2" name="idusua2" value="<?php echo $iduser;?>">
                  <input type="file" id="idfilep" name="idfilep" required accept=".jpg">
              </div>
    
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar </button>
          <button style="height:40px;width:120px" type="submit" class="btn btn-primary" id="CambiarP">Cambiar</button>
        </div>
        </form>
      </div>
    </div>
</div>

<!-- MODAL CAMBIO DE CONTRASEÑA-->
<div class="modal fade" id="modaleditpswG">
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">CAMBIO DE CONTRASEÑA:</h4>
          &nbsp;<b id="idc" style="color:#8C0505;font-size: 1.4rem;"></b> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          <form id="formCG">
            <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="password" class="form-control1" name="ipswG" id="ipswG"/>
            </div><div class="form-group">
                <label>Contraseña Nueva</label>
                <input type="password" class="form-control1" name="ipasss1G" id="ipasss1G"/>
            </div><div class="form-group">
                <label>Confirmar nueva contraseña</label>
                <input type="password" class="form-control1" name="ipassco1G" id="ipassco1G"/>
                <b id="error3"></b>
            </div> 
          </form> 
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal" id="SalirC">Cancelar </button>
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" id="BtnContraG">Actualizar</button>
        </div>
      </div>
    </div>
</div>

<!-- MODAL DATOS INSTITUCIÓN-->
<div class="modal fade" id="modalinstitu">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">DATOS DE LA INSTITUCIÓN:</h4>
          &nbsp;<b id="idc" style="color:#8C0505;font-size: 1.4rem;"></b> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          <form id="formInst">
            <div class="form-group">
                <input type="hidden" class="form-control" name="idinst" id="idinst">
                <label>RUC (*)</label>
                <input type="text" class="form-control" name="iruci" id="iruci">
            </div><div class="form-group">
                <label>Razón (*)</label>
                <input type="text" class="form-control" name="irazoni" id="irazoni">
            </div><div class="form-group">
                <label>Dirección (*)</label>
                <input type="text" class="form-control" name="idirei" id="idirei">
                <b id="error3"></b>
            </div> 
          </form> 
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal" id="SalirI">Cancelar </button>
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" id="BtnEditInsti">Editar datos</button>
        </div>
      </div>
    </div>
</div>

<!-- ************************** GENERAL *********************************** -->

  <!-- MODAL INGRESO DE USUARIO-->
      <div class="modal fade" id="modalusuario">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">GESTIÓN DE USUARIOS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="formnew">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Cédula</label>
                            <input type="text" class="form-control" name="idni" id="idni" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                            <b id="Aviso"></b>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Nombres</label>
                            <input type="text" class="form-control" name="inombre" id="inombre">
                        </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Apellido Paterno</label>
                              <input type="text" class="form-control" name="iappat" id="iappat">
                          </div>
                       </div>
                       
                       <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Apellido Materno</label>
                            <input type="text" class="form-control" name="iapmat" id="iapmat">
                        </div>
                      </div>
                     </div>                                        

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Celular</label>
                            <input type="text" class="form-control"  name="icel" id="icel">
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Dirección</label>
                            <input type="text" class="form-control"  name="idir" id="idir">
                        </div>
                      </div>                      
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputMessage">Email</label>
                            <input type="email" class="form-control1"  name="iemail" id="iemail">
                            <b id="AvisoE"></b>
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Nombre Usuario</label>
                            <input type="text" class="form-control1"  name="inomusu"  id="inomusu">
                            <b id="error1"></b>
                        </div>
                      </div>
                    </div>

                    <div  class="row">
                      <div class="col-sm-4">
                          <div class="form-group">
                            <label>Rol</label> &nbsp;
                            <a style="width:20px;height:30px" class="btn btn-flat bg-success">...</a>
                            <select class="form-control" name="tipo" id="tipo">
                                 <?php while($datos=mysqli_fetch_array($query1)) {?>
                                    <option value="<?php echo $datos['idroles']  ?>"> <?php echo $datos['rol'] ?></option>
                                <?php }?>
                            </select> 
                            
                          </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" class="form-control"  name="ipasss" id="ipasss"/>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                            <label for="inputEmail">Confirmar Contraseña</label>
                            <input type="password" class="form-control"  name="ipassco" id="ipassco"/>
                            <p id="error2"></p>
                        </div>
                      </div>
                    </div>
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarcampos()">Cancelar</button>
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="guardar">Registrar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

  <!-- MODAL EDICIÓN DE USUARIO-->
  <div class="modal fade" id="modalEdusuario">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header" id="modal-header">
              <h4 style="font-weight:600" class="modal-title" id="modal-title">EDICIÓN DE USUARIOS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="formEdit">
                    <input type="hidden" class="form-control" name="idusu" id="idusu">
                    <input type="hidden" class="form-control" name="idper" id="idper">
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Cédula</label>
                            <input type="text" class="form-control" name="idni" id="idni1" onkeypress='return validaNumericos(event)' maxlength="8" minlength="8">
                            <b id="Aviso"></b>
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Nombres</label>
                            <input type="text" class="form-control" name="inombre" id="inombre1">
                        </div>
                      </div>
                    </div>

                     <div class="row">
                       <div class="col-sm-6">
                          <div class="form-group">
                              <label for="inputName">Apellido Paterno</label>
                              <input type="text" class="form-control" name="iappat" id="iappat1">
                          </div>
                       </div>
                       
                       <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputName">Apellido Materno</label>
                            <input type="text" class="form-control" name="iapmat" id="iapmat1">
                        </div>
                      </div>
                     </div>                                        

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Celular</label>
                            <input type="text" class="form-control"  name="icel" id="icel1">
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Dirección</label>
                            <input type="text" class="form-control"  name="idir" id="idir1">
                        </div>
                      </div>                      
                    </div>
                    
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputMessage">Email</label>
                            <input type="email" class="form-control1"  name="iemail" id="iemail1">
                            <b id="AvisoE"></b>
                        </div>
                      </div>
                      
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label for="inputEmail">Nombre Usuario</label>
                            <input type="text" class="form-control1"  name="inomusu"  id="inomusu1">
                            <b id="error1"></b>
                        </div>
                      </div>
                    </div>

                    <div  class="row">
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Rol</label> &nbsp;
                            <a style="width:20px;height:30px" class="btn btn-flat bg-success">...</a>
                            <select class="form-control" name="tipo" id="tipo1">
                                 <?php while($datos=mysqli_fetch_array($query2)) {?>
                                    <option value="<?php echo $datos['idroles']?>"> <?php echo $datos['rol']?></option>
                                <?php }?>
                            </select> 
                          </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                            <label>Estado</label> &nbsp;
                            <select class="form-control" name="estado1" id="estado1">
                                    <option value="ACTIVO">ACTIVO</option>
                                    <option value="INACTIVO">INACTIVO</option>
                            </select> 
                          </div>
                      </div>
                    </div>
            </form>
            </div>
            <div class="modal-footer justify-content-between">
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal" onclick="limpiarcampos()">Cancelar</button>
              <button style="height: 40px;width: 120px;" type="button" class="btn btn-primary" id="Editar">Editar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
  </div>
  
<!-- MODAL CAMBIO DE CONTRASEÑA-->
<div class="modal fade" id="modaleditpsw1"  >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">CAMBIO DE CONTRASEÑA:</h4>
          &nbsp;<b id="idc" style="color:#8C0505;font-size: 1.4rem;"></b> 
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">  
          <form id="formC">
            <div class="form-group">
                <label>Contraseña Actual</label>
                <input type="password" class="form-control1" name="ipsw" id="ipsw"/>
            </div><div class="form-group">
                <label>Contraseña Nueva</label>
                <input type="password" class="form-control1" name="ipasss1" id="ipasss1"/>
            </div><div class="form-group">
                <label>Confirmar nueva contraseña</label>
                <input type="password" class="form-control1" name="ipassco1" id="ipassco1"/>
                <b id="error3"></b>
            </div> 
          </form> 
        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal" id="SalirC">Cancelar </button>
          <button style="height:40px;width:120px" type="button" class="btn btn-primary" id="BtnContra">Actualizar</button>
        </div>
      </div>
    </div>
</div>
                                 
  <!-- MODAL FOTO-->
  <div class="modal fade" id="modalfoto"  >
   <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 style="font-weight:600" class="modal-title">ACTUALIZAR FOTO DE PERFIL:</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="FormFoto">
        <div style="text-align:center;" class="modal-body">
          <h1 style="font-family:arial;font-size:20px;font-weight:600">Foto de perfil Actual</h1>  
          <img style="widht: 150px; height:150px;" id="FotoP" name="FotoP">
          <br><br>
          <div class="form-group">
              <label>Elegir Foto (jpg)</label><span style="color: red;font-weight: 600;"> (*)</span>
              <div class="file">
                  <input type="hidden" id="opcion" name="opcion" value='10'>
                  <input type="hidden" id="iddni1" name="iddni1">
                  <input type="hidden" id="idusua" name="idusua">
                  <input type="file" id="idfile1" name="idfile1" required accept=".jpg">
              </div>
    
          </div>

        </div>
        <div class="modal-footer justify-content-between">
          <button style="height:40px;width:120px" type="button" class="btn btn-danger" data-dismiss="modal">Cancelar </button>
          <button style="height:40px;width:120px" type="submit" class="btn btn-primary" id="CambiarF">Cambiar</button>
        </div>
        </form>
      </div>
    </div>
</div>

  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark navbar-cyan">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>&nbsp;&nbsp;&nbsp;
        <li class="nav-item">
        <h3 style="margin:8px 0;font-size:20px;font-weight:600">ÁREA: <?php echo $area['area'];?></h3>
        <input id="idarealogin" name="idarealogin" type="hidden" value="<?php echo $area['area'];?>">
        <input id="idinstitu" name="idinstitu" type="hidden" value="<?php echo $area['idinstitucion'];?>">
          <input id="iduser" name="iduser" type="hidden" value="<?php echo $iduser;?>">
          <input id="dniuser" name="dniuser" type="hidden" value="<?php echo $dni;?>">
        </li>
        <!-- <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"><span style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;font-weight: 500;" > Buscar</span></i>
        </a> -->
      </ul>
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">

          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Buscar..."
                  aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->

        <!-- Notifications Dropdown Menu -->
        <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <div class="demo-navbar-user nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
            <span class="d-inline-flex flex-lg-row-reverse align-items-center align-middle">
                <img src="/sismedoc/<?php echo $foto?>" alt class="d-block ui-w-30 rounded-circle">
                <span class="px-1 mr-lg-2 ml-2 ml-lg-0">
                  <?php echo utf8_decode($_SESSION['nombre']);?>
                </span>
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <?php if($area['area'] == "ADMIN SISTEMA"){?>
          <a class="dropdown-item" id="institut" data-toggle="modal">
                  <i class="feather icon-info text-muted"></i> &nbsp; Institución</a><?php }?>
              <a  class="dropdown-item" id="Fot" data-toggle="modal">
                  <i class="feather icon-user text-muted"></i> &nbsp; Cambiar Foto</a>
              <a class="dropdown-item" id="Conf" data-toggle="modal">
                  <i class="feather icon-settings text-muted"></i> &nbsp; Datos del Perfil</a>
                  <a class="dropdown-item" id="contra" data-toggle="modal">
                  <i class="feather icon-settings text-muted"></i> &nbsp; Cambiar Contraseña</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" data-toggle="modal" href="#mimodal">
                  <i class="feather icon-power text-danger"></i> &nbsp; Salir</a>
        </div>
      
    </div>
      </ul>
    </nav>
    <!-- /.navbar -->


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a class="brand-link navbar-lightblue">
        <img src="/sismedoc/<?php echo $row['logo']?>" alt="Logo"
          class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="font-weight:600;font-size:1.4rem;">SENASA</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">


        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item ">
              <a href="../../view/Home/" class="nav-link ">
                <i class="nav-icon fas fa-home"></i>
                <p>
                  Inicio
                </p>
              </a>
            </li>
            <?php if($area['area'] == "ADMIN SISTEMA"){?>
            <li class="nav-item menu-open">
              <a href="../../view/Usuarios/" class="nav-link active">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Usuarios
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../view/Areas/" class="nav-link">
                <i class="nav-icon fas fa-square-full"></i>
                <p>
                  Áreas
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../view/Empleados/" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Funcionarios
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../view/Tramites/" class="nav-link">
                <i class="nav-icon fas fa-file-medical"></i>
                <p>
                  Trámites
                </p>
              </a>
            </li>
            <?php }?>
            <li class="nav-item">
              <a href="../../view/NuevoTramite/" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Nuevo Trámite
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../view/TramitesRecibidos/" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Trámites Recibidos
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../view/TramitesEnviados/" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                <p>
                  Trámites Enviados
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="../../view/Busqueda/" class="nav-link">
                <i class="nav-icon fas fa-search-minus"></i>
                <p>
                  Búsqueda de Trámites
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#ModalInformes" class="nav-link"  data-toggle="modal">
                <i class="nav-icon fas fa-file-contract"></i>
                <p>
                  Informes
                </p>
              </a>
            </li>

          </ul>
        </nav>

      </div>
    </aside>

    <!-- INICIO DEL CONTENIDO -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-11">
          <h1 style="text-align:center;color:black;font-weight:600;">SISTEMA DE MESA DE ENTRADA DE DOCUMENTOS</h1>
        </div>
        <div class="col-sm-1">

          <ol class="breadcrumb float-sm-right">
            <li style="font-weight:600"><i class="nav-icon fas fa-user"></i>&nbsp;Usuarios</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card card-danger card-outline">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight:600; color:#084B8A">Listado de Usuarios Registrados</h3>
                  
                  <a style="float:right;width:220px;height:30px" class="btn btn-flat bg-success" data-toggle="modal" id="Nuevo">
                    <i class="nav-icon fas fa-plus"></i>&nbsp;&nbsp;Nuevo Registro </a>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <a style="float:right;width:220px;height:30px;" Target="_blank" class="btn btn-flat bg-gray-dark" href="../../reporte/reporte-usuario.php" id="ReportUsu">
                    <i class="nav-iconfas fas fa-file-pdf"></i>&nbsp;&nbsp;Generar Reporte </a>
                <table id="tablaUsuarios" class="table table-hover" style="width:100%" >
                <thead style="background: #2874A6;color:white;">
                      <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Usuario</th>  
                        <th>Cédula</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th >Foto</th>
                        <th>Acción</th>
                      </tr>
                    </thead>
                    <tbody style="text-align: center;">                           
                    </tbody>        
                 
                  
                    <tfoot style="background: #2874A6;color:white;">
                    <tr style="text-align: center;">
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Cédula</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th style="width: 10px;">Foto</th>
                        <th>Acción</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
 
    </div>  
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">

      <strong>Copyright &copy; 2024 <a href="http://localhost/sismedoc/"> <?php echo $row['razon']?></a>.</strong>
      Todos los derechos reservados.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 1.0
      </div>
    </footer>
    <aside class="control-sidebar control-sidebar-dark">
    </aside>
  </div>
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>

  <script src="/sismedoc/public/assets/plugins/jquery/jquery.min.js"></script>
  <script src="/sismedoc/public/assets/plugins/bootstrap/js/bootstrap.js"></script>
  <script src="/sismedoc/public/assets/dist/js/adminlte.js"></script>
  <script src="/sismedoc/public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="/sismedoc/public/assets/js/main.js"></script> 
<!-- DataTables  & Plugins -->
  <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script> 
  <script src="/sismedoc/public/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="/sismedoc/public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/sismedoc/public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- FUNCIONALIDADES CON AJAX -->
</body>

</html>
  <!-- <script src="/sismedoc/public/assets/plugins/datatables/jquery.dataTables.min.js"></script> -->