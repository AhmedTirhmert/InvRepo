// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("popup");

var btn_cls = document.getElementById("btn-close");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close2")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display="block";
}

/*btn_cls.onclick = function() {
    modal.style.display = "none";
}*/

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        closing()
    }
        if (event.target == cmnd_dtls_modal) {
        	closing()
    }
}
//initializing input fields
var btn_ajouter = document.getElementById("ajouter");
var selected_product = document.getElementById("select_produit");
var selected_product_id = document.getElementById("select_produit_id");
var alert_fill = document.getElementById('alert_fill');
var cmnd_prix_total = document.getElementById("cmnd_prix_total");
var effectue = document.getElementById("effectue");
/*var selected_product_price = document.getElementById("select_produit_prix");*/
var prix_unitaire = document.getElementById("prix_unitaire");
var qty = document.getElementById("qty");
var prix_total = document.getElementById("prix_total")
var new_cmnd_products_table = document.getElementById("new_cmnd_products_table");
var cmnd_dtls_modal = document.getElementById("cmnd_dtls_modal");
var cmnd_dtls_table = document.getElementById("cmnd_dtls_table");
var table_commandes = document.getElementById("table_commandes");
var cmnd_dtls_total = document.getElementById('cmnd_dtl_prix_total');
var cmnd_dtls_date = document.getElementById('cmnd_dtls_date');
var new_cmnd_products = [];	


//initializing input fields

selected_product.onchange = function() { 

	prix_unitaire.value=Number(selected_product[selected_product.selectedIndex].value).toFixed(2);
	prix_total.value = (qty.value * prix_unitaire.value).toFixed(2);

}
qty.onchange = function() {

	prix_total.value = (qty.value * selected_product[selected_product.selectedIndex].value).toFixed(2);

}

document.getElementsByClassName("close2")[1].onclick= function(){
closing();
}

btn_ajouter.onclick = function(){
	alert_fill.style.display="none";
	if ( qty.value != 0 && qty.value > 0 && selected_product[selected_product.selectedIndex].value) {
		if ((new_cmnd_products.indexOf(selected_product[selected_product.selectedIndex].text)) < 0) {
			new_cmnd_products[selected_product_id[selected_product.selectedIndex].value]=selected_product[selected_product.selectedIndex].text;
		
		alert_fill.style.display="none";
		var raw = new_cmnd_products_table.insertRow(1);
		var id = new_cmnd_products_table.rows.length
		var produit = raw.insertCell(0);
		var price = raw.insertCell(1);
		var q_ty = raw.insertCell(2);
		var t_price = raw.insertCell(3);
		var btn_delete = raw.insertCell(4);


		produit.innerHTML =  selected_product[selected_product.selectedIndex].text;
		price.innerHTML =  selected_product[selected_product.selectedIndex].value;
		q_ty.innerHTML =  qty.value;
		t_price.innerHTML =  prix_total.value;
		btn_delete.innerHTML = '<button  class="id_btn btn btn-small btn-danger pull-right" onclick="deleteRow(this)" id="'+ selected_product_id[selected_product.selectedIndex].value +'" >Supprimer</button>'

		var sum = 0;
		for (var i = 1 ; i < new_cmnd_products_table.rows.length; i++) {
		sum += Number(new_cmnd_products_table.rows[i].cells[3].innerHTML);
		}
		cmnd_prix_total.value=sum.toFixed(2);
		qty.value="";
		}else{$("#alert_fill").removeClass('alert-success');$("#alert_fill").addClass('alert-danger');alert_fill.innerHTML="Ce produit est déjà ajouté à cette commande";alert_fill.style.display="block";}

}else{
	
	alert_fill.style.display="block";$("#alert_fill").removeClass('alert-success');$("#alert_fill").addClass('alert-danger');
	qty.value="";
	qty.class="has_error";
	/*qty.focus();*/
}
}
btn_cls.onclick = function() {
closing();
}


function deleteRow(btn) {
  var row = btn.parentNode.parentNode;
	var nbr = Number(cmnd_prix_total.value).toFixed(2);
	var d_nbr = Number(row.cells[3].innerHTML).toFixed(2);
	var rest = nbr - d_nbr;
	delete new_cmnd_products[btn.id]
	alert_fill.style.display="none";
  	cmnd_prix_total.value = rest.toFixed(2) ;
  	row.parentNode.removeChild(row);
}
function cmnd_det(id)
{ 

$(document).ready(function() {
            $(function() {
                $.ajax({
                    url: '/cmnd_dtl/'+id,
                    type: 'get',
                    success: function (data) {
                        var locationsArray = data;
                        add_record(locationsArray,id);
						
                    }
                });
            });
        });
}
function add_record(locationsArray,id){
								cmnd_dtls_date.innerHTML += locationsArray[0].date_effectue;
								document.getElementById('cmnd_dtls_header').innerHTML += id;
								var summ = 0;
								for (var i = locationsArray.length - 1; i >= 0; i--) {
	                        	var row = cmnd_dtls_table.insertRow(1);
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
								atrb5.innerHTML = locationsArray[i].qte_cmnd;
								atrb6.innerHTML = locationsArray[i].qte_cmnd * locationsArray[i].prix_unitaire	;
								summ += locationsArray[i].qte_cmnd * locationsArray[i].prix_unitaire	;
								}
								
								cmnd_dtls_total.value=summ.toFixed(2);
								cmnd_dtls_modal.style.display='block';
}





$(document).ready(function () {
    $("#effectue").click(function(){

							var myObject = {};
							myObject.products = [];								
							var btns = document.getElementsByClassName('id_btn');
							for (var i = 1 ; i < new_cmnd_products_table.rows.length; i++) {
								myObject.products.push({
									"Code_produit":Number(btns[i-1].id),
									"QUANTITE":Number(new_cmnd_products_table.rows[i].cells[2].innerHTML)
								});
							}
							myObject.date_effectue = formatdate(new Date());
							myObject.client_ID = Number( document.getElementById('user_ID').innerHTML);

			/*console.log(myObject);  */
	    $.ajax({
	    	headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: '/commande/insertNewCommande',
            type: 'POST',
            data: myObject,
            success: function(result) {
            	$("#alert_fill").html(result);
            	$("#alert_fill").removeClass('alert-danger');
            	$("#alert_fill").addClass('alert-success');
            	$("#alert_fill").css('display','block');
            	$("#new_cmnd_products_table tr:gt(0)").remove();

            },
            error: function(result) {
            	/*console.log(result); */
            }
        });
    });
});




function formatdate(dt){
	return dt.getFullYear() +'-'+ (dt.getMonth()+1) +'-'+  dt.getDate()
}

function closing()
{
		$("#new_cmnd_products_table tr:gt(0)").remove();
		cmnd_prix_total.value="";
		modal.style.display = "none";
		alert_fill.style.display="none";
		
		new_cmnd_products = [];	

	 	cmnd_dtls_modal.style.display = "none";
        $("#cmnd_dtls_table tr:gt(0)").remove();
        cmnd_dtls_date.innerHTML = "EFFECTUE LE :";
        document.getElementById('cmnd_dtls_header').innerHTML = "Commande N°=";
}
