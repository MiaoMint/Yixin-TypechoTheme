<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

        <div class="shadow mb-4 blog-card post-card">
            <div class="card ov-h bg-dark text-white yixin-card-header">
                <img style="height:400px" src="<?php if ($this->fields->thumb) {
                                echo $this->fields->thumb;
                            } else {
                                echo $this->options->morenimg;
                            } ?>" class="card-img" alt="<?php $this->title() ?>">
                <div class="card-img-overlay">
                    <div class="card-overlay-text">
                        <h2 class="card-title"><?php $this->title() ?></h2>
                        <p class="card-text"> <?php $this->date(); ?></p>
                    </div>
                </div>

            </div>
            <div class="content-body">
                <?php echo RewriteContent($this->content); ?>
                <hr style="margin-left: -16px;margin-right: -16px;">
             
                <?php $this->need('comments.php'); ?>

            </div>
        </div>

<?php $this->need('footer.php'); ?>