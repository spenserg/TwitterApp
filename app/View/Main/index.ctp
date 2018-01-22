<div class="row">
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
    <h3 class="semibold text-muted" style="text-align:center;">Twitter Search:</h3>
    <br/>
    <form class="panel" action="/twitter/twitter/display" method="POST" id="express-form" style="margin-bottom:10px">
      <div class="panel-body">

        <div class="input-group input-group-lg">
          <span class="input-group-addon">@</span>
          <input type="text" name="handle" class="form-control" id="handle_input" placeholder="Handle" />
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
        </div>

        <div class="form-group">
          <label for="search_input">Search Term:</label>
          <input type="text" class="form-control" name="q" id="search_input" placeholder="Search" />
        </div>

        <div class="form-group">
          <label for="location_input">Location (Optional):</label>
          <input type="text" class="form-control" name="location" id="location_input" style="margin-bottom:10px" placeholder="Search" />
          <div id="geolocate_option">
            <input type="checkbox" onclick="add_location()"> Use Current Location
          </div>
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
    //Hide current location option if:
    //Not secure [required by Geolocation API]
    //Geolocation not supported (HTML version < 5 etc)
    if (!(navigator.geolocation && document.URL.includes('https'))) {
      $('#geolocate_option').hide();
    }
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
  }
  
  function dec_num_tweets() {
    //decrement number of tweets, but not less than 1
    var val = parseInt($("#num_tweets").val()) - 1;
    $("#num_tweets").val(val);
    validate_num_tweets();
  }
  
  function validate_num_tweets() {
    //if number of tweets is invalid, set to 1
    var val = parseInt($("#num_tweets").val());
    $("#num_tweets").val(val < 1 ? 1 : val);
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

  function submit_form() {
    var errors = "";
    
    //Reset all borders to gray
    $('#handle_input').css('border-color','#ccc');
    $('#search_input').css('border-color','#ccc');
    $('#num_tweets').css('border-color','#ccc');
    
    //Error checking
    if ($("#handle_input").val() == "") {
      errors = "Please enter a handle to search.";
      $('#handle_input').css('border-color','red').focus();
    } else if ($("#num_tweets").val() == "" || parseInt($("#num_tweets").val()) < 1) {
      errors = "Please enter valid number of tweets.";
      $('#num_tweets').css('border-color','red').focus();
    } else if ($("#search_input").val() == "") {
      errors = "Please enter a search term.";
      $('#search_input').css('border-color','red').focus();
    }
    
    if (errors != ""){
      //If there are errors, create an error box
      $("#errors").html('<div class="fade in alert alert-danger" style="margin-bottom:10px" id="alert_display">'+
            '<button type="button" class="close" data-dismiss="alert" style="font-size:16px">x</button>'+
            errors+'</div>');
      window.scrollTo(0,0);
    }else{
      //If no errors, submit the form
      $("#express-form").submit();
    }
  }
</script>