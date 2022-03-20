<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<style>
    #cancel-comment-reply-link {
        display: inline !important;
    }

    .comment-reply-link a {
        color: rgb(0 0 0 / .5);
        text-decoration: none;
    }

    a {
        text-decoration: none;
    }
</style>
<div id="comments">
    <h3 class="mb-3">  <i class="fa fa-comment" aria-hidden="true"></i> 评论「<code><?php $this->commentsNum(_t('0'), _t('1'), _t('%d')); ?></code>」 </h3>

    <?php function threadedComments($comments, $options)
    {
        $commentClass = '';
        if ($comments->authorId) {
            if ($comments->authorId == $comments->ownerId) {
                $commentClass .= ' comment-by-author';
            } else {
                $commentClass .= ' comment-by-user';
            }
        }

        $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';

        if ($comments->url) {
            $author = '<a href="' . $comments->url . '" target="_blank" rel="external nofollow">' . $comments->author . '</a>';
        } else {
            $author = $comments->author;
        }
    ?>
    
    
        <div id="li-<?php $comments->theId(); ?>" class="comment-body<?php
                                                                        if ($comments->levels > 0) {
                                                                            echo ' comment-child';
                                                                            $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
                                                                        } else {
                                                                            echo ' comment-parent';
                                                                        }
                                                                        $comments->alt(' comment-odd', ' comment-even');
                                                                        echo $commentClass;
                                                                        ?>" style="
    position: relative;
">
            <div id="<?php $comments->theId(); ?>">

    <?php
    if (!$comments->levels > 0) {
                                                                           echo '<hr >';
                                                                        }
    ?>
                <div class="d-flex comments-reply">
                    <div class="flex-shrink-0">
                        <img class="rounded-circle" src="<?php Authorimg($comments->mail); ?>" alt="<?php echo $comments->author ?>" width="50px">
                    </div>

                    <div class="flex-grow-1 ms-3">
                        <div><?php echo $author; ?></div>
                        <small style="opacity: .7; font-size:13px"><?php echo timesince($comments->created);?>

</small>
                        <div id="comment-<?php $comments->theId(); ?>" class="mt-2">
                            <?php if ('waiting' == $comments->status) { ?><span class="text-muted">您的评论需管理员审核后才能显示！</span><?php } ?>
                            <?php
                            $comm = $comments->content;
                            $comme = preg_replace('/<\/script(.*?)>/s', ' script ', preg_replace('/<script>/s', 'script',  preg_replace('/<style(.*?)>/s', 'style',  preg_replace('/<\/style(.*?)>/s', 'style',  $comm))));
                            echo $comme;
                            ?>
                        </div>

                    </div>
                    
                        <div class="reply reply-btn">
                            <span class="comment-reply cp-<?php $comments->theId(); ?> comment-reply-link"><?php $comments->reply('<i class="fa fa-reply" aria-hidden="true"></i>'); ?></span>
                        </div>
                        <span id="cancel-comment-reply" class="reply-btn cancel-comment-reply cl-<?php $comments->theId(); ?>  comment-reply-link " style="display:none;position: absolute;
    right: 3px;"><?php $comments->cancelReply('<i class="fa fa-times" aria-hidden="true"></i>'); ?></span>
                    
                </div>
            </div>
            <?php if ($comments->children) { ?>

                <div class="comment-children ">

                    <?php $comments->threadedComments($options); ?>

                </div>

            <?php } ?>
        </div>

  

    <?php } ?>
    <?php if ($this->allow('comment')) { ?>
        <?php $this->comments()->to($comments); ?>
        <div class="mb-4" id="<?php $this->respondId(); ?>">
            <div id="respond-post-<?php $this->respondId(); ?>">
                <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
                    <?php if (!$this->user->hasLogin()) { ?>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group mb-3 ">
                                    <input class="form-control" type="author" name="author" id="author" placeholder="昵称*" value="<?php $this->remember('author'); ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3">
                                    <input class="form-control" type="email" name="mail" id="mail" placeholder="Email*" value="<?php $this->remember('mail'); ?>" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group mb-3 ">
                                    <input type="url" name="url" id="url" class="form-control" placeholder="网址(http://)" value="<?php $this->remember('url'); ?>" <?php if ($this->options->commentsRequireURL) : ?> required<?php endif; ?> />
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="input-group mb-3">
                        <textarea class="form-control" id="commenttextarea" style="min-height: 170px;" name="text" placeholder="写点啥呢" ></textarea>
                    </div>
                    <div class="alert alert-danger" role="alert" id="comments-error" style="display:none;">
                          评论出错
                        </div>
                                            <div class="row">
                                                <div class="col-12">
                                                   
               
                                                    <div style="    display: flex;
 
                                                        align-items: center;
                                                        justify-content: space-between;">
                                                                 <div>
                                                                        <?php if ($this->user->hasLogin()) { ?>

                           <strong> <?php $this->user->screenName(); ?> </strong>已经登录
                            <?php } ?>
                        </div>
                       
                        <div>
                           <div class="spinner-border text-primary" id="loading" style="display:none;" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                                <button type="submit" id="commentsumbit" class="btn btn-outline-primary ms-3"><?php _e('提交评论'); ?></button>
    
                                
                            </div>
                                         
                            </div>
                            
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <?php $this->comments()->to($comments); ?>
       <div id="commentcontent">
    <?php $comments->listComments(); ?>
    <?php if ($comments->have()){ ?>
    <hr>
              <?php $comments->pageNav('<', '>', 1, '...', array('wrapTag' => 'ul', 'wrapClass' => 'page-navigator', 'itemTag' => 'li', 'textTag' => 'span', 'currentClass' => 'current', 'prevClass' => 'prev', 'nextClass' => 'next',)); ?>
    <?php } ?>
</div>

    <?php } else { ?>
        <div class="text-center">
            <p>
                <i class="fa fa-times" aria-hidden="true"></i>评论已关闭

            </p>
        </div>
    <?php } ?>

</div>
<script type="text/javascript">
    function showhidediv(id) {
        var sbtitle = document.getElementById(id);
        if (sbtitle) {
            if (sbtitle.style.display == 'flex') {
                sbtitle.style.display = 'none';
            } else {
                sbtitle.style.display = 'flex';
            }
        }
    }
    (function() {
        window.TypechoComment = {
            dom: function(id) {
                return document.getElementById(id)
            },
            pom: function(id) {
                return document.getElementsByClassName(id)[0]
            },
            iom: function(id, dis) {
                var alist = document.getElementsByClassName(id);
                if (alist) {
                    for (var idx = 0; idx < alist.length; idx++) {
                        var mya = alist[idx];
                        mya.style.display = dis
                    }
                }
            },
            create: function(tag, attr) {
                var el = document.createElement(tag);
                for (var key in attr) {
                    el.setAttribute(key, attr[key])
                }
                return el
            },
            reply: function(cid, coid) {
                var comment = this.dom(cid),
                    parent = comment.parentNode,
                    response = this.dom("<?php echo $this->respondId(); ?>"),
                    input = this.dom("comment-parent"),
                    form = "form" == response.tagName ? response : response.getElementsByTagName("form")[0],
                    textarea = response.getElementsByTagName("textarea")[0];
                if (null == input) {
                    input = this.create("input", {
                        "type": "hidden",
                        "name": "parent",
                        "id": "comment-parent"
                    });
                    form.appendChild(input)
                }
                input.setAttribute("value", coid);
                if (null == this.dom("comment-form-place-holder")) {
                    var holder = this.create("div", {
                        "id": "comment-form-place-holder"
                    });
                    response.parentNode.insertBefore(holder, response)
                }
                comment.appendChild(response);
                this.iom("comment-reply", "");
                this.pom("cp-" + cid).style.display = "none";
                this.iom("cancel-comment-reply", "none");
                this.pom("cl-" + cid).style.display = "";
                if (null != textarea && "text" == textarea.name) {
                    textarea.focus()
                }
                return false
            },
            cancelReply: function() {
                var response = this.dom("<?php echo $this->respondId(); ?>"),
                    holder = this.dom("comment-form-place-holder"),
                    input = this.dom("comment-parent");
                if (null != input) {
                    input.parentNode.removeChild(input)
                }
                if (null == holder) {
                    return true
                }
                this.iom("comment-reply", "");
                this.iom("cancel-comment-reply", "none");
                holder.parentNode.insertBefore(response, holder);
                return false
            }
        }
    })();
    
</script>

