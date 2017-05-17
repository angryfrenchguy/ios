function date() {
    var date = new Date().toISOString().substring(0, 10);
//    var date = moment().format('LL');
    var champ = document.querySelector('#date');
    champ.value = date;
}

function heure() {
    var heure = moment().format('HH:mm');
    var champ = document.querySelector('#heure');
    champ.value = heure;
    console.log()
}

function getID() {
     $("#form").submit( function(eventObj) {
         var semaine = document.getElementById('date').value;
         semaine = moment(semaine, 'L').format('YYYYww');
         $('<input />').attr('number', 'hidden')
          .attr('name', "idUnique")
          .attr('value', semaine)
          .appendTo('#form');
      return true;
  });
}