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
//toata logica o sa fie aici
*/
try{
	$link = @mysqli_connect('localhost','root','Sta19Hor','first');
	if(!$link){
		throw new Exception(' Cannot connect to DB' );
	}
	mysqli_select_db($link , "first"); // Use DB	
	if(empty($_POST["name"])){
		throw new Exception("Umpleti campul 1");  // orice mesaj de eroare prind aici o sa il abordez in catch 
	}
	if( preg_match('/[^a-z]/i', $_POST['name']) ){
		throw new Exception("Insert only letters without space in first input");
	}
	if(($_POST["zipcode"])==''){
		throw new Exception("Umpleti campul 2");  // orice mesaj de eroare prind aici o sa il abordez in catch 
	}
	if( preg_match('/[^\d]/', $_POST['zipcode']) ){
		throw new Exception("Insert only digits in second inputbox");
	}
	if(($_POST["country"])==''){
		throw new Exception("Umpleti campul 3");  // orice mesaj de eroare prind aici o sa il abordez in catch 
	}
	if( strlen($_POST['country'])!=3 ){
		throw new Exception("Inputbox number 3 must have 3 letters.");
	}
	if(!ctype_alpha($_POST['country'])){
		throw new Exception("Inputbox number 3 have only letters");
	}
	////////
	$query = mysqli_query($link, "SELECT * FROM user WHERE name='".$_POST['name']."'");
	if(mysqli_num_rows($query) > 0){
		throw new Exception("This name already exists. Pick something else");
	}
	$query=mysqli_query($link,"INSERT INTO user(name,zipcode,country) 
			VALUES('$_POST[name]','$_POST[zipcode]','$_POST[country]')");
	if(!$query){//if(mysqli_query($link,$query)){
		throw new Exception(mysqli_error($link));
	}
	mysqli_close($link);
	
	$result = array('success' => true); // elementul meu o sa fie compus din mai multe elem, de aceea pastrez acum doar success
}catch( Exception $e){
	$result = array(
		"success" => false, // e o cheie de tip string success 
		"msg" => $e->getMessage() // preiau mesajul "umpleti campul"
	);
}
echo json_encode($result);  // il fac pe result de tip json


 // exception are metode predefinite  // get file // get message // get line

?>