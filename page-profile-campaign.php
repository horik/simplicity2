<?php
/*
Template Name: プロフィール案件
*/
?>
<div class="profile-campaign">
  <h2 class="campaign-title"><?php echo get_field('name')?></h2>
  <small><?php echo get_field('type')?></small>
  <div class="campaign-icon">
    <a href="<?php echo get_field('url'); ?>"><img src="<?php echo get_field('icon'); ?>"></a>
  </div>
</div>
