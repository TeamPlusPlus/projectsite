<?php if(!r::is('ajax')) snippet('header') ?>
<?php snippet('menu') ?>

<?php echo snippet('episode_full', array('p' => $page)); ?>

<?php if(!r::is('ajax')) snippet('footer') ?>
