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
    <br/>
    <a class="btn btn-info" href="/main">Return to Search Page</a>
  </div>
</div>

<?php } else { ?>

<div class="panel panel-info" style="margin:20px">
  <div class="panel-heading">
    <h3 class="panel-title">
      Showing <?=count($tweets)?> Results For:
    </h3>
  </div>
  <div class="panel-body">
    Search Term: "<?=$params['q']?>"<br/>
    User: <?=$params['handle']?><br/>
    <br/>
    <a class="btn btn-info" href="/main">Return to Search Page</a>
  </div>
</div>

<?php foreach($tweets as $val) { ?>
<div class="well">
  <h4 class="semibold text-muted">
    Posted on: <?=date('F j', strtotime($val['created_at']))?>
  </h4>
  <?=$val['full_text']?>
</div>
<?php } ?>

<?php } ?>