<?php foreach($posts as $post): ?>
<div class="blog-post">
    <h2 class="blog-post-title">
        <a href="<?=base_url('post/' . $post['slug'])?>"><?php echo $post['title'];?></a>
    </h2>
    <!-- TODO: output author as link to author page -->
    <p class="blog-post-meta">geschrieben am <?php echo mdate("%D, %m.%Y %h:%i", mysql_to_unix($post['date_created']));?> 
    von <a href="<?php echo base_url('author/' . $post['user_id']); ?>"><?php echo $post['username']; ?></a></p>
    <?php echo $post['text'];?>
    
    <!-- TODO: maybe output author short bio -->
</div><!-- /.blog-post -->

<?php endforeach; ?>
