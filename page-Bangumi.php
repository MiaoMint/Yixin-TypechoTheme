<?php

/**
 * 追番列表
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
                <?php $this->content(); ?>
                <?php BiliBangumi_Plugin::output(); ?>
                <hr style="margin-left: -16px;margin-right: -16px;">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>
 
<?php $this->need('footer.php'); ?>