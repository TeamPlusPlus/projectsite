				<section class="episode<?php if(isset($onlyimage)) echo " float"; ?>">
					<?php if(isset($link) && $link) {
						$linkTag = "<a href=\"$link\">";
						$linkCloseTag = "</a>";
					} else {
						$linkTag = "";
						$linkCloseTag = "";	
					} ?>
					
					<?php if(!isset($onlyimage)) { ?>
					<h2><?php echo $linkTag; ?><?php echo Episodes::title($p, 0); ?><?php echo $linkCloseTag; ?></h2>
					<?php } ?>
					
<?php $image = Episodes::infos($p)->image['url']; ?>
<?php if($image): ?>
					<?php echo $linkTag; ?><img src="<?php echo $image; ?>" height=200 width=200 class="episodelogo" alt="<?php echo Episodes::title($p, 0); ?>"><?php echo $linkCloseTag; ?>
<?php endif; ?>
					<?php if(!isset($onlyimage)) { ?>
					<?php if(!isset($teaser)) { ?><iframe src="http://api.flattr.com/button/view/?uid=teamplusplus&amp;url=<?php echo rawurlencode($p->url()); ?>&amp;title=<?php echo rawurlencode(html(Episodes::title($p, 4))); ?>&amp;description=<?php echo rawurlencode(html($p->text())) ?>&amp;category=audio&amp;language=de_DE" style="width:55px; height:62px;" class="flattrtop"></iframe><?php } ?>
					<ul class="infos block">
						<li data-icon="d"><?php echo $p->date('d.m.Y H:i'); ?></li>
						<li data-icon="h"><?php echo $p->team(); ?></li>
					</ul>
					<div class="intro">
					<?php echo kirbytext($p->text()); ?>
					</div>
					
					<?php if(!isset($teaser)) { ?>
					<div class="player">
						<?php $infos = Episodes::infos(Episodes::newest()); ?>
						<audio controls preload="metadata" id="podloveplayer">
							<?php if($infos->mp3) { ?><source src="<?php echo $infos->mp3['url']; ?>" type="audio/mpeg"><?php } ?>
							<?php if($infos->m4a) { ?><source src="<?php echo $infos->m4a['url']; ?>" type="audio/mp4"><?php } ?>
							<?php if($infos->ogg) { ?><source src="<?php echo $infos->ogg['url']; ?>" type="audio/ogg; codecs=vorbis"><?php } ?>
							<?php if($infos->opus) { ?><source src="<?php echo $infos->opus['url']; ?>" type="audio/ogg; codecs=opus"><?php } ?>
						</audio>
						<script>
							$('#podloveplayer').podlovewebplayer({
								poster: '<?php echo Episodes::infos($p)->image['url']; ?>',
								title: '<?php echo Episodes::title($p, 4); ?>',
								permalink: '<?php echo $p->url(); ?>',
								subtitle: '<?php echo html($p->subtitle()); ?>',
								duration: '<?php echo gmdate('H:i:s', $infos->duration); ?>',
								chapters: <?php echo json_encode($infos->chapters); ?>
							});
						</script>
					</div>
					
					<div class="shownotes">
					<?php echo kirbytext($p->shownotes()); ?>
					</div>
					
					<hr>
					<div id="disqus_thread"></div>
					<script type="text/javascript">
    				var disqus_shortname = '<?php echo $site->subdomain() ?>plusplus';
    				var disqus_identifier = '<?php echo $p->uri(); ?>';
    				var disqus_title = '<?php echo Episodes::title($p, 4); ?>';
    				var disqus_url = '<?php echo $p->url(); ?>';
    				
    				(function() {
        			var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
        			dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
        			(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
    				})();
					</script>
					<?php } ?>
					<?php } ?>
				</section>
