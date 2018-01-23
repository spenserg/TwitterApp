<div class="row">
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
    <h3 class="semibold text-muted" style="text-align:center;">Twitter Search:</h3>
    <br/>
    <form class="panel" action="/twitter/twitter/display" method="POST" id="express-form" style="margin-bottom:10px">
      <div class="panel-body">

        <label for="handle_input">Handle:</label>
        <div class="input-group input-group-lg">
          <span class="input-group-addon">@</span>
          <input type="text" name="handle" class="form-control" id="handle_input" placeholder="Handle" value="<?=$handle?>" />
        </div>

        <br/>
        <div class="form-group">
          <label for="num_tweets"># of Tweets:</label>
          <div class="input-group">
            <input type="number" class="form-control" name="count" id="num_tweets" placeholder="5" value="5" />
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" onclick="inc_num_tweets()">+</button>
            </span>
            <span class="input-group-btn">
              <button class="btn btn-default" type="button" onclick="dec_num_tweets()">-</button>
            </span>
          </div>
          <small>Max value is 100</small>
        </div>

        <div class="form-group">
          <label for="search_input">Search Term(s):</label>
          <input type="text" class="form-control" name="search_term" id="search_input" placeholder="Search" value="<?=$search_term?>" />
          <small>Note: Separate words with a space. Search returns tweets containing any of these terms</small>
        </div>

        <div class="form-group">
          <label for="location_input">Location (Optional):</label>
          <input type="text" class="form-control" name="location" id="location_input" style="margin-bottom:10px" placeholder="Location" value="<?=$location?>" />
          <small>Note: Coordinates are not yet supported</small>
          <div id="geolocate_option">
            <input type="checkbox" onclick="add_location()"> Use Current Location
          </div>
          <input type="hidden" name="is_coords" id="is_coords" value="0" />
        </div>

        <br/>
        <div class="form-group">
          <button type="button" class="btn btn-info btn-lg btn-block" onclick="submit_form()">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> SEARCH
          </button>
        </div>
        
      </div>
    </form>
  </div>
</div>

<script>

  $(function() {
    $('#geolocate_option').hide();
    
    /*
     * Coordinates not currently supported
     *
    //Hide current location option if:
    //Not secure [required by Geolocation API]
    //Geolocation not supported (HTML version < 5 etc)
    if (!(navigator.geolocation && document.URL.includes('https'))) {
      $('#geolocate_option').hide();
    }
    
    */
  })

  $("#num_tweets").mouseup(function() {
    //validate number of tweets on mouse click
    //useful for validation after '+' and '-' buttons are used
    validate_num_tweets();
  });
  
  $("#num_tweets").blur(function(){
    //validate number of tweets when input loses focus
    validate_num_tweets();
  })
  
  function inc_num_tweets() {
    //increment number of tweets
    $("#num_tweets").val(parseInt($("#num_tweets").val()) + 1);
    validate_num_tweets();
  }
  
  function dec_num_tweets() {
    //decrement number of tweets, but not less than 1
    $("#num_tweets").val(parseInt($("#num_tweets").val()) - 1);
    validate_num_tweets();
  }
  
  function validate_num_tweets() {
    //if number of tweets is invalid, set to 1
    var val = parseInt($("#num_tweets").val());
    $("#num_tweets").val(val < 1 ? 1 : val);
    $("#num_tweets").val(val > 100 ? 100 : val);
  }
  
  function add_location() {
    //enter location using HTML 5 Geolocation API
    if (navigator.geolocation && document.URL.includes('https')) {
      navigator.geolocation.getCurrentPosition(twitter_loc);
    }
  }
  
  function twitter_loc(position) {
    //function used in 'add_location' function above
    $('#location_input').val(position.coords.latitude + ', ' + position.coords.longitude);
  }
  
  function is_coordinates(str) {
    if (!(str.includes(','))) { return false; }
    for (var i = 0; i < str.length; i++) {
      var num_string = '1234567890,. ';
      if (!num_string.includes(str[i])) { return false; }
    }
    var coords = str.split(',');
    if (coords.length != 2) { return false; }
    return true;
  }

  function submit_form() {
    var errors = "";
    var alert_type = "danger";
    
    //Reset all borders to gray
    $('#handle_input').css('border-color','#ccc');
    $('#search_input').css('border-color','#ccc');
    $('#num_tweets').css('border-color','#ccc');
    $('#location_input').css('border-color','#ccc');
    
    //Error checking
    if ($("#handle_input").val() == "" && $("#search_input").val() == "") {
      errors = "Please enter either a handle or a term to search.";
      $('#search_input').css('border-color','red');
      $('#handle_input').css('border-color','red').focus();
    } else if ($("#num_tweets").val() == "" || parseInt($("#num_tweets").val()) < 1) {
      errors = "Please enter valid number of tweets.";
      $('#num_tweets').css('border-color','red').focus();
    } else if (is_coordinates($('#location_input').val())) {
      alert_type = "warning";
      $('#location_input').css('border-color','red').focus();
      errors = "Coordinates are not yet supported";
      
/*
 *  Coordinates are not yet supported
 * 
 
      $('#is_coords').val(1);
      var coords = $('#location_input').val().split(',');
      if (parseInt(coords[0]) > 90 || parseInt(coords[0]) < -90) {
        errors = "Latitude cannot be more than 90 or less than -90";
        $('#location_input').css('border-color','red').focus();
      }
      if (parseInt(coords[1]) > 180 || parseInt(coords[1]) < -180) {
        errors = "Longitude cannot be more than 180 or less than -180";
        $('#location_input').css('border-color','red').focus();
      }

*/
    }

    if (errors != ""){
      //If there are errors, create an error box
      $("#errors").html('<div class="fade in alert alert-' + alert_type + '" style="margin-bottom:10px" id="alert_display">'+
            '<button type="button" class="close" data-dismiss="alert" style="font-size:16px">x</button>'+
            '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ' + errors+'</div>');
      window.scrollTo(0,0);
    }else{
      //If no errors, submit the form
      $("#express-form").submit();
    }
  }
</script>