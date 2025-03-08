<?php
/**
 * 新建文章以日期作为Slug
 * 
 * @package Auot Slug
 * @author Z
 * @version 1.0
 * @link http://blog.learm.cn/
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class AutoSlug_Plugin implements Typecho_Plugin_Interface {
    /**
     * 插件激活
     */
    public static function activate() {
        Typecho_Plugin::factory('admin/write-post.php')->bottom = array('AutoSlug_Plugin', 'addSlugScript');
        Typecho_Plugin::factory('admin/write-page.php')->bottom = array('AutoSlug_Plugin', 'addSlugScript');
    }

    /**
     * 插件禁用
     */
    public static function deactivate() {}

    /**
     * 插件配置界面（此插件无需配置）
     */
    public static function config(Typecho_Widget_Helper_Form $form) {}

    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}

    /**
     * 在文章编辑页面插入 JavaScript，自动填充 slug
     */
    public static function addSlugScript() {
        echo <<<EOT
<script>
document.addEventListener("DOMContentLoaded", function() {
    var slugInput = document.getElementById("slug");
    if (slugInput && slugInput.value.trim() === "") {
        var today = new Date();
        var year = today.getFullYear();
        var month = String(today.getMonth() + 1).padStart(2, '0'); 
        var day = String(today.getDate()).padStart(2, '0');
        slugInput.value = year + "-" + month + "-" + day;
    }
});
</script>
EOT;
    }
}
?>
