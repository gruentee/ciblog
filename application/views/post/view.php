<div class="blog-post">
    <h2 class="blog-post-title"><?php echo $post['title'];?></h2>
    <!-- TODO: localize date 
        -->
    <p class="blog-post-meta">geschrieben am <?php echo mdate("%D, %d.%m.%Y %h:%i", mysql_to_unix($post['date_created']));?> 
    von <a href="<?php echo base_url('author/' . $post['user_id']); ?>"><?php echo $post['username']; ?></a>
    </p>
    <?php echo $post['text'];?>
    <?php if(isset($tags)): ?>
        <p class="tags">Tags:
        <?php 
        foreach ($tags as $tag) 
        {
            $attrs = array('class' => 'label label-default');
            echo anchor(
                base_url('tag/'.$tag['tag']), 
                $tag['tag'],
                $attrs
            );
        }
        ?>
        </p>
    <?php endif;?>
    <!-- TODO: maybe output author short bio
        -->
    <?php
        // DEBUG
        //~ echo "<pre>";
        //~ print_r($post);
        //~ echo "</pre>";
    ?>
</div><!-- /.blog-post -->
