//VARIABLES
var cmnd_prix_total = document.getElementById("cmnd_prix_total");
var prix_unitaire = document.getElementById("prix_unitaire");
var qty = document.getElementById("qty");
var prix_total = document.getElementById("prix_total")
var cmnd_dtls_modal = document.getElementById("cmnd_dtls_modal");
var cmnd_dtls_table = document.getElementById("cmnd_dtls_table");
var cmnd_dtls_total = document.getElementById('cmnd_dtl_prix_total');
var cmnd_dtls_date = document.getElementById('cmnd_dtls_date');
var cmnd_dtls_client = document.getElementById('cmnd_dtls_client');
var cmnd_dtls_nbr = document.getElementById('cmnd_dtls_nbr');


function tables_serache(section)
{
	$(document).ready(function(){
	  $("#searche_"+section).on("keyup", function() {
	    var value = $(this).val().toLowerCase();
	    $("#"+section+"s_table tr:gt(0)").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	  });
	});
}



document.getElementsByClassName("close2")[0].onclick = function() { 
	document.getElementById('cmnd_dtls_modal').style.display='none'; 
        	$("#cmnd_dtls_table tr:gt(0)").remove();
       	cancel()
};


function cmnd_det(numero_cmnd)
{ 
$(document).ready(function() {
      	 $(function() {
           	$.ajax({
	               	url: '/cmnd_dtl/'+numero_cmnd,
	               	type: 'GET',
	               	success: function (data) {
	                   		var locationsArray = data;
	                   		add_records(locationsArray,numero_cmnd);
	               	},
	               	error: function(result){console.log(result)} 
                	});
            	});
        	});

	$('#cmnd_dtls_modal #approver').attr("onclick", "Approve_commande("+numero_cmnd+")");

}

function Approve_commande(numero_cmnd)
{
	$('#cmnd_dtls_modal #modal-alert').css('display','none');
	$(document).ready(function() {
      	 $(function() {
           	$.ajax({
	               	url: '/cmnd_approval/'+numero_cmnd,
	               	type: 'GET',
	               	success: function (result) {
	               		console.log(result)
	                   		if (result.response) {			
	                   			$.ajax({
	                   				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				               	url: '/commande/cmnd_approved',
				               	type: 'POST',
				               	data:{
				               		'numero_cmnd':numero_cmnd,
				               		'id_admin':Number($('#user_ID').html())
				               	},		
				               	success: function (result) {
				               		console.log(result)
				               		if (result.response) {
			               				$('#cmnd_dtls_modal #modal-alert').html(result.Message);
			               				$('#cmnd_dtls_modal #modal-alert').removeClass('alert-danger');
			               				$('#cmnd_dtls_modal #modal-alert').addClass('alert-success');
	                   						$('#cmnd_dtls_modal #modal-alert').css('display','block');
				               		}else{
			               				$('#cmnd_dtls_modal #modal-alert').html(result.Message);
			               				$('#cmnd_dtls_modal #modal-alert').removeClass('alert-success');
			               				$('#cmnd_dtls_modal #modal-alert').addClass('alert-danger');
	                   						$('#cmnd_dtls_modal #modal-alert').css('display','block');				               			
				               		}
				               	},
				               	error: function(result){console.log(result)} 
                				});
	                   		}else{
	                   			if (result.approved) {
	                   			$('#cmnd_dtls_modal #modal-alert').addClass('alert-danger');
	               				$('#cmnd_dtls_modal #modal-alert').removeClass('alert-success');
	                   			$('#cmnd_dtls_modal #modal-alert').html(result.Message);
	                   			$('#cmnd_dtls_modal #modal-alert').css('display','block');
	                   			}else{
	               				$('#cmnd_dtls_modal #modal-alert').addClass('alert-danger');
	               				$('#cmnd_dtls_modal #modal-alert').removeClass('alert-success');
	                   			$('#cmnd_dtls_modal #modal-alert').html("La quantité des produits suivants est insufisant pour approuver cette commande : <br> - "+result.products.join("<br> - "));
	                   			$('#cmnd_dtls_modal #modal-alert').css('display','block');
	                   			$('.products-table').css('height','17rem')
	                   			}
	                   		}
	               	},
	               	error: function(result){console.log(result)} 
                	});
            	});
        	});

}

