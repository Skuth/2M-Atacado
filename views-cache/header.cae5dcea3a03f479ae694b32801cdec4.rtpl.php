<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteData = $GLOBALS["siteData"]; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <base href="<?php echo getSiteUrl(); ?>">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title><?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></title>

  <link rel="stylesheet" href="./assets/css/style.min.css?id=<?php echo rand(); ?>">
  <link rel="stylesheet" href="./assets/css/icofont.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/slick.css"/>
  <link rel="stylesheet" href="./assets/css/slick-theme.css">
</head>
<body>
  