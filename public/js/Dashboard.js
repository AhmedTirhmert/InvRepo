//VARIABLES
var cmnd_prix_total = document.getElementById("cmnd_prix_total");
var prix_unitaire = document.getElementById("prix_unitaire");
var qty = document.getElementById("qty");
var prix_total = document.getElementById("prix_total")
var cmnd_dtls_modal = document.getElementById("cmnd_dtls_modal");
var cmnd_dtls_table = document.getElementById("cmnd_dtls_table");
var cmnd_dtls_total = document.getElementById('cmnd_dtl_prix_total');
var cmnd_dtls_date = document.getElementById('cmnd_dtls_date');


function tables_serache(section)
{
	$(document).ready(function(){
  $("#searche_"+section).on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#"+section+"s_table tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
}







document.getElementsByClassName("close2")[0].onclick = function() { 
	document.getElementById('cmnd_dtls_modal').style.display='none'; 
        	$("#cmnd_dtls_table tr:gt(0)").remove();
       	cmnd_dtls_date.innerHTML = "EFFECTUE LE :";
};


function cmnd_det(id)
{ 

$(document).ready(function() {
            $(function() {
                $.ajax({
                    url: '/cmnd_dtl/'+id,
                    type: 'get',
                    success: function (data) {
                        var locationsArray = data;
                       console.log(locationsArray);
                        add_record(locationsArray);
						
                    }
                });
            });
        });
}

function add_record(locationsArray){
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
								cmnd_dtls_date.innerHTML += locationsArray[0].date_effectue;
								cmnd_dtls_modal.style.display='block';
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
        cmnd_dtls_date.innerHTML = "EFFECTUE LE :";
    }
}

