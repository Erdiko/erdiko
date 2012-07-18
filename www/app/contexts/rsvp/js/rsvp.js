(function() {

  var scntDiv = $('#guest-num-rsvps');

  // Create input fields based upon select option
  $('#num_guests').change(function() {
    var inputFields = parseInt($('#num_guests').val(), 10);
    scntDiv.empty()
    for (var i = 0; i < inputFields; i++) {
      scntDiv.append($('<p><label for="guest' + (i+1) + '">Guest ' + (i+1) + ' Name:</label> <input id="guest' + (i+1) + '" type="text" alt="Full Name" name="guest' + (i+1) + '" />'));
    }
  });

  // Check for empty fields
  $(':submit').click(function(e) {
    $(':text').each(function() {
      if ($(this).val().length === 0) {
        $(this).addClass('error');
		document.getElementById("form-error-text").innerText = "Make sure you have entered all guest names."; // for IE
		document.getElementById("form-error-text").textContent = "Make sure you have entered all guest names."; // for the rest of the known world
        e.preventDefault();
      } else {
        $(this).removeClass('error');
      }
    });
  });

})();