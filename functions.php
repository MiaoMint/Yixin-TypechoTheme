<?php
function themeInit($archive){
    Helper::options()->commentsAntiSpam=false; //关闭评论反垃圾
    Helper::options()->commentsCheckReferer=false; //关闭检查评论来源页URL是否与文章链接一致
}
function themeFields($layout)
{
?>

<?php
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('缩略图'), _t(''));
    $layout->addItem($thumb);

}



//获取头像
function Authorimg($email)
{
    $a = 'gravatar.loli.net/avatar/'; //gravatar头像源
    $b = str_replace('@qq.com', '', $email);
    if (stristr($email, '@qq.com') && is_numeric($b) && strlen($b) < 11 && strlen($b) > 4) {
        // $nk = 'https://s.p.qq.com/pub/get_face?img_type=3&uin='.$b;
        // $c = get_headers($nk, true);
        // $d = $c['Location'];
        $q = json_encode($d);
        // $k = explode("&k=",$q)[1];
        echo 'https://q1.qlogo.cn/g?b=qq&nk=' . $b . '&s=100';
    } else {
        $email = md5($email);
        echo 'https://' . $a . '/' . $email . '?&d=mystery';
    }
}


function themeConfig($form)
{

    //主设置

    $faviconlogo = new Typecho_Widget_Helper_Form_Element_Text('faviconlogo', NULL, NULL, _t('站点 favicon 地址'), _t('这个就是显示在浏览器标签页上的图片，在这里填入一个图片 URL 地址,最好填写的是.ico结尾的图片小一点'));
    $faviconlogo->setAttribute('class', 'col-mb-12 typecho-option home');
    $form->addInput($faviconlogo);


    $morenimg = new Typecho_Widget_Helper_Form_Element_Text('morenimg', NULL, NULL, _t('未定义缩略图时默认显示的图片'), _t('就是你的文章里没有图片就显示一个默认的图片。比如填写https://s2.ax1x.com/2020/03/03/3hJvx1.jpg'));
    $morenimg->setAttribute('class', 'col-mb-12 typecho-option setc');
    $form->addInput($morenimg);

  
    $siteimg = new Typecho_Widget_Helper_Form_Element_Text('siteimg', NULL, 'https://api.paugram.com/wallpaper?source=gh', _t('站点背景'), _t(''));
    $siteimg->setAttribute('class', 'col-mb-12 typecho-option setc');
    $form->addInput($siteimg);
    
        $aboutimg = new Typecho_Widget_Helper_Form_Element_Text('aboutimg', NULL, NULL, _t('关于页面|头像链接'), _t(''));
    $aboutimg->setAttribute('class', 'col-mb-12 typecho-option home');
    $form->addInput($aboutimg);
    
    $aboutname = new Typecho_Widget_Helper_Form_Element_Text('aboutname', NULL, NULL, _t('关于页面|名称'), _t(''));
    $aboutname->setAttribute('class', 'col-mb-12 typecho-option home');
    $form->addInput($aboutname);
    
    $aboutdesc = new Typecho_Widget_Helper_Form_Element_Text('aboutdesc', NULL, NULL, _t('关于页面|介绍'), _t(''));
    $aboutdesc->setAttribute('class', 'col-mb-12 typecho-option home');
    $form->addInput($aboutdesc);
    
}

function timesince($older_date,$comment_date = false) {
$chunks = array(
array(86400 , '天'),
array(3600 , '小时'),
array(60 , '分'),
array(1 , '秒'),
);
$newer_date = time();
$since = abs($newer_date - $older_date);
if($since < 2592000){
for ($i = 0, $j = count($chunks); $i < $j; $i++){
$seconds = $chunks[$i][0];
$name = $chunks[$i][1];
if (($count = floor($since / $seconds)) != 0) break;
}
$output = $count.$name.' 前';
}else{
$output = !$comment_date ? (date('Y-m-j G:i', $older_date)) : (date('Y-m-j', $older_date));
}
return $output;
}

function Table($content)
{
    return preg_replace('/<\/table>/s', '</table>', preg_replace('/<table>/s', '<table class="table">', $content));
}

function RewriteContent($content)
{

    return Table($content);
}

