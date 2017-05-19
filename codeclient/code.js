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

function getID() {
     $("#formGO #formLOG #formSTOP").submit( function(eventObj) {
//         Est-ce que je peux utiliser la date GO? Est-ce que je peux/dois utiliser une date universelle?
         var semaine = document.getElementById('dateGO').value;
         semaine = moment(semaine, 'L').format('YYYYww');
         $('<input />').attr('number', 'hidden')
          .attr('name', "idUnique")
          .attr('value', semaine)
          .appendTo('#formGO #formLOG #formSTOP');
      return true;
  });
}