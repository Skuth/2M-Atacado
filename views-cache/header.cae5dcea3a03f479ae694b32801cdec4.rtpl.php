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
  
  <link rel="apple-touch-icon" sizes="180x180" href="./assets/icons/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/icons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="194x194" href="./assets/icons/favicon-194x194.png">
  <link rel="icon" type="image/png" sizes="192x192" href="./assets/icons/android-chrome-192x192.png">
  <link rel="icon" type="image/png" sizes="16x16" href="./assets/icons/favicon-16x16.png">
  <link rel="manifest" href="./assets/icons/site.webmanifest">
  <meta name="msapplication-TileColor" content="#337dec">
  <meta name="msapplication-TileImage" content="./assets/icons/mstile-144x144.png">
  <meta name="theme-color" content="#337dec">
  
  <title><?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?></title>

  <?php $keywords = "2m atacado, 2m, atacado, material de construção, construção, casa, ferramentas"; ?>
  <?php $description = "2M Atacado, Empresa no mercado desde 2019 com os melhores preços no mercado, com uma grande variedade de produtos, como: ferramentas, produtos para casa, alicates, torneiras, e muito mais. Estamos localizados em Cabo Frio - RJ."; ?>

  <link rel="canonical" href="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>">

  <meta name="description" content="<?php if( $seoTags['desc'] != '' ){ ?><?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php }else{ ?><?php echo htmlspecialchars( $description, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
  <meta name="keywords" content="<?php echo htmlspecialchars( $keywords, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php if( $seoTags['tags'] != '' ){ ?>, <?php echo htmlspecialchars( $seoTags["tags"], ENT_COMPAT, 'UTF-8', FALSE ); ?><?php } ?>">
  <meta name="robots" content="index, follow">
  <meta name="revisit-after" content="1 day">
  <meta name="language" content="Portuguese">
  <meta name="generator" content="N/A">

  <meta property="og:locale" content="pt_BR">
  <meta property="og:url" content="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?><?php echo htmlspecialchars( $reqUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars( $description, ENT_COMPAT, 'UTF-8', FALSE ); ?>. <?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars( $siteUrl, ENT_COMPAT, 'UTF-8', FALSE ); ?>/<?php echo htmlspecialchars( $seoTags["thumbnail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">

  <meta name="twitter:card" content="summary">
  <meta name="twitter:title" content="<?php echo htmlspecialchars( $siteData["site_data_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?> - <?php echo htmlspecialchars( $seoTags["title"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars( $description, ENT_COMPAT, 'UTF-8', FALSE ); ?>. <?php echo htmlspecialchars( $seoTags["desc"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
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

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-162091833-2"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    
    gtag('config', 'UA-162091833-2');
  </script>

  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./assets/css/style.min.css?v=<?php echo htmlspecialchars( $GLOBALS['version'], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
  <link rel="stylesheet" href="./assets/css/icofont.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/css/slick.min.css"/>
  <link rel="stylesheet" href="./assets/css/slick-theme.min.css">
</head>
<body>
  