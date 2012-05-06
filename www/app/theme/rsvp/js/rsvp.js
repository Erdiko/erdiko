(function() {

  var scntDiv = $('#guest-num-rsvps');

  $('#num_guests').change(function() {
    var inputFields = parseInt($('#num_guests').val(), 10);
    scntDiv.empty()
    for (var i = 0; i < inputFields; i++) {
      scntDiv.append($('<p><label for="guest' + (i+1) + '">Guest ' + (i+1) + ' Name:</label> <input id="guest' + (i+1) + '" type="text" alt="Full Name" name="guest' + (i+1) + '" />'));
    }
  });

})();