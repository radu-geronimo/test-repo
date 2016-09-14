$(document).ready(function(){
	// $("#form1").on('input', function() {
		// submitAction();
	// });
	//$("#form1").change( function() {
	$(".btn1").click( function() {
		submitAction();
	});	
	
	function submitAction(){
		var message=$('.error'); // ca sa nu scriu tot timpul $('.error')
		$.ajax({
			url:"http://localhost/ex1/1.php", // pun " , " intre elementele trimise / parametrii
			
			data:$('#form1').serializeArray(),    // data=  ce trimit eu la script ( php )
			dataType: 'json',
			success:function(response){    //success e un event care se executa cand request-ul catre php s-a terminat cu succes
				//console.log(response);     // rezultatul a ceea ce face output scriptul de php 
				$("marquee").css("visibility","visible");
				message.css("visibility","visible");
				
				if(response.success)
				{
					message.html("OK");
					message.css("color","green");
					
					
				}else{
					message.html(response.msg);
					message.css("color","red");
					
				}
			},
			
			type:'POST'
		});				
	}
});
