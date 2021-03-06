<?php

// send the right header
header('Content-type: application/rss+xml; charset="utf-8"');

?>
<rss version="2.0" 
		xmlns:content="http://purl.org/rss/1.0/modules/content/" 
		xmlns:wfw="http://wellformedweb.org/CommentAPI/" 
		xmlns:dc="http://purl.org/dc/elements/1.1/" 
		xmlns:atom="http://www.w3.org/2005/Atom"
		xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd"
		xml:lang="de-DE">

	<channel>
		<title><?php echo xml($pages->find('feed')->title()) ?></title>
		<link><?php echo xml(url()) ?></link>
		<lastBuildDate><?php echo date('r', $site->modified()) ?></lastBuildDate>
		<atom:link href="<?php echo xml(thisURL()) ?>" rel="self" type="application/rss+xml" />

		<?php if($pages->find('feed')->description()): ?>
		<description><?php echo xml($pages->find('feed')->description()) ?></description>
		<?php endif ?>
		
		<language>de-de</language>
		
		<itunes:author>Team++</itunes:author>
		<itunes:subtitle><?php echo xml($pages->find('feed')->shortdesc()) ?></itunes:subtitle>
		<itunes:summary><?php echo xml($pages->find('feed')->description()) ?></itunes:summary>
		<itunes:owner>
			<itunes:name>Lukas Bestle</itunes:name>
			<itunes:email>hallo@<?php echo $site->teamurl() ?></itunes:email>
		</itunes:owner>
		<itunes:keywords><?php echo $pages->find('feed')->keywords() ?></itunes:keywords>
		
		<itunes:explicit>No</itunes:explicit>
		<itunes:image href="http://stuff.plusp.lu/Images/<?php echo $site->title(); ?>/profile.png"/>
		
		<itunes:category text="<?php echo xml($pages->find('feed')->category()) ?>">
			<itunes:category text="<?php echo xml($pages->find('feed')->subcategory()) ?>"/>
		</itunes:category>
	
		<?php
		$newestID = Episodes::title(Episodes::newest(), 2);
		$first = true;
		foreach($pages->find('episodes')->children()->flip() as $item):
			if(Episodes::title($item, 2) > $newestID || ($page->type() != 'all' && !Episodes::infos($item)->{$page->type()})) continue; ?>
			
			<item>
				<title><?php echo xml(Episodes::title($item, 4)) ?></title>
				<link><?php echo xml($item->url()) ?></link>
				<guid><?php echo xml($item->url()) ?></guid>
				<pubDate><?php echo date('r', $item->date()) ?></pubDate>
					
				<description><![CDATA[<?php echo kirbytext($item->text()) . Episodes::shownotes(str_replace("<br />\n<br />\n<ul>", '<ul>', kirbytext($item->shownotes())), $item) . kirbytext('[Jetzt diese Folge kommentieren](' . $item->url() . '#disqus_thread)'); ?>]]></description>
				
				<itunes:author>Team++</itunes:author>
				<itunes:explicit>No</itunes:explicit>
				<itunes:subtitle><?php echo strip_tags(kirbytext($item->subtitle())) ?></itunes:subtitle>
				<itunes:summary><?php echo strip_tags(kirbytext($item->text())) ?></itunes:summary>
				<itunes:duration><?php echo Episodes::infos($item)->duration; ?></itunes:duration>
				<itunes:image href="<?php echo Episodes::infos($item)->image[1000]['url'] ?>"/>

				<?php
				$types = array();
				$mime = array(
					'mp3' => 'audio/mpeg',
					'm4a' => 'audio/mp4',
					'opus' => 'audio/ogg; codecs=opus',
					'ogg' => 'audio/ogg; codecs=vorbis'
				);
				switch($page->type()):
          case 'mp3':
          case 'm4a':
          case 'opus':
          case 'ogg':
          	$types = array((string)$page->type());
          	break;
          case 'all':
          	$types = array('mp3', 'm4a', 'opus', 'ogg');
        endswitch;
        
        foreach($types as $type): ?>
        <enclosure url="<?php echo Episodes::infos($item)->{$type}['url']; ?>" length="<?php echo Episodes::infos($item)->{$type}['size'] ?>" type="<?php echo $mime[$type] ?>"/>
        <?php endforeach; ?>
        
        <?php if(Episodes::infos($item)->psc): ?><atom:link rel="http://podlove.org/simple-chapters" href="<?php echo Episodes::infos($item)->psc['url']; ?>" /><?php endif; ?>
  			<atom:link rel="payment" href="<?php echo snippet('flattr', array('url' => $item->url(), 'title' => Episodes::title($item, 4), 'description' => $item->text(), 'notag' => true)); ?>" type="text/html" />
			</item>
		<?php endforeach ?>
	</channel>
</rss>
