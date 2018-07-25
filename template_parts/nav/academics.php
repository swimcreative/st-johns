<?php

$blog_id = get_current_blog_id();

if ( 1 == $blog_id ) :

// with homerooms
//$html = '<div class="academics-menu-header"><div><a class="active" href="#">Grades</a> &nbsp;| &nbsp;<a href="#">Homerooms</a></div><div>Specialists</div></div>';

//temp
$html = '<div class="academics-menu-header"><div><strong style="color:#666;">Grades</strong></div><div>Specialists</div></div>';

else :

//$html = '<div class="academics-menu-header"><div><a class="active" href="#">Children</a> &nbsp;| &nbsp;<a href="#">Youth</a> &nbsp;| &nbsp;<a href="#">Adult</a></div></div>';

endif;

return $html;

define('USED', true);
