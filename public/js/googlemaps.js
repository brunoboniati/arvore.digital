
$(document).ready(function () {
    $("#nasc_latitudeArea").addClass("d-none");
    $("#nasc_longtitudeArea").addClass("d-none");

    $("#obt_latitudeArea").addClass("d-none");
    $("#obt_longtitudeArea").addClass("d-none");
    
});

$(document).on('change','#vivo',function(){
    if( $(this).val()==="0" ){
        $("#obito").removeClass("d-none");
        $("#obt_local").removeClass("d-none");
    } else {
        $("#obito").addClass("d-none");
        $("#obt_local").addClass("d-none");
        $("#obt_dia").val('');
        $("#obt_mes").val('');
        $("#obt_mes").val('');
        $("#obt_local_input").val('');
        $("#obt_latitude").val('');
        $("#obt_longitude").val('');
    }
});

google.maps.event.addDomListener(window, 'load', initialize);

function initialize() {
    var input = document.getElementById('nasc_local');
    var nasc_local = new google.maps.places.Autocomplete(input);

    nasc_local.addListener('place_changed', function () {
        var place = nasc_local.getPlace();
        $('#nasc_latitude').val(place.geometry['location'].lat());
        $('#nasc_longitude').val(place.geometry['location'].lng());
    });

    var input2 = document.getElementById('obt_local_input');
    var obt_local = new google.maps.places.Autocomplete(input2);

    obt_local.addListener('place_changed', function () {
        var place = obt_local.getPlace();
        $('#obt_latitude').val(place.geometry['location'].lat());
        $('#obt_longitude').val(place.geometry['location'].lng());
    });
}

