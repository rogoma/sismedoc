<?php 
ob_start();
 include("../config/conexion.php");
 include("../config/conexion2.php");
if (!isset($_SESSION["idusuarios"])) {
  header("Location: http://localhost/sismedoc/login/");
}

date_default_timezone_set('America/Asuncion');
$consulta=mysqli_query($conexion,"select idempleado ID, cod_empleado Codigo, dni, concat(ap_paterno,' ',ap_materno,' ',nombres) Datos, telefono, area
from empleado e, persona p, areainstitu a, area ae
where e.idpersona=p.idpersona and e.idareainstitu=a.idareainstitu and ae.idarea=a.idarea");



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Reporte de Colaboradores</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "roboto";
      }
      body{
        margin: 20pt 35pt;
      }
      p,
      label,
      span,
      table {
        /* font-family: 'BrixSansRegular'; */
        font-size: 11pt;
      }
      .h2 {
        /* font-family: 'BrixSansBlack'; */
        font-size: 14pt; 
        font-weight:600;
      }
      .h3 {
        /* font-family: 'BrixSansBlack'; */
        font-size: 14pt;
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
        padding: 10px 10px 0 6%;
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
        padding: 5px;
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
              <img src="http://localhost/sismedoc/reporte/img/sello1.jpg" width="700px" height="80px">              
            </div>
          </td>          
          <td>
            <div>
              <!-- <img  src="http://localhost/sismedoc/reporte/img/sello2.jpg" width="80px" height="80px"> -->
            </div>
          </td>
        </tr>
        <td >
            <div align="center">            
            <span class="h2">SERVICIO NACIONAL DE SANEAMIENTO AMBIENTAL-SENASA</span>
              <!-- <p>Dirección: MARISCAL ESTIGARRIBIA ESQUINA TACUARY , ASUNCIÓN, PARAGUAY</p> -->
              <p>Teléfono: (+595)21 1245425 - Email:senasa@senasa.gov.py</p>
              <!-- <p>Email:senasa@senasa.gov.py</p> -->
            </div>
            <br>
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
                    <p>Lista de Colaboradores</p>
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
      <span class="h2">DETALLE DE TABLA DE FUNCIONARIOS:</span>      
      <br>
      <table id="factura_detalle" border="" height="40">
        <thead >
          <tr style="font-weight:600">
              <th>ID</th>
              <th>Código</th>
              <th>DNI</th>  
              <th>Apellidos y Nombres</th>
              <th>Área</th>
          </tr>
        </thead>
        <tbody style="text-align: center">
        <?php
					while ($row = mysqli_fetch_assoc($consulta)){
			 		?>
        <tr height="40">
          <th><?php echo $row['ID']; ?></th> 
          <th><?php echo $row['Codigo']; ?></th>
          <th><?php echo $row['dni']; ?></th>
          <th><?php echo $row['Datos']; ?></th>
          <th><?php echo $row['area']; ?></th>
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
$dompdf->setPaper("A4", "portrait"); //Render the HTML as PDF
$dompdf->render(); // Output the generated PDF to Browser
$dompdf->stream('Reporte.pdf',array('Attachment'=>false)); exit; 
?>
