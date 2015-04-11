<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
    <h4>About</h4>
    <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
  </div>
  <div class="sidebar-module">
    <!-- TODO: generate archive links dynamically 
        -->
    <h4>Archives</h4>
    <ol class="list-unstyled">
      <?php foreach ($sidebar['archive'] as $link): ?>
        <li><?=$link;?></li>
      <?php endforeach;?>
    </ol>
  </div>
  <h4>Kategorien</h4>
  <div class="sidebar-module">
    <ol class="list-unstyled">
      <?php foreach ($sidebar['categories'] as $link): ?>
        <li><?=$link;?></li>
      <?php endforeach;?>
    </ol>
  </div>
  <div class="sidebar-module">
    <h4>Elsewhere</h4>
    <ol class="list-unstyled">
      <li><a href="#">GitHub</a></li>
      <li><a href="#">Twitter</a></li>
      <li><a href="#">Facebook</a></li>
    </ol>
  </div>
</div><!-- /.blog-sidebar -->
