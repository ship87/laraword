<h1>LaraWord Settings</h1>

<form name="Laravel" method="post" action="#">
	<input type="hidden" name="laravel" value="1"><input type="submit" value="Switch to Laravel Framework on front"/>
</form>
<form name="Wordpress" method="post" action="#">
	<input type="hidden" name="wordpress" value="1"><input type="submit" value="Switch to Wordpress front"/>
</form>

<?php
if ( ! empty( $this->fileService->message ) ) {
    foreach ( $this->fileService->message as $message ) { ?>
		<p><?php echo $message ?></p>
        <?php
    }
}
?>
