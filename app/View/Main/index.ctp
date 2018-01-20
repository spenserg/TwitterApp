<div class="row">
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
    <h3 class="semibold text-muted" style="text-align:center;">Twitter Search:</h3>
    <br/>
    <form class="panel" action="/main" method="POST" id="express-form" style="margin-bottom:10px">
      <div class="panel-body">

        <div class="input-group input-group-lg">
          <span class="input-group-addon">@</span>
          <input type="text" class="form-control" id="handle_input" placeholder="Handle" />
        </div>

        <br/>
        <div class="form-group">
          <label for="num_tweets"># of Tweets:</label>
          <div class="input-group">
            <input type="number" class="form-control" id="num_tweets" placeholder="5" value="5" />
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
          <input type="text" class="form-control" id="search_input" placeholder="Search" />
        </div>

        <div class="form-group">
          <label for="location_input">Location (Optional):</label>
          <input type="text" class="form-control" id="location_input" placeholder="Search" />
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

  $("#num_tweets").mouseup(function() {
    validate_num_tweets();
  });
  
  $("#num_tweets").blur(function(){
    validate_num_tweets();
  })
  
  function inc_num_tweets() {
    $("#num_tweets").val(parseInt($("#num_tweets").val()) + 1);
  }
  
  function dec_num_tweets() {
    var val = parseInt($("#num_tweets").val()) - 1;
    $("#num_tweets").val(val);
    validate_num_tweets();
  }
  
  function validate_num_tweets(){
    var val = parseInt($("#num_tweets").val());
    $("#num_tweets").val(val < 1 ? 1 : val);
  }

  function submit_form(){
    var errors = "";
    $('#handle_input').css('border-color','#ccc');
    $('#search_input').css('border-color','#ccc');
    $('#num_tweets').css('border-color','#ccc');
    
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
      $("#errors").html('<div class="fade in alert alert-danger" style="margin-bottom:10px" id="alert_display">'+
            '<button type="button" class="close" data-dismiss="alert" style="font-size:16px">x</button>'+
            errors+'</div>');
      window.scrollTo(0,0);
    }else{
      $("#express-form").submit();
    }
  }
</script>