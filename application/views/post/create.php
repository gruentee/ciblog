<?php 
  if($success == FALSE)
  {
?>
<h2><?php echo $title; ?></h2>

<!-- TODO: Zusätzliches Markup hinzufügen 
-->

<?php echo validation_errors(); ?>

<?php echo form_open('post/create'); ?>
  <!-- TODO: localization
    -->
  <div class="form-group">
    <label for="title">Titel</label>
    <input type="text" id="title" name="title" placeholder="Titel des Blog-Posts" class="form-control"
      value="<?=set_value('title');?>">
  </div>
  <div class="form-group">
    <label for="text">Text</label>
    <textarea type="text" name="text" class="form-control" rows="10">
      <?=set_value('text');?></textarea>
  </div>
  <div class="form-group">
    <label for="category">Kategorie</label>
    <?php
      // output category select
      echo form_dropdown('category', $category_options, array(), 
              array('class'=>'form-control'));
    ?>
  </div>
  <div class="form-group">
    <!-- TODO: Möglichkeit, neue Tags hinzuzufügen
      -->
    <label for="tags">Tags</label>
    <?php
      // output category select
      echo form_multiselect('tags[]', $tag_options, array(), 'class="form-control"');
    ?>
  </div>
  <div class="form-group">
    <label for="active">
      <input type="checkbox" checked id="active" class="checkbox-inline">
       Blogpost sichtbar?
    </label>
  </div>
  <button type="submit" class="btn btn-default">Speichern</button>
<?php 
    form_close()
  }
  else
  {
    // form successfully submitted
    echo "Yay! Der Post wurde eingetragen!";
  }
?>
