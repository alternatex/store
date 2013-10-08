<!DOCTYPE HTML>
<html lang="de">
<head>
	<meta charset="UTF-8">
	<title>Example 05: <?php echo h($page_title) ?></title>
</head>
<body>
  <h1><?php echo h($page_title) ?></h1>
  
  <!--
    $sidebar contains the content_for('sidebar') captured content.
  -->
  
  <?php if(!empty($sidebar)): ?>
  <div id="sidebar">
    <h2>Sidebar</h2>
    <?php echo $sidebar; ?>
  </div>
  <?php endif; ?>

  <?php if(!empty($lalalalalalalalalala)): ?>
  <div id="lalalalalalalalalala">
    <h2>Lalalalalalalalalala</h2>
    <?php echo $lalalalalalalalalala; ?>
  </div>
  <?php endif; ?>  

  <div id="main">
    <!-- main content -->
    <h2>Main content</h2>
    <?php echo $content; ?>
  </div>

</body>
</html>