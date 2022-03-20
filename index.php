<?php

/**
 * @package YiXin
 * @author Erhecy
 * @version 1.5
 * @link https://www.mmcee.cn/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="row">
    <?php if ($this->have()): ?>
<?php $pi = 0; while ($this->next()) : ?>
   <!--<div <?php // if($pi < 2 && $this->_currentPage == 1){ ?> class="col-md-6" <?php // $pi += 1; }else{ ?> class="col-md-12" <?php // } ?>> !-->
        <div class="col-md-12" >
        <div class="shadow mb-4 blog-card">
            <div class="card ov-h text-white yixin-card-header" >
                <img src="<?php if($this->fields->thumb){echo $this->fields->thumb;}else{echo $this->options->morenimg;} ?>" class="card-img" alt="<?php $this->title() ?>">
                <div class="card-img-overlay">
                    <div class="card-overlay-text">
                        <h3 class="card-title"><?php $this->title() ?></h3>
                        <p class="card-text"><?php $this->excerpt(140, '...'); ?></p>
                    </div>
                </div>
                <a href="<?php $this->permalink() ?>" class="stretched-link"></a>
            </div>
            <div class="card yixin-card-body">
                <div class="yixin-body-div">
                    <i class="fa fa-user-circle" aria-hidden="true"></i> <?php $this->author(); ?>
                </div>
                <div class="yixin-body-div">
                    <i class="fa fa-clock" aria-hidden="true"></i> <?php $this->date(); ?>
                </div>
                <div class="yixin-body-div">
                    <i class="fa fa-comment" aria-hidden="true"></i> <?php $this->commentsNum('%d'); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    <?php else: ?>
    
    <div class="col-md-12" >
        <div class="shadow mb-4 blog-card error-msg" >
            <i class="fas fa-exclamation-triangle" ></i>
            <div><h4>暂无文章</h4></div>
            </div>
    </div>
    <?php endif; ?>
    <?php $this->pageNav('<', '>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next',)); ?>
</div>

<?php $this->need('footer.php'); ?>