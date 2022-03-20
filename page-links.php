<?php

/**
 * 友链页面
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
                <div class="row">
                        <?php
                if (class_exists("Links_Plugin")) {
                    $Links = Links_Plugin::output('

        
        <div class="col-md-3  mb-4 " >
            <div class="links-card">
                <img  style="
    width: 50px;height:50px;
    object-fit: cover;
    border-radius: 8px;" src="{image}" alt="{name}"/>
                <div class="ms-2 "> 
                    <a href="{url}" target="_blank">
             {name}
                </a>
                <br />
                <div style="max-height: 1.5rem;
    overflow: hidden;
    text-overflow: ellipsis;">
                <small title="{description}">{description}</small>
                </div>
                </div>
                </div>
                
    </div>
	');
                }
                ?>
                </div>
               <?php echo RewriteContent($this->content); ?>
                <hr style="margin-left: -16px;margin-right: -16px;">
                <?php $this->need('comments.php'); ?>
            </div>
        </div>


<?php $this->need('footer.php'); ?>
