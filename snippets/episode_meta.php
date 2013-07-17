					<ul class="infos block nomargintop">
						<li data-icon="d"><?php echo $p->date('d.m.Y H:i'); ?></li>
						<li data-icon="h"><?php echo $p->team(); ?></li>
					</ul>
					
					<div class="intro">
					<?php echo kirbytext($p->text()); ?>
					</div>
