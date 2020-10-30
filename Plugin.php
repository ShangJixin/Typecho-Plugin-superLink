<?php
/**
 * <i>JixinParser->superLink();</i><br>无需再记忆短代码，只要输入符合解析规则的链接，就可解析为对应的卡片😎 <a href="https://github.com/ShangJixin/Typecho-Plugin-superLink">去 Github 仓库查看 superLink 支持了哪些解析&nbsp;&rsaquo;</a>
 * 
 * @package superLink
 * @author ShangJixin
 * @version 1.0
 * @link https://github.com/ShangJixin/Typecho-Plugin-superLink
 */
class superLink_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx= array("superLink_Plugin", 'render');
        Typecho_Plugin::factory('Widget_Archive')->header = array(__CLASS__, 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array(__CLASS__, 'footer');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form){
        
        $needjq = new Typecho_Widget_Helper_Form_Element_Checkbox('needjq', array('yes' => _t('引用')), array('yes'), _t('是否加载jquery.min.js'));
        $form->addInput($needjq);
        
        echo '<h2>插件使用说明</h2><p>是否加载 jQuery：为了防止重复引用 jQuery，给站点带来不必要的加载开销，所以设置此功能。如果你已经在主题内或者是其他插件已经加载过 jQuery，那就无需再次加载。</p><p><strong>注：jQuery 引入依赖于 jsdelivr CDN</strong></p>';

    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
    
    /**
     * 插件实现方法
     * 
     * @access public
     * @return void
     */
    public static function render($text, Widget_Abstract_Contents $archive){
        //$text = "Plugin";
        //JixinParser
        require_once('JixinParser.php');
        $JixinParser = new JixinParser;
        $text = $JixinParser->superLink($text);
        
        return $text;
    }
    
        /**
     * 为header添加css文件
     * 
     * @return void
     */
    public static function header() {
        echo '<link rel="stylesheet" href="'.Helper::options()->pluginUrl .'/superLink/superlink.css" />';
    }

    /**
     * 为footer添加js文件
     * 
     * @return void
     */
    public static function footer() {
        
       if(Helper::options()->plugin('superLink')->needjq){
            echo '<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>';
        }
        echo '<script src="'.Helper::options()->pluginUrl .'/superLink/superlink.js"></script>';
    }

}
