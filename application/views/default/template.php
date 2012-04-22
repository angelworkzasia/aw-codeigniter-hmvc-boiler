<!DOCTYPE html>
<html>
<head>
<title><?php print $title ?></title>
<?php echo link_tag("css/template.css"); ?>
  <script language="javascript" src="<?php echo base_url("js/jquery-1.7.2.js"); ?>" ></script>
</head>
<body>
<div id="wrapper">
<div id="header"><?php print $header ?></div>

<div id="middle-wrapper">
<div id="content"><?php print $content ?></div><div id="rightsidebar"><?php print $rightsidebar ?></div>
</div>

<div id="footer"><?php print $footer?></div>
</div>
   
</body>
</html>