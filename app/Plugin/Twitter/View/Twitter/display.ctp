<?php if (!count($tweets)) { ?>

<div class="panel panel-danger" style="margin:20px">
  <div class="panel-heading">
    <h3 class="panel-title">
      No Results Found!
    </h3>
  </div>
  <div class="panel-body">
<?php if ($params['search_term'] != '') { ?>
    <b>Search Term:</b> "<?=$params['search_term']?>"<br/>
<?php } if ($params['handle'] != '') { ?>
    <b>User:</b> <?=$params['handle']?><br/>
<?php } if ($location_str != "") { ?>
    <b><?=$is_latlong ? 'Coordinates' : 'Place'?>:</b> <?=$location_str?><br/>
<?php } ?>
    <br/>
    <form method="post" action="/main">
      <button class="btn btn-info" type="submit">Return to Search Page</button>
      <input type="hidden" name="search_term" value="<?=$params['search_term']?>" />
      <input type="hidden" name="handle" value="<?=$params['handle']?>" />
      <input type="hidden" name="location" value="<?=$location_str?>" />
    </form>
  </div>
</div>

<?php } else { ?>

<div class="panel panel-info" style="margin:20px">
  <div class="panel-heading">
    <h3 class="panel-title" style="color:black">
      Showing <?=count($tweets)?> Result<?=count($tweets)==1 ? '' : 's' ?> For:
    </h3>
  </div>
  <div class="panel-body">
<?php if ($params['search_term'] != '') { ?>
    <b>Search Term:</b> "<?=$params['search_term']?>"<br/>
<?php } if ($params['handle'] != '') { ?>
    <b>User:</b> <?=$params['handle']?><br/>
<?php } if ($location_str != "") { ?>
    <b><?=$is_latlong ? 'Coordinates' : 'Place'?>:</b> <?=$location_str?><br/>
<?php } ?>
    <br/>
    <form method="post" action="/main">
      <button class="btn btn-info" type="submit">Return to Search Page</button>
      <input type="hidden" name="search_term" value="<?=$params['search_term']?>" />
      <input type="hidden" name="handle" value="<?=$params['handle']?>" />
      <input type="hidden" name="location" value="<?=$location_str?>" />
    </form>
  </div>
</div>

<?php for ($i = 0; $i < sizeOf($tweets); $i++) { ?>
<div class="well" style="margin:20px" id="tweet_<?=$i?>">
  <button type="button" class="close" onclick="close_well($(this).parent())">x</button>
  <h4 class="semibold text-muted">
    Posted on <?=date('F j', strtotime($tweets[$i]['created_at']))?> by <a href="https://twitter.com/<?=$tweets[$i]['user']['screen_name']?>">@<?=$tweets[$i]['user']['screen_name']?></a>
  </h4>
  <?=$tweets[$i]['full_text']?>
</div>
<?php } ?>

<?php } ?>

<script>
  function close_well(item) {
    item.hide();
  }
</script>