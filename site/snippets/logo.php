<?php if ($logo = $site->logo()->toFile()): ?>
	<a class="" href="<?= $site->url() ?>">
		<img class="" src="<?= $logo->url() ?>" alt="<?= $logo->alt() ?>" width="106" height="32"/>
	</a>
<?php endif ?>