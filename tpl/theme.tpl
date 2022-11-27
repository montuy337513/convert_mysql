<!DOCTYPE html>
<html lang="{$lang}">
<head>
<meta charset="UTF-8">
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>{$smarty.const.TITRE}</title>
<meta name="author" content="CHG-WEB - Cédric MONTUY" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="robots" content="NOFOLLOW, NOINDEX">
<link rel="icon" type="image/x-icon" href="{$url}/img/favicon.ico" />
<link rel="apple-touch-icon" href="{$url}/img/app-icon.png" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" media="all" title="Style sheet" href="{$url}/style.css" />
</head>
<body>
    <header class="d-flex align-items-center p-3 my-3 text-black-50 bg-purple rounded shadow-sm">
        <div id="logo" class="mr-3">
            <img src="{$url}/img/logo.png" alt="chg-web, création , hébergement, gestion de site web" />
        </div>
        <div class="lh-100 m-auto ">
            <h1 class="titre">{$smarty.const.TITRE}</h1><p><br /></p>
        
        </div>
    </header>
    <div class="container-fluid">
        <main class="col-md-12 col-xl-12 py-md-12 pl-md-12 bd-content" role="main">
              <div class="container">
                {eval var=$content}
              </div>
        </main>
    </div>
        <footer class="d-flex align-items-center p-3 my-3 text-black-50 rounded shadow-sm ">
            <div class="container">
                <p class="text-center lh-100"><strong>Convert-sql  -  Version : {$version}</strong> | {$smarty.const.LICENCE} <a href="http://www.gnu.org/licenses/gpl-3.0.html" hreflang="{$lang}" rel="licence" target="_blank" >GPLv3</a></p> 
                <p class="text-center lh-100">
                    <a href="https://github.com/montuy337513/convert_mysql/issues" hreflang="{$lang}" rel="help" target="_blank" title="{$smarty.const.SIGNAL_BUG}">{$smarty.const.SIGNAL_BUG}</a> | 
                    <a href="https://store.chg-web.com/{$lang}/content/7-inscription-a-la-newsletter" hreflang="{$lang}" rel="external" target="_blank" title="{$smarty.const.NEWSLETTER}">{$smarty.const.NEWSLETTER}</a> |
                    <a href="https://store.chg-web.com/{$lang}/" rel="external" target="_blank" hreflang="{$lang}" title="{$smarty.const.SERVICE}">{$smarty.const.SERVICE}</a> |
                    <a href="https://github.com/montuy337513/" rel="author" target="_blank" hreflang="{$lang}" title="{$smarty.const.GITHUB}"><i class="fa fa-github" aria-hidden="true"></i></a> |
                    <a href="https://www.linkedin.com/in/cedricmontuy/" rel="author" target="_blank" hreflang="{$lang}" title="{$smarty.const.IN}"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                    
                
                </p>
            </div>
        </footer>
</body>
<script src="{$url}/js/jquery.buttonLoader.min.js"></script>
</html>
