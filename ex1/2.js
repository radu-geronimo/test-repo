$(document).ready(function(){
		
		var message=$("#please");
		$.ajax({
			url:"http://localhost/ex1/2.php", // pun " , " intre elementele trimise / parametrii
			
			// AICI PUN BD ul data:$('#table1').serializeArray(),    // data=  ce trimit eu la script ( php )
			// dataType: 'json',
			// success:function(response){    //success e un event care se executa cand request-ul catre php s-a terminat cu succes
				// //console.log(response);     // rezultatul a ceea ce face output scriptul de php 
				// $("marquee").css("visibility","visible");
			dataType:'json',
			success:function(response){
				/*
				// if(response.success){
				if(response['success']){
					message.html("OK");
					document.body.innerHTML+="<p>Buna</p>";
					console.log("Rada rada rada");
					message.html("OK"); // pe acesta nu il ia
					
				}else{					
					document.body.innerHTML="<p>Nu e buna</p>";
					console.log("Ceva nu a mers bine");
				}
				*//*
				if(response.success)
				{
					message.html("OK");
					message.css("color","green");
					
					
				}else{
					message.html("Neah");
					message.css("color","red");
					
				}*/
				if(response.success){
					var tablestring =
						'<table id="table1">\
							<colgroup>\
								<col class="Index"/>\
								<col class="ColsCol"/>\
								<col class="ColsCol"/>\
								<col class="ColsCol"/>\
							</colgroup>\
							<tr>\
								<th>Id</td>\
								<th>Name</th>\
								<th>Zipcode</th>\
								<th>Country</th>\
							</tr>';
					for(var i=0;i<response.data.length;i++){
						tablestring+='<tr><td>'+(i+1)+'</td><td>'+response.data[i].name+'</td><td>'+response.data[i]["zipcode"]+'</td><td>'+response.data[i]["country"]+'</td></tr>';
					}
					tablestring+='</table>';
					
					document.body.innerHTML+=tablestring;				
				}
				else{					
					document.body.innerHTML=response.msg;
					console.log("Ceva nu a mers bine");
				}
			},
				error:function(error){
					console.log(error);
			}
		});				
});