function add_records(locationsArray,nbr_cmnd){
								var summ = 0;
								for (var i = locationsArray.length - 1; i >= 0; i--) {
                    			var row = cmnd_dtls_table.insertRow(0);
								var atrb1 = row.insertCell(0);
								var atrb2 = row.insertCell(1);
								var atrb3 = row.insertCell(2);
								var atrb4 = row.insertCell(3);
								var atrb5 = row.insertCell(4);
								var atrb6 = row.insertCell(5);

								atrb1.innerHTML = locationsArray[i].Reference;
								atrb2.innerHTML = locationsArray[i].designation;
								atrb3.innerHTML = locationsArray[i].Libelle;
								atrb4.innerHTML = locationsArray[i].prix_unitaire;
								atrb5.innerHTML = locationsArray[i].qte_cmnd ;
								atrb6.innerHTML = locationsArray[i].qte_cmnd * locationsArray[i].prix_unitaire	;
								summ += locationsArray[i].qte_cmnd * locationsArray[i].prix_unitaire	;
								}
								
								cmnd_dtls_total.value=summ.toFixed(2);
								cmnd_dtls_date.innerHTML += locationsArray[0].date_effectue;
								cmnd_dtls_nbr.innerHTML += nbr_cmnd;
								cmnd_dtls_client.innerHTML += locationsArray[0].name;
								cmnd_dtls_modal.style.display='block';
								$("#cmnd_dtls_modal #cmnd_dtls_table").addClass('table table-striped ')
								$('.products-table').css('max-height','23rem')
}
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("popup");

var btn_cls = document.getElementById("btn-close");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
/*btn.onclick = function() {
    modal.style.display="block";
}*/

/*btn_cls.onclick = function() {
    modal.style.display = "none";
}*/

// When the user clicks on <span> (x), close the modal
/*span.onclick = function() {
    modal.style.display = "none";
}*/
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {

        if (event.target == cmnd_dtls_modal) {
        cmnd_dtls_modal.style.display = "none";
        $("#cmnd_dtls_table tr:gt(0)").remove();
        cancel()
        
    }
    if (event.target == document.getElementById("ajouter") 
	    	||	event.target == document.getElementById("Fournisseur") 
	    	|| 	event.target == document.getElementById("Produit")) {

    	cancel()
    }
}


function cancel()
{
	//users form
	$('#ajouter').css('display','none');
	//fournisseurs form
	$('#Fournisseur').css('display','none');
	$('#Produit').css('display','none');
	//detaile form
	$("#cmnd_dtls_modal #cmnd_dtls_table tr").remove();
	$('#cmnd_dtls_modal #cmnd_dtls_nbr').html("Detaile du commande N°: ");
	$('#cmnd_dtls_modal #cmnd_dtls_client').html("CLIENT : ");
	$('#cmnd_dtls_modal #cmnd_dtls_date').html("DATE : ");
	$('#cmnd_dtls_modal').css('display','none');
	$('#cmnd_dtls_modal #modal-alert').css('display','none');
}


//USERS FUNCTIONS


