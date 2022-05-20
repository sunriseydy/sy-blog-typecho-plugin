<?php

require_once 'Request.php';

/**
 * sy blog typecho plugin
 * 
 * @package SyBlogTypecho 
 * @author SunriseYDY
 * @version 1.0.0
 * @link https://github.com/sunriseydy/sy-blog-typecho-plugin
 */
class SyBlogTypechoPlugin_Plugin implements Typecho_Plugin_Interface {
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
    	Typecho_Plugin::factory('Widget_Contents_Post_Edit')->finishPublish = array('SyBlogTypechoPlugin_Plugin', 'finishPublishPost');
    	Typecho_Plugin::factory('Widget_Contents_Post_Edit')->finishDelete = array('SyBlogTypechoPlugin_Plugin', 'finishDeletePost');
    	Typecho_Plugin::factory('Widget_Contents_Page_Edit')->finishPublish = array('SyBlogTypechoPlugin_Plugin', 'finishPublishPage');
    	Typecho_Plugin::factory('Widget_Contents_Page_Edit')->finishDelete = array('SyBlogTypechoPlugin_Plugin', 'finishDeletePage');

        return _t('请先设置插件');
    }

    /**
     * 发布文章通知
     *
     * @access public
     * @param $content $edit
     */
    public static function finishPublishPost($content, $edit)
    {
        // 逻辑代码
        $result = Request::updatePost($edit->cid);
        $file = fopen("/tmp/php.log", "w");
        $file.fwrite($file, $result);
        fclose($file);
    }

    /**
     * 删除文章通知
     *
     * @access public
     * @param $content $edit
     */
    public static function finishDeletePost($content,$edit)
    {
        // 逻辑代码
        $result = Request::deletePost($content);
        $file = fopen("/tmp/php.log", "w");
        $file.fwrite($file, $result);
        fclose($file);
    }

    /**
     * 发布页面通知
     *
     * @access public
     * @param $content $edit
     */
    public static function finishPublishPage($content, $edit)
    {
        // 逻辑代码
        $result = Request::updatePage($edit->cid);
        $file = fopen("/tmp/php.log", "w");
        $file.fwrite($file, $result);
        fclose($file);
    }

    /**
     * 删除页面通知
     *
     * @access public
     * @param $content $edit
     */
    public static function finishDeletePage($content,$edit)
    {
        // 逻辑代码
        $result = Request::deletePage($content);
        $file = fopen("/tmp/php.log", "w");
        $file.fwrite($file, $result);
        fclose($file);
    }

    /* 禁用插件方法 */
    public static function deactivate(){}
    
    /* 插件配置方法 */
    public static function config(Typecho_Widget_Helper_Form $form){
        $apiHost = new Typecho_Widget_Helper_Form_Element_Text('apiHost',NULL,NULL,_t('回调地址'),_t('例如"https://blog-api.sunriseydy.dev"'));
        $form->addInput($apiHost);

        $username = new Typecho_Widget_Helper_Form_Element_Text('username',NULL,NULL,_t('用户名'),_t('sy-blog-java 中配置的用户名'));
        $form->addInput($username);

        $password = new Typecho_Widget_Helper_Form_Element_Text('password',NULL,NULL,_t('密码'),_t('sy-blog-java 中配置的密码'));
        $form->addInput($password);
    }
    
    /* 个人用户的配置方法 */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /* 插件实现方法 */
    public static function render(){}
}
?>