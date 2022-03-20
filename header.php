<!DOCTYPE html>
<html lang="zh-cn">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.staticfile.org/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php Helper::options()->themeUrl(); ?>/css/style.css">
    <link rel="stylesheet" href="https://cdn.staticfile.org/nprogress/0.2.0/nprogress.min.css">

    <link href="https://cdn.staticfile.org/font-awesome/5.15.4/css/all.css" rel="stylesheet">
    <script src="https://cdn.staticfile.org/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.staticfile.org/nprogress/0.2.0/nprogress.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/jquery.pjax/2.0.1/jquery.pjax.min.js"></script>
    <title><?php $this->archiveTitle(array(
                'category'  =>  _t('分类 %s 下的文章'),
                'search'    =>  _t('包含关键字 %s 的文章'),
                'tag'       =>  _t('标签 %s 下的文章'),
                'author'    =>  _t('%s 发布的文章')
            ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php $this->header(); ?>
        <?php if ($this->options->faviconlogo) { ?>
        <link rel="shortcut icon" href="<?php echo $this->options->faviconlogo ?>" />
    <?php } ?>
    <style>
        body:before {
            background: url(<?php $this->options->siteimg() ?>) center/cover;
        }
      
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow  sticky-top yixin-nav">
        <div class="container">
            <a class="navbar-brand" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                    <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                    <?php while ($categorys->next()) : ?>
                        <?php $children = $categorys->getAllChildren($categorys->mid); ?>
                        <li class="nav-item">
                            <a class="nav-link " aria-current="page" href="<?php $categorys->permalink(); ?>"><?php $categorys->name(); ?></a>
                        </li>
                    <?php endwhile; ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            更多
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php $this->widget('Widget_Contents_Page_List')->to($pages) ?>
                            <?php while ($pages->next()) : ?>
                                <li><a class="dropdown-item" href="<?php $pages->permalink(); ?>"><?php $pages->title(); ?></a></li>
                            <?php endwhile; ?>
                        </ul>
                    </li>

                </ul>
                <form class="d-flex" id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
                    <input class="form-control" type="text" id="s" name="s" class="text" placeholder="回车进行搜索" style="min-width:260px;background-color: #0000;">
                </form>
            </div>
        </div>
    </nav>
    <div class="back-top" id="top">
        <button class="btn btn-primary  ms-3"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
    </div>
    <main class="container mt-3 pjax">