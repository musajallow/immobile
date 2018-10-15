<div class="searchResult">
<h1>Result:</h1>
<p><?php var_dump($_POST);?></p>
<?php
if (isset($_POST['search-database'])) {
  //var_dump($data['searchResults']);
  var_dump($data);
  echo "<p>The other results: <br><br>";
  var_dump($_POST['search-database']);
  echo "</p>";
} else {
  echo "<h1>No product found</h1>";
}
?>
</div>

<!--
<form class="navbar-form navbar-left" name="" action="<?php echo URLrewrite::BaseURL().'search'?>" method="get">
        <div class="form-group">
          <input type="text" id="search" autocomplete="off" class="form-control" placeholder="Search" onkeyup="searchMobile();">
          <button type="submit" class="btn btn-success" type="btn" name="submit-search">Search</button>
          <div class="display"></div>
        </div>
        
</form>
-->