<div id="simple-submit">
<table>
<tr>
<td>
<a href="<?php echo get_simple_submit_href(SIMPLESUBMIT_DIGG, get_permalink($post->ID), get_the_title()); ?>" title="Submit To Digg" target="_blank" rel="nofollow">
<img src="<?php echo SIMPLESUBMIT_URL . 'digg.png'; ?>" alt="Digg" />
<span>Digg</span>
</a>
</td>
<td>
<a href="<?php echo get_simple_submit_href(SIMPLESUBMIT_STUMBLE, get_permalink($post->ID), get_the_title()); ?>" title="Submit To Stumble Upon" target="_blank" rel="nofollow">
<img src="<?php echo SIMPLESUBMIT_URL . 'stumble.png'; ?>" alt="Stumble Upon" />
Stumble Upon
</a>
</td>
<td>
<a href="<?php echo get_simple_submit_href(SIMPLESUBMIT_DELICIOUS, get_permalink($post->ID), get_the_title()); ?>" title="Submit To Del.icio.us" target="_blank" rel="nofollow">
<img src="<?php echo SIMPLESUBMIT_URL . 'delicious.png'; ?>" alt="Del.icio.us" />
Del.icio.us
</a>
</td>
<td>
<a href="<?php echo get_simple_submit_href(SIMPLESUBMIT_BUZZ, get_permalink($post->ID), get_the_title()); ?>" title="Submit To Yahoo! Buzz" target="_blank" rel="nofollow">
<img src="<?php echo SIMPLESUBMIT_URL . 'buzz.png'; ?>" alt="Buzz" />
Buzz
</a>
</td>
</tr>
</table>
</div>