function date() {
    var date = new Date().toISOString().substring(0, 10);
//    var date = moment().format('LL');
    var champGO = document.querySelector('#dateGO');
    var champLOG = document.querySelector('#dateLOG');
    var champSTOP = document.querySelector('#dateSTOP');
    champGO.value = date;
    champLOG.value = date;
    champSTOP.value = date;
}

function heure() {
    var heure = moment().format('HH:mm');
    var champGO = document.querySelector('#heureGO');
    var champLOG = document.querySelector('#heureLOG');
    var champSTOP = document.querySelector('#heureSTOP');
    champGO.value = heure;
    champLOG.value = heure;
    champSTOP.value = heure;
}

function getID(form, date) {
     $(form).submit( function(eventObj) {
//         Est-ce que je peux utiliser la date GO? Est-ce que je peux/dois utiliser une date universelle?
         var semaine = document.getElementById(date).value;
         semaine = moment(semaine, 'L').format('YYYYww');
         $('<input />').attr('number', 'hidden')
          .attr('name', "idUnique")
          .attr('value', semaine)
          .appendTo(form);
      return true;
  });
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("No geo for you!");
    }
}

function showPosition(position) {
    $.ajax({
        url: 'http://www.mapquestapi.com/geocoding/v1/reverse?',
        dataType: 'jsonp',
        crossDomain: true,
        data: {
            key: 'eDSGrYBrR7A6TK3vptsjxPpztoL1H6sq',
            location: position.coords.latitude + "," + position.coords.longitude
        },
        success: function(data) {
            document.getElementById('etatGO').value = data.results[0].locations[0].adminArea3;
            document.getElementById('etatLOG').value = data.results[0].locations[0].adminArea3;
            document.getElementById('etatSTOP').value = data.results[0].locations[0].adminArea3;
        },
        error: function (request, status, error) {
            alert(error);
            console.log(request.statusText);
            
            document.getElementById('etatGO').value = "erreur";
            document.getElementById('etatLOG').value = "erreur";
            document.getElementById('etatSTOP').value = "erreur";
    }
    
    
//    console.log("Latitude: " + position.coords.latitude + 
//    "<br>Longitude: " + position.coords.longitude);
});

}
