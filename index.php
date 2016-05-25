<?php 
  require_once './classes/Favorites.class.php';
  $o = new Favorites();
  $l = $o->getFavorites('getLinksItems');
  $ar = $o->getFavorites('getArticlesItems');
  $apps = $o->getFavorites('getAppsItems');
?>
<!DOCTYPE html>
<html>

<head>
  <title>Наши рекомендации</title>
  <meta charset="utf-8" />
  <style>
    header {
      border-bottom: 1px solid black;
      text-align: center;
      width: 80%
    }
    
    div#a,
    div#b,
    div#c {
      width: 30%;
      height: 200px;
      float: left
    }
  </style>
</head>

<body>
  <header>
    <h1>Мы рекомендуем</h1>
  </header>
  <div id='a'>
    <h2>Полезные сайты</h2>
    <ul>
        <?php $res = new RecursiveArrayIterator($l); $r = new RecursiveIteratorIterator($res);  ?>
      <?php foreach($r as $k=>$v) { if ($k == 0)  $name = $v; else echo "<li><a href='$v'>$name</a></li>";} /* Список сайтов */ ?>
    </ul>
  </div>
  <div id='b'>
    <h2>Полезные приложения</h2>
    <ul>
        <?php $res = new RecursiveArrayIterator($apps); $r = new RecursiveIteratorIterator($res);?>
        <?php foreach($r as $k=>$v) { if ($k == 0)  $name = $v; else echo "<li><a href='$v'>$name</a></li>";} /* Список сайтов */ ?>
    </ul>
  </div>
  <div id='c'>
    <h2>Полезные статьи</h2>
    <ul>
        <?php $res = new RecursiveArrayIterator($ar); $r = new RecursiveIteratorIterator($res);?>
        <?php foreach($r as $k=>$v) { if ($k == 0)  $name = $v; else echo "<li><a href='$v'>$name</a></li>";} /* Список сайтов */ ?>
    </ul>
  </div>
</body>

</html>