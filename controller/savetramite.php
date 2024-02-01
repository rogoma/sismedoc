<?php

require_once("../config/conexion2.php");


$ruc=trim($_POST['idruc']);
$entidad=strtoupper(trim($_POST['identi']));
$dni=trim($_POST['iddni']);
$nombres=strtoupper(trim($_POST['idnombre']));
$appat=strtoupper(trim($_POST['idap']));
$apmat=strtoupper(trim($_POST['idam']));
$cel=trim($_POST['idcel']);
$direc=strtoupper(trim($_POST['iddirec']));
$correo=trim($_POST['idcorre']);
$user_id=trim($_POST['user_id']);

$idper=trim($_POST['idpersona']);
$tipo=trim($_POST['idtipo']);
$nrodoc=trim($_POST['idnrodoc']);
$folios=trim($_POST['idfolios']);
$asunto=strtoupper(trim($_POST['idasunto']));

$xped = mysqli_query($conexion,"SELECT gen_nroexpediente() res");
$fila = mysqli_fetch_assoc($xped);
$expediente = $fila['res'];

$a = "../";
$ruta = "files/docs/";    	

$file_tmp_name = $_FILES['idfile']['tmp_name'];
$new_name_file = $a . $ruta . $expediente . '_' . date('Y') . '_'. $dni . '.pdf';
$nuevo = $ruta . $expediente . '_' . date('Y') . '_'. $dni . '.pdf';

if (move_uploaded_file($file_tmp_name, $new_name_file)) {
    $existe = mysqli_query($conexion,"SELECT count(*) total FROM persona where dni='$dni'");
    $fila1 = mysqli_fetch_assoc($existe);

    if ($fila1['total'] == 0) {            
        $resultado1 = mysqli_query($conexion,"INSERT into persona values (null,'$dni','$appat','$apmat','$nombres','$correo','$cel','$direc','$ruc','$entidad');");
    }else{
        $resultado1 = mysqli_query($conexion,"UPDATE persona SET email='$correo',telefono='$cel',direccion='$direc' where idpersona='$idper'");
        $resultado1 = mysqli_query($conexion,"UPDATE usuarios SET email='$correo', fechaedicion=sysdate() where dni=(select dni from persona where idpersona='$idper')"); 
    }

    $existe1 = mysqli_query($conexion,"SELECT idpersona ID FROM persona where dni='$dni'");
    $fila2 = mysqli_fetch_assoc($existe1);
    $id = $fila2['ID'];
    $consulta2 = "INSERT into documento values (null, '$expediente','$nrodoc','$folios','$asunto','PENDIENTE','$nuevo','$id','$tipo','8','$user_id')";			
    $resultado2 = mysqli_query($conexion,$consulta2);

    $inser = mysqli_query($conexion,"INSERT into historial values(null,sysdate(),'$expediente','$dni','DERIVADO','SECRETARÍA','INGRESO DE NUEVO TRÁMITE')");
    
    if($inser){
        $iddoc= mysqli_query($conexion,"SELECT max(iddocumento) idmax from documento");
        $resu = mysqli_fetch_assoc($iddoc);
        $lastid = $resu['idmax'];

        $consulta = "INSERT into derivacion values (null, sysdate(),'EXTERIOR','8','$lastid','')";			
        $resultado = mysqli_query($conexion,$consulta);
        $last = mysqli_insert_id($conexion);       

        $consul= mysqli_query($conexion,"select nro_expediente expediente, nro_doc nro, tipodoc, concat(nombres, ' ',ap_paterno,' ',ap_materno) Datos, date_format(fechad, '%d/%m/%Y') Fecha
        from derivacion d, documento dc, areainstitu a, area ae, persona p, tipodoc t where d.iddocumento=dc.iddocumento and
        d.idareainstitu=a.idareainstitu and a.idarea=ae.idarea and dc.idpersona=p.idpersona and dc.idtipodoc=t.idtipodoc and idderivacion='$last'");
        $data = mysqli_fetch_assoc($consul);        
    }else{
        print 'Error no se guardo en el historial';
    }
    
}else{
    print 'ERROR AL GUARDAR EL ARCHIVO';
}





    
    








