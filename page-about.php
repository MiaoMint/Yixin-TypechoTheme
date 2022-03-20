<?php

/**
 * 关于页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

        <div class="shadow mb-4 blog-card post-card">
  
            <div class="content-body page-border-radius">
                                   <h2>
                  <?php $this->title() ?>
                  </h2>

                  <hr />
                   <div class="header mb-4">
            <img src="<?php $this->options->aboutimg() ?>" class="rounded-circle" alt="">
            <div class="ms-3">
                <h4 class="title"><?php $this->options->aboutname() ?></h4>
                <p class="description"><?php $this->options->aboutdesc() ?></p>
            </div>
        </div>
                <?php $this->content(); ?>
                
                <hr style="margin-left: -16px;margin-right: -16px;">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>


<?php $this->need('footer.php'); ?>