function add_User(type)
{
	$("#ajouter #modal-alert").css('display','none');
	$(document).ready(function() {
	
							if (($("#ajouter #repassword").val() != "") && ($("#ajouter #password").val() != "") && ($("#ajouter #name").val() != "") && ($("#ajouter #email").val() != ""))
							{ 
							if ($("#ajouter #password").val() != $("#ajouter #repassword").val()) 
							{
								$("#ajouter #modal-alert").html("The passwords aren't match");
								$("#ajouter #modal-alert").css('display','block');
								$("#ajouter #password").val("");
								$("#ajouter #repassword").val("");
								$("#ajouter #password").focus();
							}else{
								$("#ajouter #modal-alert").css('display','none');
						
							    $.ajax({
							    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
						            	url: '/users/user_Existence/'+$("#name").val()+'/'+$("#email").val(),
						            	type: 'GET',
						            		
						            	success: function(result) {
						            		if (result.response) {
													    $.ajax({
													    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
												            	url: '/users/insertNewUser',
												            	type: 'POST',
												            	data: {	'name':$("#ajouter #name").val(),
												            			'email':$("#ajouter #email").val(),
												            			'password':$("#ajouter #password").val(),
												            			'type':type
												            			},
												            
												            	success: function(result) {
												            		$("#ajouter #modal-alert").html(result);
																$("#ajouter #modal-alert").css('display','block');
																$("#ajouter #modal-alert").removeClass('alert-danger');
																$("#ajouter #modal-alert").addClass('alert-success');
																clear_dialoge_fields()
																$("#ajouter #name").focus();																
												            	},
												            	error: function(result) {}
												        		});						            			
						            		}else{
						            			$("#ajouter #modal-alert").html(result.Message);
											$("#ajouter #modal-alert").css('display','block');
											$("#ajouter #name").focus();
							            	}
						            	},
						            	error: function(result) {console.log(result)}
						        		});				
							}
						}else{$("#ajouter #modal-alert").html("REMPLISSEZ TOUS LES CHAMPS");$("#ajouter #modal-alert").removeClass('alert-success ');$("#ajouter #modal-alert").addClass('alert-danger');$("#ajouter #modal-alert").css('display','block');}
	});
}

function Update_User(id_user)
{
	$(document).ready(function() {

   			if (($("#ajouter #password").val() != $("#ajouter #repassword").val()) || ($("#ajouter #repassword").val() == "") || ($("#ajouter #password").val() == "") || ($("#ajouter #name").val() == "") || ($("#email").val() == "")) 
			{
				$("#ajouter #modal-alert").html("REMPLISSEZ TOUS LES CHAMPS CORRECTEMENT");
				$("#ajouter #modal-alert").removeClass('alert-success');
				$("#ajouter #modal-alert").addClass('alert-danger');
				$("#ajouter #modal-alert").css('display','block');
				$("#ajouter #password").val("");
				$("#ajouter #repassword").val("");
				$("#ajouter #password").focus();
			}else{
				$("#ajouter #modal-alert").css('display','none');
			    $.ajax({
			    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		            	url: 'users/update_user',
		            	type: 'POST',
		            	data: {
						'id':id_user,
		            		'name':$("#ajouter #name").val(),
		            		'email':$("#ajouter #email").val(),
		            		'password':$("#ajouter #password").val(),
		            	},
		            		
		            	success: function(result) {
			            		if (result.response) {
			            			console.log(result)
			            		$("#ajouter #modal-alert").html(result.Message);
							$("#ajouter #modal-alert").css('display','block');
							$("#ajouter #modal-alert").removeClass('alert-danger');
							$("#ajouter #modal-alert").addClass('alert-success');
							clear_dialoge_password_fields()
						}else{
							$("#ajouter #modal-alert").html(result.Message);
							$("#ajouter #modal-alert").css('display','block');
							$("#ajouter #modal-alert").removeClass('alert-success');
							$("#ajouter #modal-alert").addClass('alert-danger');
							clear_dialoge_password_fields()
						}

		            	},
		            	error: function(result) {console.log(result)}
		        		});				
			}
	}); 		
}

function get_user_info(id_user)
{
	$.ajax({
    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       	url: '/users/get_user_info/'+id_user,
       	type: 'GET',
       	success:function(result){
			   console.log(result)
			$("#ajouter #name").val(result[0].name);
			$("#ajouter #email").val(result[0].email);       		
       	},
       	error:function(result){console.log(result)}
	});
}

function display_update_user_form(id_user)
{

		clear_dialoge_fields()
		get_user_info(id_user);
		$('#ajouter #valider').attr("onclick", "Update_User("+id_user+")");
		$('#ajouter #valider').text("Modifier");
    		$('#ajouter #valider').removeClass('btn-success btn-danger')
    		$('#ajouter #valider').addClass('btn-primary')
		$('#ajouter').css('display','block');
		$("#ajouter #modal-alert").css('display','none');
		$('#small-model-content').css('width','60%');
}

