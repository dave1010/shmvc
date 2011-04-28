<?php

// this plugin adds a copyright footer at the end of every page

function add_copyright_footer() {
	echo '<hr>&copy;';
}

\Shmvc\add_action('end', 'add_copyright_footer');
