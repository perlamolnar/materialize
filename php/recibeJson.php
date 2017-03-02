<?php
$test=4;
//para comprobar si se recibe un post desde un ajax:
if ($_SERVER['REQUEST_METHOD']==='POST'){
	//para almacenar (temporarlmente) los inputs (de usuario) que reciba JSON.
	$request=file_get_contents('php://input');
	//para convertir un Json en un array de php
	$datos = json_decode($request,true); 		//"true" es para que vaya directamente
	$valores="'"; 								//en php en vez de "var" ponemos signo de dollar$. declara variables
	$campos="";
	foreach ($datos as $key =>$value){       //para coger los valores de array. el key es el nombre de campo y el
		$campos.=$value['name'].',';      //El .= hace que guarde la informacion anterior + añade el siguiente
		$valores.=$value['value'] ."','";
	}
	$campos = substr($campos, 0, -1);
	$valores = substr($valores, 0, -2);

	$sql = "INSERT INTO enterprise ($campos) VALUES ($valores)"; //Esta linea almacenamos la informacion en esta misma variable (sql)
	$mysqli=new mysqli ("localhost","root","","crm"); // esta linea hace una coneccion a los date de bases.(server, username, password, databasename)
	mysqli_set_charset($mysqli,"utf8");
	
	if ($mysqli){
		$query = $mysqli->query($sql); // Esto envia la informacion a base de datos. query = enviar
		$mysqli->close(); //Esto cierra la conneccion con la base de datos. 
	}

	if ($query){
	echo json_encode([
		"campos" 	=>$campos,
		"error" 	=> 0,
		"valores" 	=>$valores,
		"sql" 		=>$sql,
		"resultado" =>"Se ha grabado la información."
	]);
	} else {
	echo json_encode([
		"resultado" =>"KO",
		"error" 	=> 1,
		"testeo" 	=>"no hay",
		"sql" 		=>$sql,
		"resultado" =>"No se ha grabado la información."
	]);
	}
}
?>