function display_add_user_form(type)
{
		clear_dialoge_fields()
		if (type == "admin") {
			$('#ajouter #valider').attr("onclick", "add_User('"+type+"')");
			$('#ajouter #valider').text("Ajouter ");
	    		$('#ajouter #valider').removeClass('btn-primary btn-danger')
	    		$('#ajouter #valider').addClass('btn-success')
	    		$("#ajouter #modal-alert").css('display','none');
		}else{
			$('#ajouter #valider').attr("onclick", "add_User('"+type+"')");
			$('#ajouter #valider').text("Ajouter ");
	    		$('#ajouter #valider').removeClass('btn-primary btn-danger')
	    		$('#ajouter #valider').addClass('btn-success')
	    		$("#ajouter #modal-alert").css('display','none');
		}	
		$('#ajouter').css('display','block');
		$('#small-model-content').css('width','60%');
}

function clear_dialoge_fields()
{
			$("#ajouter #name").val("");
			$("#ajouter #email").val("");
			$("#ajouter #password").val("");
			$("#ajouter #repassword").val(""); 			 	
} 
function clear_dialoge_password_fields()
{
			$("#ajouter #password").val("");
			$("#ajouter #repassword").val(""); 			 	
} 




// FOURNISSEURS FUNCTIONS




function display_fournisseur_form(operation,id_fournisseur)
{
	clear_F_Fields()
		if (operation == "add") {
				$('#Fournisseur #valider').attr("onclick", "add_fournisseur()");
				$('#Fournisseur #valider').text("Ajouter Fournisseur");
		    		$('#Fournisseur #valider').removeClass('btn-primary btn-danger')
		    		$('#Fournisseur #valider').addClass('btn-success')
		    		$("#Fournisseur #modal-alert").css('display','none');			
		}else{
				get_fournisseur_info(id_fournisseur)
				$('#Fournisseur #valider').text('Modifier');
				$('#Fournisseur #valider').attr("onclick", "update_fournisseur("+id_fournisseur+")");
		    		$('#Fournisseur #valider').removeClass('btn-success btn-danger')
		    		$('#Fournisseur #valider').addClass('btn-primary')
		    		$("#Fournisseur #modal-alert").css('display','none');			
			
		}
		$('#Fournisseur').css('display','block');
		$('#Fournisseur #small-model-content').css('width','60%');	
}

function add_fournisseur()
{
	$("#Fournisseur #modal-alert").css('display','none');
	$(document).ready(function() {
					if (($("#F_name").val() == "") || ($("#F_email").val() == "") || ($("#F_address").val() == "") || ($("#F_telephone").val() == "") )
					{
						$("#Fournisseur #modal-alert").html("REMPLISSEZ TOUS LES CHAMPS");
						$("#Fournisseur #modal-alert").css('display','block');
					}else{
						$("#modal-alert").css('display','none');
					    $.ajax({
					    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				            	url: '/Fournisseurs/Fournisseur_Existence/'+$("#F_name").val()+'/'+$("#F_email").val()+'/'+$("#F_telephone").val(),
				            	type: 'GET',
				            		
				            	success: function(result) {
				            		if (result.response) {
											    $.ajax({
											    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
										            	url: '/Fournisseurs/insertNewFournisseur',
										            	type: 'POST',
										            	data: {	'name':$("#F_name").val(),
										            			'email':$("#F_email").val(),
										            			'adresse':$("#F_adresse").val(),
										            			'telephone':$("#F_telephone").val(),
										            			},
										            	success: function(result) {
										            		$("#Fournisseur #modal-alert").html(result);
														$("#Fournisseur #modal-alert").css('display','block');
														$("#Fournisseur #modal-alert").removeClass('alert-danger');
														$("#Fournisseur #modal-alert").addClass('alert-success');
														clear_F_Fields()
										            	},
										            	error: function(result) {console.log(result)}
										        		});						            			
				            		}else{
				            			$("#Fournisseur #modal-alert").html(result.Message);
									$("#Fournisseur #modal-alert").css('display','block');
									
					            	}
				            	},
				            	error: function(result) {console.log(result)}
				        		});				
					}
				});

}
function clear_F_Fields()
{
	$("#F_telephone").val("");
	$("#F_name").val("");
	$("#F_email").val("");
	$("#F_adresse").val("");	
	$("#F_name").focus();
}

