<?php
    /**
     * @var $content
     * WARNING: IF WE USE BLADE SYNTAX, HTML's ARE NOT RENDERED PROPERLY
     * FOR EXAMPLE, HTML WILL PRINT '<br/>' INSTEAD OF NEW LINE
     */
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    <div style="background-color:#cccccc; text-align:center; margin-bottom:10px;">
        <img src="https://via.placeholder.com/100x100" style="padding:20px;" alt=""/>
    </div>
    <?php echo @$content;?>
    <br /> <br />

    <div style="border: 2px solid #DDD; text-align:center; padding:10px;">
        <?php echo getenv("MAIL_FROM_DEFAULT_NAME");?>
    </div>
</div>

</body>
</html>
