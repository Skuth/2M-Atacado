<?php if(!class_exists('Rain\Tpl')){exit;}?><?php $siteUrl = getSiteUrl(); ?>
<?php $reqUrl = $_SERVER["REQUEST_URI"]; ?>
<?php $siteData = $GLOBALS["siteData"]; ?>
<?php $seoTags = $GLOBALS["seoTags"]; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <base href="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/">

  <meta charset="UTF-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  
  <!-- SEO -->
  <title><?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?></title>

  <link rel="canonical" href="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>">

  <meta name="description" content="<?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars( $seoTags["tags"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="1 day">
  <meta name="language" content="Portuguese">
  <meta name="generator" content="N/A">

  <meta property="og:locale" content="pt_BR">
  <meta property="og:url" content="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $seoTags["thumbnail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $seoTags["thumbnail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

  <?php if( $seoTags['product'] == true ){ ?>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org/", 
      "@type": "Product", 
      "name": "<?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
      "image": "<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $seoTags["thumbnail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
      "description": "<?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
      "brand": "<?php echo htmlspecialchars( $seoTags["productInfo"]["brand"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
      "sku": "<?php echo htmlspecialchars( $seoTags["productInfo"]["ref"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
      <?php if( strlen($seoTags['productInfo']['priceOff']) > 0 ){ ?>

      "offers": {
        "@type": "Offer",
        "url": "<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>",
        "priceCurrency": "BRL",
        "price": "<?php echo htmlspecialchars( $seoTags["productInfo"]["priceOff"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
        <?php if( strlen($seoTags['productInfo']['offDate']) > 0 ){ ?>"priceValidUntil": "<?php echo htmlspecialchars( $seoTags["productInfo"]["offDate"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",<?php } ?>

        "availability": "https://schema.org/InStock",
        "itemCondition": "https://schema.org/NewCondition"
      }
      <?php } ?>

    }
  </script>    
  <?php }else{ ?>
  <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Organization",
      "name": "<?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?>",
      "url": "<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/",
      "logo": "<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/assets/img/logo.png"
      "address": "Rio de Janeiro"
    }
  </script>
  <?php } ?>

  <!-- SEO -->

  <link rel="stylesheet" href="./assets/css/style.min.css?id=<?php echo rand(); ?>">
  <link rel="stylesheet" href="./assets/css/icofont.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/slick.css"/>
  <link rel="stylesheet" href="./assets/css/slick-theme.css">
</head>
<body>
  