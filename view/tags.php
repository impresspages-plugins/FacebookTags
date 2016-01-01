<?php if (!empty($adminId)) { ?>
    <meta property="fb:admins" content="<?php echo escAttr($adminId) ?>" />
<?php } ?>
<?php if (!empty($title)) { ?>
    <meta property="og:title" content="<?php echo escAttr($title) ?>" />
<?php } ?>
<?php if (!empty($description)) { ?>
    <meta property="og:description" content="<?php echo escAttr($description) ?>" />
<?php } ?>
<?php if (!empty($siteName)) { ?>
    <meta property="og:site_name" content="<?php echo escAttr($siteName) ?>" />
<?php } ?>
<?php if (!empty($images)) { ?>
    <?php foreach($images as $imageUrl) { ?>
        <meta property="og:image" content="<?php echo escAttr($imageUrl) ?>" />
    <?php } ?>
<?php } ?>
