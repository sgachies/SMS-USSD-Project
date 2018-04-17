
var mapa;

var markery = new Array();
var marki=0;

var dozwolony_obszar = null;
var obszar_maxX = null;
var obszar_maxY = null;
var obszar_minX = null;
var obszar_minY = null;

var nasluch_srodek = null;
var nasluch_zoom = null;
var min_zoom = null;
var max_zoom = null;

var gkod;
var markery = [];
var marki=0;
var sciezka_markery='http://wroclaw.parkometr.net/mapa/images/';

function ustaw_markery(markstr)
	{
marr=markstr.split(";");
for ( var k=0 ; k<marr.length ; k++ )
		{
mar=marr[k].split("|");
//alert(mar[0]+'|'+mar[1]+'|'+mar[2]+'|'+mar[3]);
var pozycja = new google.maps.LatLng(mar[0],mar[1]);
dodaj_marker(pozycja,mar[2]+'('+mar[0]+','+mar[1]+')',mar[3]);
		}
return;
	}

function dodaj_marker(gdzie,tytul,stan)
	{
var roz = new google.maps.Size(20,34);
var sta = new google.maps.Point(0,0);
var zac = new google.maps.Point(10,34);
var rc = new google.maps.Size(37,34);
var kolor = new google.maps.MarkerImage(sciezka_markery+"png/markers/007.png", roz,sta,zac); ikona=sciezka_markery+"png/markers/007.png"; 

//var cien = null;
var cien = new google.maps.MarkerImage(sciezka_markery+"png/shadow50.png", rc,sta,zac);
mark = new google.maps.Marker ( {position:gdzie,map:mapa,icon:kolor,shadow:cien,title:tytul} );
markery[marki]=mark; 
mark.setIcon(ikona);
marki++;
	}


function przestaw_statusy(stat)
{
sta=stat.split(";");
for ( var k=0 ; k<sta.length ; k++ )
		{
es=sta[k].split("|");
//alert(mar[0]+'|'+mar[1]+'|'+mar[2]+'|'+mar[3]);
lat=Number(es[0]).toPrecision(10); lng=Number(es[1]).toPrecision(10); s=es[2]; ani=es[3];

			for ( m=0; m<markery.length; m++ )
			{
//alert(lat+'|'+Number(markery[m].position.lat()).toPrecision(10)+'|'+lng+'|'+markery[m].position.lng()+'|'+s);
if (( Number(markery[m].position.lat()).toPrecision(10) == lat ) && ( Number(markery[m].position.lng()).toPrecision(10)==lng )) 
				{
//alert(lat+'|'+Number(markery[m].position.lat()).toPrecision(10)+'|'+lng+'|'+markery[m].position.lng()+'|'+s);

ico=markery[m].getIcon().split("/");
ic=ico.length-1;
bas=ico[ic].split("\.");
zazn="";

if ( s == 2 ) { markery[m].setIcon(sciezka_markery+"png/markers/002.png"); }
//var kolor = new google.maps.MarkerImage(sciezka_markery+"png/markers/007.png", roz,sta,zac); ikona=sciezka_markery+"png/markers/007.png"; 
if ( s == 5 ) { markery[m].setIcon(sciezka_markery+"png/markers/005.png"); }
if ( s == 7 ) { markery[m].setIcon(sciezka_markery+"png/markers/007.png"); }
if ( s == 13 ) { markery[m].setIcon(sciezka_markery+"png/markers/013.png"); }

//if ( ani == 1 ) { markery[m].setAnimation(google.maps.Animation.BOUNCE); } else { markery[m].setAnimation(null); }

				}
			}
		}
return;
}

function statusy_markerow()
{
$.post('http://wroclaw.parkometr.net/qqmap.php', {
'km' : '1',
'kluczyk' : $("#kluczyk_id").val()
} , function ( data ) 	{ if ( data != 'KICHAS' ) {   przestaw_statusy(data); } else { alert('Błąd S'); } }
);
}


function sprawdz_obszar() {
google.maps.event.removeListener(nasluch_srodek);
 if (dozwolony_obszar.contains(mapa.getCenter())) return;

         c = mapa.getCenter();
         x = c.lng();
         y = c.lat();

     if (x < obszar_minX) x = obszar_minX;
     if (x > obszar_maxX) x = obszar_maxX;
     if (y > obszar_minY) y = obszar_minY;
     if (y < obszar_maxY) y = obszar_maxY;

     mapa.setCenter(new google.maps.LatLng(y, x));
nasluch_srodek = google.maps.event.addListener(mapa,'center_changed',function() { sprawdz_obszar(); });
}

function przestaw_zoom(poziom)
{
google.maps.event.removeListener(nasluch_zoom);
     mapa.setZoom(poziom);
nasluch_zoom = google.maps.event.addListener(mapa,'zoom_changed',function() { sprawdz_zoom(); });
}

function sprawdz_zoom() {
if ( mapa.getZoom() <= min_zoom ) { przestaw_zoom(min_zoom); }
if ( mapa.getZoom() >= max_zoom ) { przestaw_zoom(max_zoom); }
}

function inicjalizacja_mapy_google(data)
{
init=data.split("|");
    var myOptions = {
      zoom: Number(init[8]),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
mapa = new google.maps.Map(document.getElementById("mapa_google"),myOptions);
p=new google.maps.LatLng(init[0],init[1]);
mapa.setCenter(p);
dozwolony_obszar= new google.maps.LatLngBounds(new google.maps.LatLng(Number(init[2]),Number(init[3])), new google.maps.LatLng(Number(init[4]), Number(init[5])) );
obszar_maxX = dozwolony_obszar.getNorthEast().lng();
obszar_maxY = dozwolony_obszar.getNorthEast().lat();
obszar_minX = dozwolony_obszar.getSouthWest().lng();
obszar_minY = dozwolony_obszar.getSouthWest().lat();
//alert('obszar_maxX:'+obszar_maxX+'|obszar_maxY:'+obszar_maxY+'|obszar_minX:'+obszar_minX+'|obszar_minY:'+obszar_minY);

min_zoom=Number(init[6]);
max_zoom=Number(init[7]);
//nasluch_srodek = google.maps.event.addListener(mapa,'center_changed',function() { sprawdz_obszar(); });
nasluch_zoom = google.maps.event.addListener(mapa,'zoom_changed',function() { sprawdz_zoom(); });

}


function ustaw_mape_google()
{
$.post('http://wroclaw.parkometr.net/qqmap.php', {
'do' : '1',
'api' : '1'
} , function ( data ) 	{  if ( data != 'KICHAO' ) { inicjalizacja_mapy_google(data); } else { alert('Błąd O'); } }
);

marki=0;
$.post('http://wroclaw.parkometr.net/qqmap.php', {
'wm' : '1'
} , function ( data ) 	{  if ( data != 'KICHAM' ) { ustaw_markery(data); } else { alert('Błąd M'); } }
);

statusy_markerow();
}

