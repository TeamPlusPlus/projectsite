<?php

/**
 * Parse the team member string of an episode
 * 
 * @param string $team  Team members separated with commas
 *
 * @return string       The rendered HTML
 */
function episodeteam($team) {
	// Parse using Kirbytext and split members
	$members = explode(',', str_replace(array('<p>', '</p>'), '', kirbytext($team)));
	
	// Remove whitespace
	array_walk($members, function(&$member) {
		$member = trim($member);
	});
	
	// Sort the items by name
	usort($members, function($a, $b) {
		return (strip_tags($a) < strip_tags($b))? -1 : 1;
	});
	
	// Build the result array
	$return = array();
	foreach ($members as $member) {
		$memberURI = 'http://plusp.lu/content/02-team/' . strtolower(strip_tags($member)) . '/tile.jpg';
		
		// Check if the member image exists
		$ch = curl_init($memberURI);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);
		if(curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200) {
			// Yep, add image
			$return[] = '<img src="' . $memberURI . '" alt="' . strip_tags($member) . '" />' . $member;
		} else {
			$return[] = $member;
		}
	}
	
	// Convert it to a string and return
	return implode(', ', $return);
}