function get_fournisseur_info(id_fournisseur)
{
	$.ajax({
    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       	url: '/Fournisseurs/get_fournisseur_info/'+id_fournisseur,
       	type: 'GET',
       	success:function(result){
			$("#Fournisseur #F_name").val(result[0].name);
			$("#Fournisseur #F_email").val(result[0].email);   
			$("#Fournisseur #F_telephone").val(result[0].telephone);
			$("#Fournisseur #F_adresse").val(result[0].adresse); 			    		
       	},
       	error:function(result){}
	});
}


function update_fournisseur(id_fournisseur)
{
		$("#Fournisseur #modal-alert").css('display','none');
   		$(document).ready(function() {

   			if (($("#F_name").val() == "") || ($("#F_email").val() == "") || ($("#F_address").val() == "") || ($("#F_telephone").val() == "") )
				{
					$("#Fournisseur #modal-alert").html("REMPLISSEZ TOUS LES CHAMPS");
					$("#Fournisseur #modal-alert").removeClass('alert-danger alert-success');
					$("#Fournisseur #modal-alert").addClass('alert-primary');
					$("#Fournisseur #modal-alert").css('display','block');
				}else{
					$("#modal-alert").css('display','none');
				    $.ajax({
				    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			            	url: '/Fournisseurs/update_Fournisseur',
			            	type: 'POST',
			            	data: {
							'Code_fournisseur':id_fournisseur,
			            		'name':$("#F_name").val(),
			            		'email':$("#F_email").val(),
			            		'adresse':$("#F_adresse").val(),
			            		'telephone':$("#F_telephone").val(),
			            	},
			            		
			            	success: function(result) {
				            		if (result.response) {
					            		$("#Fournisseur #modal-alert").html(result.Message);
									$("#Fournisseur #modal-alert").css('display','block');
									$("#Fournisseur #modal-alert").removeClass('alert-danger');
									$("#Fournisseur #modal-alert").addClass('alert-success');
								}else{
									$("#Fournisseur #modal-alert").html(result.Message);
									$("#Fournisseur #modal-alert").css('display','block');
									$("#Fournisseur #modal-alert").removeClass('alert-success');
									$("#Fournisseur #modal-alert").addClass('alert-danger');
								}

			            	},
			            	error: function(result) {console.log(result)}
			        		});				
				}
});  		
}


//PRODUCTS FUNCTIONS


function display_produit_form(operation,code_produit) 
{
	if (operation == "add") {
			clear_P_Fields()
			$('#Produit #valider').attr("onclick", "add_produit()");
			$('#Produit #valider').text("Ajouter");
			$('#Produit #valider').removeClass("btn-primary");
			$('#Produit #valider').addClass("btn-success");
			$("#Produit #modal-alert").css('display','none');
			$('#Produit').css('display','block');
			$('#Produit #small-model-content').css('width','60%');	
		}else{
			clear_P_Fields()
			get_produit_info(code_produit)
			$('#Produit #valider').attr("onclick", "update_Produit("+code_produit+")");
			$('#Produit #valider').text("Modifier");
			$('#Produit #valider').removeClass("btn-success");
			$('#Produit #valider').addClass("btn-primary");
			$("#Produit #modal-alert").css('display','none');			
			$('#Produit').css('display','block');
			$('#Produit #small-model-content').css('width','60%');	
		}
}

