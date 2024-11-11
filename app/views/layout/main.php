<?php include 'header.php' ?>
<main>
    <?php echo $content ?>
</main>
<?php if (isset($footer) && $footer) : ?>
    <?php include 'footer.php'; ?>
<?php endif; ?>