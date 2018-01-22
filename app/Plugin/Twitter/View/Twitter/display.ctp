<?php if (!count($tweets)) { ?>

<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">
      No Results Found!
    </h3>
  </div>
  <div class="panel-body">
    <b>Search Term:</b> "<?=$params['q']?>"<br/>
    <b>User:</b> <?=$params['handle']?><br/>
<?php if ($disp_location) { ?>
    <b><?=$is_latlong ? 'Coordinates' : 'Place'?>:</b> <?=$location_str?><br/>
<?php } ?>
    <br/>
    <a class="btn btn-info" href="/main">Return to Search Page</a>
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
    <b>Search Term:</b> "<?=$params['q']?>"<br/>
    <b>User:</b> <?=$params['handle']?><br/>
<?php if ($disp_location) { ?>
    <b><?=$is_latlong ? 'Coordinates' : 'Place'?>:</b> <?=$location_str?><br/>
<?php } ?>
    <br/>
    <a class="btn btn-info" href="/main">Return to Search Page</a>
  </div>
</div>

<?php for ($i = 0; $i < sizeOf($tweets); $i++) { ?>
<div class="well" style="margin:20px" id="tweet_<?=$i?>">
  <button type="button" class="close" onclick="close_well($(this).parent())">x</button>
  <h4 class="semibold text-muted">
    Posted on: <?=date('F j', strtotime($tweets[$i]['created_at']))?>
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