<?php

if (defined('STDIN')){
	if (isset($argv) && count($argv) == 2){
		// Open the .HTML file for writing
		$outFile = basename($argv[1], '.log').'.html';
		$out = fopen($outFile, 'w') or die ('Could not write to file '.basename($argv[1],'.log').'.html');
	
		// Read all the lines from the file
		$lines = file($argv[1]);
		
		// Load the existing file
		$template = file_get_contents('template.tpl');
		$content = '';
							
		// Loop through all the lines, determining what it is and printing appropriately
		$first = true;
		foreach($lines as $line){
			// Empty line skip
			$line = trim($line);
			if ($line == '') continue;
		
			
			switch(substr($line, 0, 1)){
				case '#':
					if (!$first) $content.='</ul>';
					$line = substr($line,1);
					$content.='<a href="#" class="list-header"><h1>'.$line.'</h1></a><ul id="'.$line.'-list">';
					$first = false;
					break;
				case '+':
					$content.='<li class="task-done">'.trim(substr($line,1)).'</li>';	
					break;
				
				case '-':
					$content.='<li class="task-todo">'.trim(substr($line,1)).'</li>';
					break;
				case '/':
					$content.='<li class="task-progress">'.trim(substr($line,1)).'</li>';
					break;
				default:
					$content.='<li class="note">'.trim($line).'</li>';
				}
			
		}
		
		// Close any hanging UL
		if (!$first)
			$content.='</ul>';
		
		
		// Replace any tags in the template
		$template = str_replace('{{content}}', $content, $template);
		$template = str_replace('{{filename}}', basename($argv[1], '.log'), $template);
		
		// Write to the file
		fwrite($out, $template);
		
		// Close the file and open it
		fclose($out);
		exec($outFile);
	} else {
		echo 'Must pass a given notes file to the NoteSplitter tool through a command line argument.';
	}
} else
	echo 'Must run the NoteSplitter tool from the PHP Command Line Interface';