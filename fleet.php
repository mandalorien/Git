<script src="https://code.jquery.com/jquery-1.11.3.js"></script>
<table>
	<tr>
		<th>vaisseaux :</th>
		<th>Informations :</th>
	</tr>
	<tr>
		<td>
		<!-- info -->
			<table id="ships"></table>
		</td>
		<td>
		<!-- techno -->
		<table>
			<tr>
				<td>Réacteur à combustion :</td>
				<td><input type="" name="RC" /></td>
			</tr>
			<tr>
				<td>Réacteur à Impulsion :</td>
				<td><input type="" name="RI" /></td>
			</tr>
			<tr>
				<td>Propulsion hyperespace :</td>
				<td><input type="" name="PH" /></td>
			</tr>
		</table>
		<!--timer -->
		<table>
			<tr>
				<td>Heure de l'impact [HH:MM:SS]</td>
				<td><input type="" name="HI" /></td>
			</tr>
			<tr>
				<td>Temps restant avant impact [HH:MM:SS] <br>(facultatif  permet d'avoir l'heure de retour si l'attaquant imterompe son attaque)</td>
				<td><input type="" name="HR" /></td>
			</tr>
		</table>
		</td>
	</tr>
</table>
<script>
var ships = [];
ships[202] = 'Petit transporteur';
ships[203] = 'Grand transporteur';
ships[204] = 'Chasseur léger';
ships[205] = 'Chasseur lourd';
ships[206] = 'Croiseur';
ships[207] = 'Vaisseau de bataille';
ships[208] = 'Vaisseau colonisateur';
ships[209] = 'Recycleur';
ships[210] = 'Sondes';
ships[211] = 'Bombardier';
ships[213] = 'Destructeur';
ships[214] = 'EDLM';
ships[215] = 'Traqueur';

var text = "";

for (i = 202; i <= 215 ; i++) {
	text += "<tr>";
	text += "<td>" + ships[i] + " :</td>";
	text += "<td> <input type='checkbox' name='ship' value='" + i + "' /></td>";
	text += "</tr>";
}

$("#ships").append(text);

//faire quand un vaisseaux est checked
	
function HeureCheck()
{
	krucial = new Date;
	heure = krucial.getHours();
	min = krucial.getMinutes();
	sec = krucial.getSeconds();
	jour = krucial.getDate();
	mois = krucial.getMonth()+1;
	annee = krucial.getFullYear();
	if (sec < 10) { sec0 = "0"; }
	else { sec0 = ""; }
	if (min < 10) { min0 = "0"; }
	else { min0 = ""; }
	if (heure < 10) { heure0 = "0"; }
	else { heure0 = ""; }
	if (mois < 10) { mois0 = "0"; }
	else { mois0 = ""; }
	if (jour < 10) { jour0 = "0"; }
	else { jour0 = ""; }
	if (annee < 10) { annee0 = "0"; }
	else { annee0 = ""; }
	DinaDate = "" + jour0 + jour + "/" +  mois0 + mois + "/" + annee0 + annee;
	total = DinaDate
	DinaHeure = heure0 + heure + ":" + min0 + min + ":" + sec0 + sec;
	total = DinaHeure
	total = "Nous sommes le " + DinaDate + " et il est " + DinaHeure + ".";

	if(document.getElementById("dateheure") != null){
		document.getElementById("dateheure").innerHTML = total;
		tempo = setTimeout("HeureCheck()", 1000);
	}
}
window.onload = HeureCheck;

function dateDiff(date1, date2){
    var diff = {}                           // Initialisation du retour
    var tmp = date2 - date1;
 
    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
 
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
 
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures
     
    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours restants
    diff.day = tmp;
     
    return diff;
}

var dateNow = new Date;
krucial = new Date;
// var HI = krucial.getFullYear()+"-"+ (parseInt(krucial.getMonth()) + 1) + "-" + krucial.getDate()+ " " + $("#HI").val();
var HI = krucial.getFullYear()+"-"+ (parseInt(krucial.getMonth()) + 1) + "-" + krucial.getDate()+ " 13:26:51";
//temps restant avant impact = heure d'impact - heure actuelle;
//heure d'impact - temps restant
//temps de retour sans rappel = heure d'impact + durée trajet 
// temps de retour avec rappel = (durée trajet - temps restant) + heure actuelle

// var dateNow = new Date("2018-05-04 12:54:30");
var dateImpact = new Date(HI);

console.log(dateDiff(dateNow,dateImpact));

// vitesse de base + vitesse de base * niveau tech * (2 * ratio tech / 100)
// ratio tech = le ratio multiplicateur de la tech (combustion : 10, impulsion : 20, propulsion : 30)
function speedShips(shipid,rc,ri,ph){
	switch (shipid) {
		case 202:
		if(ri >= 5){
			var speed = 10000 + 10000 * (ri * (20 / 100));
		}else{
			var speed = 5000 + 5000 * (rc * (10 / 100));
		}
		break;
		case 203:
		var speed = 7500 + 7500 * (rc * (10 / 100));
		break;
		case 204:
		var speed = 12500 + 12500 * (rc * (10 / 100));
		break;
		case 205:
		var speed = 10000 + 10000 * (ri * (20 / 100));
		break;
		case 206:
		var speed = 15000 + 15000 * (ri * (20 / 100));
		break;
		case 207:
		var speed = 10000 + 10000 * (ph * (30 / 100));
		break;
		case 208:
		var speed = 2500 + 2500 * (ri * (20 / 100));
		break;
		case 209:
		var speed = 2000 + 2000 * (rc * (10 / 100));
		break;
		case 210:
		var speed = 100000000 + 100000000 * (rc * (10 / 100));
		break;
		case 211:
		if(ph >= 8){
			var speed = 5000 + 5000 * (ph * (30 / 100));
		}else{
			var speed = 4000 + 4000 * (ri * (20 / 100));
		}
		break;
		case 213:
		var speed = 5000 + 5000 * (ph * (30 / 100));
		break;
		case 214:
		var speed = 100 + 100 * (ph * (30 / 100));
		break;
		case 215:
		var speed = 10000 + 10000 * (ph * (30 / 100));
		break;
	}
	
	return speed;
}

// Durées de vol (en secondes)
// % vitesse = % de vitesse d'envoi de la flotte
// vitesse du vaisseau = vitesse du vaisseau le plus lent dans la flotte ; le niveau de technologie du réacteur est déjà compris dans ce nombre (ce n'est pas la vitesse de base qu'il faut utiliser ici ! )

// jusqu'à son propre champ de ruines :
// 10 + [ 35 000 / (% vitesse) * Racine (5 000 / vitesse du vaisseau) ]

// Dans son système solaire :
// 10 + [ 35 000 / (% vitesse) * Racine ((1 000 000 + distance absolue entre les planètes * 5 000) / vitesse du vaisseau) ]

// Dans sa galaxie :
// 10 + [ 35 000 / (% vitesse) * Racine ((2 700 000 + (écart de systèmes) * 95 000) / vitesse du vaisseau) ]

// Dans une autre galaxie :
// 10 + [ 35 000 / (% vitesse) * Racine (écart de galaxies * 20 000 000 / vitesse du vaisseau) ]
function timefly(gU,sU,pU,gT,sT,pT,shipspeed){
	if(gU == gT){
		if(sU == sT){
			if(pU == pT){
				var fly = 10 + ( 35000 / (100) * Math.sqrt(5000 / shipspeed)); // 10 + [ 35 000 / (% vitesse) * Racine (5 000 / vitesse du vaisseau) ]
			}else{
				var fly = 10 + ( 35000 / (100) * Math.sqrt((1000000 + Math.abs(pU - pT) * 5000) / shipspeed));// 10 + [ 35 000 / (% vitesse) * Racine ((1 000 000 + distance absolue entre les planètes * 5 000) / vitesse du vaisseau) ]
			}
		}else{
			var fly = 10 + ( 35000 / (100) * Math.sqrt((2700000 + Math.abs(sU - sT) * 95000) / shipspeed));// 10 + [ 35 000 / (% vitesse) * Racine ((2 700 000 + (écart de systèmes) * 95 000) / vitesse du vaisseau) ]
		}
	}else{
		var fly = 10 + ( 35000 / (100) * Math.sqrt( Math.abs(gU - gT) * 20000000 / shipspeed));// 10 + [ 35 000 / (% vitesse) * Racine (écart de galaxies * 20 000 000 / vitesse du vaisseau) ]
	}
	return fly;
}

console.log(speedShips(204,13,11,8));
console.log(timefly(4,72,8,4,119,9,speedShips(204,13,11,8)));





// Bombardier : 4000 (5000 avec propulsion hyperespace 8)
// Chasseur léger : 12 500
// Chasseur lourd : 10 000
// Croiseur : 15 000
// Destructeur : 5000
// Étoile de la mort : 100
// Grand transporteur : 7500
// Petit transporteur : 5000 (10 000 avec réacteur à impulsion 5)
// Recycleur : 2000
// Sonde d'espionnage : 100 000 000
// Traqueur : 10 000
// Vaisseau de colonisation : 2500
// Vaisseau de bataille : 10 000 
</script>

