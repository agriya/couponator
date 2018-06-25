
var styles = [];


var markerClusterer = null;
var map = null;
var markers = [];

function refreshMap() {
	if (markerClusterer) {
	markerClusterer.clearMarkers();
	}

	
	$.getJSON(__cfg('json_data_url'), function(data) {
	if(data)
	{			
	//console.log(data);
	//alert(data[0]['Store'].id);
	for (var i = 0; i < data['Count']; i++) {

		updateMarker(data[i]['Store'].latitude,data[i]['Store'].longitude,data[i]['Store'].id,i,data[i]['Count'])
	}

	var zoom = null;
	var size = null;
	var style =null;

	markerClusterer = new MarkerClusterer(map, markers, {
	maxZoom: zoom,
	gridSize: size,
	styles: styles[style]
	});
	}

	});


}

function updateMarker(lat,lang,id,count,store_count)
{		
		var imageUrl = __cfg('path_relative')+'img/red/'+store_count+'.png';
		var markerImage = new google.maps.MarkerImage(imageUrl,
		new google.maps.Size(24, 32));
		var latLng = new google.maps.LatLng(lat,lang);
		eval('var marker'+ count+ ' = new google.maps.Marker({position: latLng,draggable: false,icon: markerImage});');
		eval('marker'+ count+'.count='+store_count);
		markers.push(eval('marker'+ count));
		
		var embed_url = __cfg('path_relative') + 'coupons/index/coupon_id:'+id;
		var contentString = '<iframe src="'+embed_url+'" width="279" height="120" frameborder = "0" scrolling="no">Loading...</iframe>';

		eval('var infowindow'+ count + ' = new google.maps.InfoWindow({ content: contentString,  maxWidth: 300});');
		var infowindow_obj = eval('infowindow' + count);
		var marker_obj = eval('marker'+count);


		google.maps.event.addListener(marker_obj, 'click', function() {
		infowindow_obj.open(map,marker_obj);
		});	
}

function initialize() {
	map = new google.maps.Map(document.getElementById('map'), {
	zoom: 3,
	center: new google.maps.LatLng(13.314082,77.695313),
	mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	refreshMap();
}

function clearClusters(e) {
	e.preventDefault();
	e.stopPropagation();
	markerClusterer.clearMarkers();
}