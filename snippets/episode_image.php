					<?php if($image = Episodes::infos($p)->image[$size]['url']): ?>
						<?php if(isset($link)): ?><a href="<?php echo $p->url(); ?>"><?php endif; ?>
							<img src="<?php echo $image; ?>" height=200 width=200 class="episodelogo" alt="<?php echo Episodes::title($p, 0); ?>">
						<?php if(isset($link)): ?></a><?php endif; ?>
					<?php endif; ?>
