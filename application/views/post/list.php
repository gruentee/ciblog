<?php foreach($posts as $post): ?>
<div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post['title'];?></h2>
    <!-- TODO: output author as link to author page -->
    <p class="blog-post-meta">geschrieben am <?php echo mdate("%D.%m.%Y %h:%i", mysql_to_unix($post['date_created']));?> by <a href="#"><?php echo $post['author']; ?></a></p>

    <?php echo $post['text'];?>
    
    <!-- TODO: maybe output author short bio -->
</div><!-- /.blog-post -->

<?php endforeach; ?>
