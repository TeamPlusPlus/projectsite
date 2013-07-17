				<section class="episode">
					<h2><?php echo Episodes::title($p, 0); ?></h2>
					
					<?php echo snippet('episode_image', array('p' => $p)); ?>
					<?php echo snippet('flattr', array('url' => $p->url(), 'title' => Episodes::title($p, 4), 'description' => $p->text(), 'top' => true)); ?>
					<?php echo snippet('episode_meta', array('p' => $p)); ?>
					
					<div class="player">
						<?php $infos = Episodes::infos($p); ?>
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
					<?php echo Episodes::shownotes(kirbytext($p->shownotes()), $p); ?>
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
				</section>