function add_produit()
{
	$("#Produit #modal-alert").css('display','none');
	$(document).ready(function() {

					if (($("#Reference").val() == "") || ($("#Designation").val() == "") || ($("#Prix_unit").val() == "") || ($("#Quantite").val() == "") || ($("#Quantite").val() < 0))
					{
						$("#Produit #modal-alert").html("REMPLISSEZ TOUS LES CHAMPS");
						$("#Produit #modal-alert").removeClass('alert-danger alert-success');
						$("#Produit #modal-alert").addClass('alert-primary');
						$("#Produit #modal-alert").css('display','block');
						
					}else{
						$("#modal-alert").css('display','none');
					    $.ajax({
					    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				            	url: '/Produits/Produit_Existence/'+$("#Produit #Reference").val(),
				            	type: 'GET',
				            		
				            	success: function(result) {
				            		if (result.response) {
											    $.ajax({
											    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
										            	url: '/Produits/insertNewProduit',
										            	type: 'POST',
										            	data: {	
										            			'reference':$('#Produit #Reference').val(),
										            			'designation':$('#Produit #Designation').val(),
										            			'prix_unitaire':$('#Produit #Prix_unit').val(),
										            			'quantite':$('#Produit #Quantite').val(),
										            			'code_categorie':document.getElementById('Categorie')[document.getElementById('Categorie').selectedIndex].value,
										            			'code_fournisseur':document.getElementById('Fourni_par')[document.getElementById('Fourni_par').selectedIndex].value,

										            			},
										            	success: function(result) {
										            		$("#Produit #modal-alert").html(result);
														$("#Produit #modal-alert").css('display','block');
														$("#Produit #modal-alert").removeClass('alert-danger alert-primary');
														$("#Produit #modal-alert").addClass('alert-success');
														clear_P_Fields()
										            	},
										            	error: function(result) {console.log(result)}
										        		});						            			
				            		}else{
				            			$("#Produit #modal-alert").html(result.Message);
									$("#Produit #modal-alert").removeClass('alert-success alert-primary');
									$("#Produit #modal-alert").addClass('alert-danger');
									$("#Produit #modal-alert").css('display','block');
									
					            	}
				            	},
				            	error: function(result) {console.log(result)}
				        		});				
					}
				});
}


function clear_P_Fields()
{
	$("#Reference").val("");
	$("#Designation").val("");
	$("#Prix_unit").val("");
	$("#Quantite").val("");	
	$("#Reference").focus();
}

function get_produit_info(code_produit)
{
	$.ajax({
    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
       	url: '/Produits/get_Produit_info/'+code_produit,
       	type: 'GET',
       	success:function(result){
				$("#Reference").val(result[0].Reference);
				$("#Designation").val(result[0].designation);
				$("#Prix_unit").val(result[0].prix_unitaire);
				$("#Quantite").val(result[0].quantite);
				document.getElementById('Categorie').selectedIndex=result[0].code_categorie-1;
				document.getElementById('Fourni_par').selectedIndex=result[0].code_fournisseur-1;			    		
       	},
       	error:function(result){console.log(result)}
	});
}

function update_Produit(code_produit)
{
		$("#Produit #modal-alert").css('display','none');
   		$(document).ready(function() {
   			if (($("#Reference").val() == "") || ($("#Designation").val() == "") || ($("#Prix_unit").val() == "") || ($("#Quantite").val() == "") )
				{
					$("#Produit #modal-alert").html("REMPLISSEZ TOUS LES CHAMPS");
					$("#Produit #modal-alert").removeClass('alert-danger alert-success');
					$("#Produit #modal-alert").addClass('alert-primary');
					$("#Produit #modal-alert").css('display','block');
				}else{
					$("#modal-alert").css('display','none');
				    $.ajax({
				    		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			            	url: '/Produits/update_Produit',
			            	type: 'POST',
			            	data: {
			            			'code_produit':code_produit,
			            			'refference':$('#Produit #Reference').val(),
			            			'designation':$('#Produit #Designation').val(),
			            			'prix_unitaire':$('#Produit #Prix_unit').val(),
			            			'quantite':$('#Produit #Quantite').val(),
			            			'code_categorie':document.getElementById('Categorie')[document.getElementById('Categorie').selectedIndex].value,
			            			'code_fournisseur':document.getElementById('Fourni_par')[document.getElementById('Fourni_par').selectedIndex].value,
			            		},
			            		
			            	success: function(result) {
			            		console.log(result)
				            		if (result.response) {
					            		$("#Produit #modal-alert").html(result.Message);
									$("#Produit #modal-alert").css('display','block');
									$("#Produit #modal-alert").removeClass('alert-danger');
									$("#Produit #modal-alert").addClass('alert-success');
								}else{
									$("#Produit #modal-alert").html(result.Message);
									$("#Produit #modal-alert").css('display','block');
									$("#Produit #modal-alert").removeClass('alert-success');
									$("#Produit #modal-alert").addClass('alert-danger');
								}

			            	},
			            	error: function(result) {console.log(result)}
			        		});				
				}

		});  		

}


