<?php 
ob_start();
 include("../config/conexion.php");
 include("../config/conexion2.php");
if (!isset($_SESSION["idusuarios"])) {
  header("Location: http://localhost/sismedoc/login/");
}

date_default_timezone_set('America/Asuncion');
// $consulta=mysqli_query($conexion,"select idusuarios ID1,p.dni dni,nombre ,concat(ap_paterno,' ',ap_materno,' ', nombres) Datos, u.email email, telefono,rol, estado
// from persona p, usuarios u, roles r
// where p.dni=u.dni and r.idroles=u.idroles;");

$consulta=mysqli_query($conexion,"SELECT usuarios.idusuarios ID1, persona.dni, usuarios.nombre, concat(persona.ap_paterno,' ',persona.ap_materno,' ', persona.nombres) Datos, usuarios.email, persona.telefono, roles.rol, usuarios.estado, area.area FROM persona INNER JOIN empleado ON (persona.idpersona = empleado.idpersona) INNER JOIN area ON (empleado.idareainstitu = area.idarea) INNER JOIN usuarios ON (persona.dni = usuarios.dni) INNER JOIN roles ON (usuarios.idroles = roles.idroles)");


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Reporte de Usuarios</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "roboto";
      }
      body{
        margin: 20pt 10pt;
      }
      p,
      label,
      span,
      table {
        /* font-family: 'BrixSansRegular'; */
        font-size: 10pt;
      }
      .h2 {
        /* font-family: 'BrixSansBlack'; */
        font-size: 15pt; 
        font-weight:600;
      }
      .h3 {
        /* font-family: 'BrixSansBlack'; */
        font-size: 11pt;
        display: block;
        background: #0a4661;
        color: #fff;
        text-align: center;
        padding: 3px;
        margin-bottom: 5px;
      }
      #page_pdf {
        width: 95%;
        margin: 15px auto 10px auto;
      }

      #factura_head,
      #factura_cliente,
      #factura_detalle {
        width: 100%;
        /* margin-bottom: 10px; */
      }
      .logo_factura {
        width: 25%;
      }
      .info_empresa {
        width: 50%;
        text-align: center;
        padding:0;
      }
      .info_factura {
        width: 25%;
        float:right;
      }
      .info_cliente {
        width: 100%;
      }
      .datos_cliente {
        width: 100%;
        padding: 10px 10px 0 10%;
      }
      .datos_cliente tr td {
        width: 50%;
      }

      .datos_cliente label {
        width: 130px;
        display: inline-block;
      }
      .datos_cliente p {
        display: inline-block;
      }

      .textright {
        text-align: right;
      }
      .textleft {
        text-align: left;
      }
      .textcenter {
        text-align: center;
      }
      .round {
        border-radius: 10px;
        border: 1px solid #0a4661;
        overflow: hidden;
        padding-bottom: 15px;
      }
      .round p {
        padding: 0 15px;
      }

      #factura_detalle {
        border-collapse: collapse;
        
      }
      #factura_detalle thead th {
        background: #2874A6;
        color: #FFF;
        padding: 2px;
        /* font-weight: 700; */
      }
      #detalle_productos tr:nth-child(even) {
        background: #ededed;
      }
      #detalle_totales span {
        /* font-family: 'BrixSansBlack'; */
      }
      .nota {
        font-size: 8pt;
      }
      .label_gracias {
        font-family: verdana;
        font-weight: bold;
        font-style: italic;
        text-align: center;
        margin-top: 20px;
      }
      .anulada {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translateX(-50%) translateY(-50%);
      }
      .Logo {
        width: 80px;
        height: 80px;
      }
    </style>
  </head>
  <body>
    <div id="page_pdf">
    <table id="factura_head">
        <tr>
          <td>
            <div>
              <img src="http://localhost/sismedoc/reporte/img/sello1.jpg" width="1050px" height="80px">              
            </div>
          </td>          
          <td>
            <div>
              <!-- <img  src="http://localhost/sismedoc/reporte/img/sello2.jpg" width="80px" height="80px"> -->
            </div>
          </td>
        </tr>
        <td >
            <!-- <div align="center">            
            <span class="h2">SERVICIO NACIONAL DE SANEAMIENTO AMBIENTAL-SENASA</span>
              <p>Dirección: MARISCAL ESTIGARRIBIA ESQUINA TACUARY , ASUNCIÓN, PARAGUAY</p>
              <p>Teléfono: (+595)21 1245425</p>
              <p>Email:senasa@senasa.gov.py</p>
            </div> -->
            <!-- <br> -->
          </td>
      </table>

      <table id="factura_cliente">
        <tr>
          <td class="info_cliente">
            <div class="round">
              <span style="font-weight:600;" class="h3">DATOS DEL REPORTE</span>
              <table class="datos_cliente">
                <tr>
                  <td>
                    <label>Nombre del Reporte:</label>
                    <p>Usuarios Registrados</p>
                  </td>
                  <td>
                    <label>Fecha:</label>
                    <p><?php echo date("d/m/Y");?></p>
                  </td>
                </tr>
                <tr>
                  <td>
                    <label>Total de Registros:</label>
                    <p><?php echo mysqli_num_rows($consulta) ?></p>
                  </td>
                  <td>
                    <label>Hora:</label>
                    <p><?php echo date("g:i:s a");;?></p>
                  </td>
                </tr>
              </table>
            </div>
          </td>
        </tr>
      </table>
      <br>
      <span class="h2">DETALLE DE TABLA DE USUARIOS:</span>
      <!-- <br> -->
      <br>
      <table id="factura_detalle" border="" height="20">
        <thead >
          <tr style="font-weight:100">
            <th><b>ID</b></th>
            <th><b>CÉDULA</b></th>
            <th><b>USUARIO</b></th>
            <th><b>APELLIDOS Y NOMBRES</b></th>
            <th><b>EMAIL</b></th>
            <th><b>N° CELULAR</b></th>
            <th><b>ROL</b></th>
            <th><b>ESTADO</b></th>
            <th><b>DEPENDENCIA</b></th>
          </tr>
        </thead>
        <tbody style="text-align: center">
        <?php
					while ($row = mysqli_fetch_assoc($consulta)){
			 		?>
        <tr height="20">
          <th><?php echo $row['ID1']; ?></th>
          <th align="left"><?php echo $row['dni']; ?></th>
          <th align="left"><?php echo $row['nombre']; ?></th>
          <th align="left"><?php echo $row['Datos']; ?></th>
          <th align="left"><?php echo $row['email']; ?></th>
          <th><?php echo $row['telefono']; ?></th>
          <th><?php echo $row['rol']; ?></th>

          <th style="color: <?php echo ($row['estado'] === 'ACTIVO') ? 'black' : 'red'; ?>">
              <?php echo $row['estado']; ?>
          </th>
          
          <th align="left"><?php echo $row['area']; ?></th>
        </tr>
        <?php
					}
					?>
        </tbody>
      </table>
    </div>
  </body>
</html>

<?php 
$html = ob_get_clean();
// echo $html;

require_once '../vendor/autoload.php';
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options); 

$dompdf->set_option('defaultFont', 'brixsansregular');

$dompdf->loadHtml($html); // (Optional) Setup the paper size and orientation
$dompdf->setPaper("A4", "landscape"); //Render the HTML as PDF
$dompdf->render(); // Output the generated PDF to Browser
$dompdf->stream('Reporte Usuarios HACDP.pdf',array('Attachment'=>false)); exit; 
?>
