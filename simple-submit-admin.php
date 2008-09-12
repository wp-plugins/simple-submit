<?php if ( $saved ) { ?>
<div class="updated fade">
	<p>
	<strong>You have saved your Simple Submit Options :)</strong>
	</p>
</div>
<?php } /* if ( $saved ) */ ?>
<div class="wrap">
<h2>Simple Submit Options</h2>
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
	<?php wp_nonce_field(SIMPLESUBMIT_NONCE); ?>
	<ul style="list-style: none;">
	<li>
	<input type="checkbox" name="<?php echo SIMPLESUBMIT_HOMEPAGE; ?>" id="<?php echo SIMPLESUBMIT_HOMEPAGE; ?>" value="1" <?php simple_submit_checked(get_option(SIMPLESUBMIT_HOMEPAGE)); ?> />
	<label for="<?php echo SIMPLESUBMIT_HOMEPAGE; ?>">Display on home page (if the home page is a page)</label>
	</li>
	<li>
	<input type="checkbox" name="<?php echo SIMPLESUBMIT_POSTPAGE; ?>" id="<?php echo SIMPLESUBMIT_POSTPAGE; ?>" value="1" <?php simple_submit_checked(get_option(SIMPLESUBMIT_POSTPAGE)); ?> />
	<label for="<?php echo SIMPLESUBMIT_POSTPAGE; ?>">Display on posts page (also the default home page) </label>
	</li>
	<li>
	<input type="checkbox" name="<?php echo SIMPLESUBMIT_ALLPAGES; ?>" id="<?php echo SIMPLESUBMIT_ALLPAGES; ?>" value="1" <?php simple_submit_checked(get_option(SIMPLESUBMIT_ALLPAGES)); ?> />
	<label for="<?php echo SIMPLESUBMIT_ALLPAGES; ?>">Display on all pages</label>
	</li>
	<li>
	<input type="checkbox" name="<?php echo SIMPLESUBMIT_ALLPOSTS; ?>" id="<?php echo SIMPLESUBMIT_ALLPOSTS; ?>" value="1" <?php simple_submit_checked(get_option(SIMPLESUBMIT_ALLPOSTS)); ?> />
	<label for="<?php echo SIMPLESUBMIT_ALLPOSTS; ?>">Display on all posts (archive pages)</label>
	</li>
	<li>
	<input type="checkbox" name="<?php echo SIMPLESUBMIT_SINGLEPOST; ?>" id="<?php echo SIMPLESUBMIT_SINGLEPOST; ?>" value="1" <?php simple_submit_checked(get_option(SIMPLESUBMIT_SINGLEPOST)); ?> />
	<label for="<?php echo SIMPLESUBMIT_SINGLEPOST; ?>">Display on single posts</label>
	</li>
	<li>
	<input type="checkbox" name="<?php echo SIMPLESUBMIT_OTHERTYPE; ?>" id="<?php echo SIMPLESUBMIT_OTHERTYPE; ?>" value="1" <?php simple_submit_checked(get_option(SIMPLESUBMIT_OTHERTYPE)); ?> />
	<label for="<?php echo SIMPLESUBMIT_OTHERTYPE; ?>">Display on other page types (ones not listed here)</label>
	</li>
	</ul>
	<p class="submit">
	<input type="submit" name="simple_submit" value="Save Options" />
	</p>
</form>
</div>