function hide_table(){$(document).ready(function() { $("#statistics #taable").hide() });}
function show_table(){$(document).ready(function() { $("#statistics #taable").show() });}
function empty_table(){$(document).ready(function() { $("#statistics #taable tr:gt(0)").remove() });}


	// SELECT ITEMS SELECTED ITEM CHANGED ------------------------------------

		$(document).ready(function(){
		  $("#annee").on("change", function() {
		  	var etat = $("#etat").val()
		    var annee = $(this).val()
		    commandes_table(annee,etat)
		  });
		});

		$(document).ready(function(){
		  $("#etat").on("change", function() {
		  	var annee = $("#annee").val()
		    var etat = $(this).val()
		    commandes_table(annee,etat)
		  });
		});

		$(document).ready(function(){
		  $("#top10").on("change", function() {
		  	var top10year = $("#top10year").val()
		    var top10 = $(this).val()
		    statistics(top10year,top10)
		  });
		});

		$(document).ready(function(){
		  $("#top10year").on("change", function() {
		  	var top10 = $("#top10").val()
		    var top10year = $(this).val()
		    statistics(top10year,top10)
		  });
		});		


		//-----------------------------------------------------------------











function commandes_table(annee,etat)
{ 
	$(document).ready(function() {
      	 $(function() {
           	$.ajax({
	               	url: '/commandes_filter/'+annee+'/'+etat,
	               	type: 'GET',
	               	success: function (result) {
	               		var filterd_commandes = result
	               		fill_filterd_commandes(filterd_commandes)
	               	},
	               	error: function(result){console.log(result)} 
                	});
            	});
        	});

}


function fill_filterd_commandes(filterd_commandes){
			 
			$("#filtre_commandes tr:gt(0)").remove()
			var filtred_commandes_table = document.getElementById('filtre_commandes')

			
			for (var i = filterd_commandes['commandes'].length - 1; i >= 0; i--) {

        	var row =  filtred_commandes_table.insertRow(1);
			var atrb0 = row.insertCell(0);
			var atrb1 = row.insertCell(1);
			var atrb2 = row.insertCell(2);
			var atrb3 = row.insertCell(3);
			var atrb4 = row.insertCell(4);

			atrb0.innerHTML = filterd_commandes['commandes'][i].numero_cmnd;
			atrb1.innerHTML = filterd_commandes['commandes'][i].name;
			atrb2.innerHTML = filterd_commandes['commandes'][i].date_effectue 
			atrb3.innerHTML = filterd_commandes['periods'][i];
			atrb4.innerHTML = '<button class="btn btn-small btn-dark col-md-12" onclick="cmnd_det('+filterd_commandes['commandes'][i].numero_cmnd+')">Voir les détails </button>';
			$("#filtre_commandes ").addClass('table table-striped table-hover')
			}
}
	

function statistics(top10year,top10){  
$(document).ready(function() {$(function() {$.ajax({url: '/statistics/'+top10year+'/'+top10,type: 'GET',success: function (result) {console.log(result);fill_staistics_table(result)},error: function(result){console.log(result)} });});});}


