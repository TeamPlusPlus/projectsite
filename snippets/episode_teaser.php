				<section class="episode teaser">
					<h2><a href="<?php echo $p->url(); ?>"><?php echo Episodes::title($p, 0); ?></a></h2>
					
					<?php echo snippet('episode_image', array('p' => $p, 'size' => 400, 'link' => $p->url())); ?>
					<?php echo snippet('episode_meta', array('p' => $p)); ?>
				</section>
