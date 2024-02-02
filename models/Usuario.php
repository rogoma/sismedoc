<?php
    class Usuario extends Conectar {
        
        public function login(){
			$conectar=parent::Conexion();
			parent::set_names();
			if(isset($_POST["enviar"])){
				
				$usuario = $_POST["usuario"];
				$password = $_POST["password"];
				
				if(empty($usuario) and empty($password)){
					header("Location:".Conectar::ruta()."login/index.php?m=2");
					exit();
				}
			else {
				$sql= "select * from usuarios where dni='$usuario' and contraseña='$password' and estado='ACTIVO'";
				$sql=$conectar->prepare($sql);
				$sql->execute();
				$resultado = $sql->fetch();				
				
				if(is_array($resultado) and count($resultado)>0){
						$_SESSION["idusuarios"] = $resultado["idusuarios"];
                        $_SESSION["nombre"] = $resultado["nombre"];
                        $_SESSION["dni"] = $resultado["dni"];
						$_SESSION["email"] = $resultado["email"];
						$_SESSION["foto"] = $resultado["foto"];
						$_SESSION["idroles"] = $resultado["idroles"];
						header("Location:".Conectar::ruta()."view/Home/");
						exit(); 
					} else {
						//CONTROLA SI SU ESTADO ES INACTIVO
						$sql= "select * from usuarios where dni='$usuario' and contraseña='$password' and estado='INACTIVO'";
						$sql=$conectar->prepare($sql);
						$sql->execute();
						$resultado2 = $sql->fetch();
						
						if(is_array($resultado2) and count($resultado2)>0){
							header("Location:".Conectar::ruta()."login/index.php?m=3");
							exit();
						} else {
							header("Location:".Conectar::ruta()."login/index.php?m=1");
							exit();
						}
					}
				}
			}
		}

    }
?>