function fill_staistics_table(statistics){
			 
			$("#statistics_table tr").remove()
			var statistics_table = document.getElementById('statistics_table')

			var row ;var atrb0 ;var atrb1 ;var atrb2 ;var atrb3 ;var atrb4 ;
			
			
			if (statistics['statistics_OF'] == 'CATEGORIE') {
						row =  statistics_table.insertRow(0);
						atrb0 = row.insertCell(0);
						atrb1 = row.insertCell(1);
					 	atrb1.innerHTML = "LIBELLE"
					 	atrb1.style.color = 'white'
					 	atrb0.style.background ='white'
						row.style.backgroundColor='black'
				       /* atrb0.style.border-top-color='white'*/
                         atrb0.style.border='0px'
							for (var i = 0  ; i <statistics['statistics'].length; i++) {
	        				var row =  statistics_table.insertRow(-1);
							atrb0 = row.insertCell(0);
							atrb1 = row.insertCell(1);
						 	atrb0.innerHTML = i+1
						 	atrb0.style.backgroundColor = 'BLACK'
						 	atrb0.style.color = 'white'
						 	atrb1.innerHTML = statistics['statistics'][i].libelle
	        				}
			}else if(statistics['statistics_OF'] == 'FOURNISSEURS'){
						row =  statistics_table.insertRow(0);
						atrb0 = row.insertCell(0);
						atrb1 = row.insertCell(1);
					 	atrb1.innerHTML = "NOM"
					 	atrb1.style.color = 'white'
					 	atrb0.style.background ='white'
						row.style.backgroundColor='black'	
						atrb0.style.border='0px'
							for (var i = 0  ; i <statistics['statistics'].length; i++) {
	        				var row =  statistics_table.insertRow(-1);
							atrb0 = row.insertCell(0);
							atrb1 = row.insertCell(1);
						 	atrb0.innerHTML = i+1
						 	atrb0.style.backgroundColor = 'BLACK'
						 	atrb0.style.color = 'white'					 	
						 	atrb1.innerHTML = statistics['statistics'][i].name
	        				}
			}else if(statistics['statistics_OF'] == 'CLIENTS'){
						row =  statistics_table.insertRow(0);
						atrb0 = row.insertCell(0);
						atrb1 = row.insertCell(1);
						atrb2 = row.insertCell(2);
						atrb3 = row.insertCell(3);
					 	atrb1.innerHTML = "NOM"
						atrb2.innerHTML = "EMAIL"
						atrb3.innerHTML = "QUANTITE COMMANDER"
						atrb1.style.color = 'white'
						atrb2.style.color = 'white'
						atrb3.style.color = 'white'
						atrb0.style.background ='white'
						atrb0.style.border='0px'

						row.style.backgroundColor='black'				
							for (var i = 0  ; i <statistics['statistics'].length; i++) {
	        				var row =  statistics_table.insertRow(-1);
							atrb0 = row.insertCell(0);
							atrb1 = row.insertCell(1);
							atrb2 = row.insertCell(2);
							atrb3 = row.insertCell(3);							
						 	atrb0.innerHTML = i+1
						 	atrb0.style.backgroundColor = 'BLACK'
						 	atrb0.style.color = 'white'
						 	atrb1.innerHTML = statistics['statistics'][i].name
						 	atrb2.innerHTML = statistics['statistics'][i].email
						 	atrb3.innerHTML = statistics['statistics'][i].nbr_qty
	        				}
			}else if(statistics['statistics_OF'] == 'PRODUITS'){
						row =  statistics_table.insertRow(0);
						atrb0 = row.insertCell(0);
						atrb1 = row.insertCell(1);
						atrb2 = row.insertCell(2);
						atrb3 = row.insertCell(3);
					 	atrb1.innerHTML = "REFERENCE"
						atrb2.innerHTML = "DESIGNATION"
						atrb3.innerHTML = "QUANTITÉ VENDUE"
						atrb1.style.color = 'white'
						atrb2.style.color = 'white'
						atrb3.style.color = 'white'
						atrb0.style.background ='white'
						row.style.backgroundColor='black'
						atrb0.style.border='0px'	
							for (var i = 0  ; i <statistics['statistics'].length; i++) {
	        				var row =  statistics_table.insertRow(-1);
							atrb0 = row.insertCell(0);
							atrb1 = row.insertCell(1);
							atrb2 = row.insertCell(2);
							atrb3 = row.insertCell(3);
						 	atrb0.innerHTML = i+1
						 	atrb0.style.backgroundColor = 'BLACK'
						 	atrb0.style.color = 'white'					 	
						 	atrb1.innerHTML = statistics['statistics'][i].REFERENCE
						 	atrb2.innerHTML = statistics['statistics'][i].designation
						 	atrb3.innerHTML = statistics['statistics'][i].qty_total
	        				}
			}
			$("#statistics_table ").addClass('table table-striped')
			console.log($("#statistics_table thead tr").val())

/*			for (var i = filterd_commandes['commandes'].length - 1; i >= 0; i--) {


			}*/
}






