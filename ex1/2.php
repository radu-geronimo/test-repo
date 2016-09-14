<?php 
/*

Pe formularul din html - request catre PHP cand se da click pe OK
Validari: (vezi placeholder)
Daca nu este valid, afiseaza eroarea in div-ul cu clasa error
Daca este valid, afiseaza un mesaj tot in div-ul error, dar cu alta culoare
HINT: nu trebuie sa dai submit, ci sa ramai in aceeasi pagina mereu
FARA ID-URI IN HTML
HINT2: http://api.jquery.com/jquery.ajax/
HINT3: http://api.jquery.com/on/

*/ /*

//toata logica o sa fie aici
 */
//var_dump($_POST['country']); //////////

// require('linkection.php');





	try{
		$servername = "localhost";
		$username = "root";
		$password = "Sta19Hor";
		$dbname = "first";

		$link = new mysqli($servername, $username, $password, $dbname);
		///
		$query = mysqli_query($link,"SELECT * FROM user");
		//$result = $link->query($query);
		//$result = $mysqli->query($query);

			
				
		if($query->num_rows > 0){
			
			// output data of each row
			while($row = $query->fetch_assoc()) { // while($row = mysql_fetch_array($result)){
			// while($row = $query->fetch_array(MYSQLI_ASSOC)) { // while($row = mysql_fetch_array($result)){
			// while($row = $query->mysqli_fetch_array()) {
			// while($row = $query->fetch_object()) {
				
				// $response['data'][] = $row;
				
				// $response['data'][] = array(
					// //'id'=>$row['id'],
					// 'name'=>$row['name'],
					// 'zipcode'=>$row['zipcode'],
					// 'country'=>$row['country']
				// );
				
				$x[] = array(
					//'id'=>$row['id'],
					'name'=>$row['name'],
					'zipcode'=>$row['zipcode'],
					'country'=>$row['country']
				);
				
				// var_dump($row);
			}
			
		}
		else{
			throw new Exception("Baza de date e goala");
		}
		$response = array(
			'success'=>true,
			'data' => $x
			);
		$link->close();
	}catch(Exception $e){
		$response = array(
			"success" => false, // e o cheie de tip string success 
			"msg" => $e->getMessage() // preiau mesajul "umpleti campul"
		);
	}
	echo json_encode($response);
?>
