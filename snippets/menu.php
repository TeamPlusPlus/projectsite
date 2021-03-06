<?php if(!r::is('ajax')): ?>
				<div class="nav">
					<span data-icon="r" class="feed">
						<span class="links">
							<a href="podcast://<?php echo $_SERVER['HTTP_HOST']; ?>/feed">Alle</a>
							<a href="podcast://bitlove.org/teamplusplus/<?php echo $site->subdomain() ?>/feed">Bit-<br>love</a>
							<a href="podcast://<?php echo $_SERVER['HTTP_HOST']; ?>/feed/mp3">MP3</a>
							<a href="podcast://<?php echo $_SERVER['HTTP_HOST']; ?>/feed/m4a">M4A</a>
							<a href="podcast://<?php echo $_SERVER['HTTP_HOST']; ?>/feed/opus">Opus</a>
							<a href="podcast://<?php echo $_SERVER['HTTP_HOST']; ?>/feed/ogg">Ogg</a>
						</span>
					</span>
					<span class="thanks nomobile">
						Danke! :)<br>
						Viel Spaß!
					</span>
					<nav>
						<a href="http://<?php echo $site->teamurl(); ?>" class="logo"><img src="http://stuff.plusp.lu/Images/Team/logo_notext.png" alt="<?php echo $site->title(); ?>"></a>
						<ul>
							<li data-icon="l"><a<?php if(Episodes::newest()->isActive()) { echo ' class="active"'; $active = true; } ?> href="<?php echo Episodes::newest()->url(); ?>">Aktuelle Folge</a></li>
<?php foreach($pages->visible() as $p): ?>
							<li<?php if($p->icon()) echo ' data-icon="' . $p->icon() . '"'; ?>><a<?php if($p->isActive() && !isset($active)) echo ' class="active"'; else if($p->isOpen() && !isset($active)) echo ' class="open"'; ?> href="<?php echo $p->url() ?>"><?php echo html($p->title()) ?></a></li>
<?php endforeach; ?>
						</ul>
					</nav>
				</div>
			</header>
			<aside>
				<a href="<?php echo url('/'); ?>/" class="logo"><img src="http://stuff.plusp.lu/Images/<?php echo $site->title(); ?>/logo.png" alt="<?php echo $site->title(); ?>"></a>
				<?php $newestepisode = Episodes::newest(); ?>
				<div class="nomobile">
					<h2>Aktuelle Folge:</h2>
					<a href="<?php echo $newestepisode->url(); ?>"><?php echo Episodes::title($newestepisode, 0); ?></a>
				</div>
				
				<?php $next = Episodes::next(); ?>
				<h2>Nächste Folge: <?php echo $next->infos->number; ?></h2>
				<?php if($next->infos->state == STATE_LIVE) { ?>
				<a href="<?php echo $next->infos->url; ?>" data-icon="b" class="highlight">Live!</a>
				<?php } else if($next->infos->state == STATE_SOON) { ?>
				<span data-icon="b"><?php echo $next->infos->live; ?></span>
				<?php } else if($next->infos->state == STATE_RELIVE) { ?>
				<a href="http://media.plusp.lu/<?php echo site()->subdomain(); ?>/<?php echo $next->infos->id; ?>.relive" data-icon="b" class="highlight">ReLive hören</a>
				<?php } else if($next->infos->state == STATE_RECORDED) { ?>
				<span data-icon="b">ReLive demnächst</span>
				<?php } else { ?>
				<span data-icon="b">In Planung</span>
				<?php } ?>
				
				<div class="nomobile">
					<h2>Kontakt</h2>
					<p>
						<span data-icon="m"><?php echo html::email('hallo@' . $site->teamurl()); ?></span><br>
						<span data-icon="t"><a href="https://twitter.com/TeamPlusPlus">@TeamPlusPlus</a></span>
					</p>
				
					<div class="donate">
						<?php echo snippet('flattr', array('url' => $site->url(), 'title' => $site->title(), 'description' => $site->description())); ?>
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="C3NZ6UJMANXSW">
							<input type="image" src="https://www.paypalobjects.com/de_DE/DE/i/btn/btn_donate_LG.gif" name="submit" alt="Jetzt einfach, schnell und sicher online bezahlen – mit PayPal.">
							<img alt="" src="https://www.paypalobjects.com/de_DE/i/scr/pixel.gif" width="1" height="1">
						</form>
					</div>
				</div>
			</aside>
			<section class="main">
<?php else: 
	echo $site->title() . " » " . Episodes::title($page) . "\n";
	
	if(Episodes::newest()->isActive()) {
		echo Episodes::newest()->url() . " || active";
	} else {
		foreach($pages->visible() as $p) {
			if($p->isActive()) {
				echo $p->url() . " || active";
				break;
			} else if($p->isOpen()) {
				echo $p->url() . " || open";
				break;
			}
		}
	}
	
	echo "\nSEPARATOR----SEPARATOR\n";
endif; ?>
