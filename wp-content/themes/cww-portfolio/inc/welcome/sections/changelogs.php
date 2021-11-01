<div class="cww-theme-steps-list">
	<div class="left-box-wrapper-outer cww-changelogs">
		<h3 class="cww-box-header"><?php esc_html_e('Changelogs','cww-portfolio'); ?></h3>
	<?php
	WP_Filesystem();
	global $wp_filesystem;
	$changelog 			= $wp_filesystem->get_contents( get_theme_file_uri('/readme.txt') );
	$changelog_start 	= strpos($changelog,'== Changelog ==');
	$changelog_before 	= substr($changelog,0,($changelog_start));
	$changelog 			= str_replace($changelog_before,'',$changelog);
	$changelog 			= str_replace('== Changelog ==','',$changelog);
	$changelog 			= str_replace('= 1.0','<br/><br/>= 1.0',$changelog);
	echo ''.wp_kses_post($changelog);
	echo '<br/><br/><hr />';
	?>
</div>
<?php $this->admin_sidebar_contents(); ?>
</div>