<?php

use Typecho\Exception;
use Typecho\Plugin\PluginInterface;
use Typecho\Widget\Helper\Form;
use Typecho\Widget\Helper\Form\Element\Text;
use Typecho\Common;
use Widget\Options;

if (!defined('__TYPECHO_ROOT_DIR__')) {
    exit;
}

/**
 * MyDiary 主题配套插件，仅支持Typecho 1.2。
 *
 * @package MyDiaryX
 * @author 即刻学术 / 火喵酱
 * @version 1.0.6
 * @link https://cat.dorcandy.cn
 */
class MyDiaryX_Plugin implements PluginInterface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     */
    const replace_root_dir = __TYPECHO_ROOT_DIR__.__TYPECHO_PLUGIN_DIR__.'/MyDiaryX/replace_files/';
    public static function activate()
    {
		Typecho_Plugin::factory('Widget_Abstract_Contents')->filter = array('MyDiaryX_Plugin', 'passwordpost');
        if (version_compare( phpversion(), '7.0.0', '<' ) ) {
            throw new Exception('请升级到 php 7 以上');
        }
		
		$_db = Typecho_Db::get();
        $_prefix = $_db->getPrefix();
        $adapter = $_db->getAdapterName();
        if ("Pdo_Mysql" === $adapter || "Mysql" === $adapter) {
            $_db->query("CREATE TABLE IF NOT EXISTS " . $_prefix . "dianzan (
                    `id` int(10) unsigned NOT NULL auto_increment,
                    `name` varchar(32) default NULL,
                    `mail` varchar(150) default NULL,
                    `parent` int(10) unsigned default '0',
                    `agree` int(10) unsigned default '0',
                    PRIMARY KEY  (`id`)
                ) DEFAULT CHARSET=utf8mb4; AUTO_INCREMENT=1");
            try {
                if (!array_key_exists('views', $_db->fetchRow($_db->select()->from('table.contents')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'contents` ADD `views` INT DEFAULT 0;');
                }
                if (!array_key_exists('weather', $_db->fetchRow($_db->select()->from('table.comments')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'comments` ADD `weather` varchar(150) DEFAULT NULL;');
                }
                if (!array_key_exists('mood', $_db->fetchRow($_db->select()->from('table.comments')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'comments` ADD `mood` varchar(150) DEFAULT NULL;');
                }
                if (!array_key_exists('temperature', $_db->fetchRow($_db->select()->from('table.comments')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'comments` ADD `temperature` INT DEFAULT 0;');
                }
                if (!array_key_exists('image', $_db->fetchRow($_db->select()->from('table.comments')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'comments` ADD `image` varchar(150) DEFAULT NULL;');
                }
                if (!array_key_exists('place', $_db->fetchRow($_db->select()->from('table.comments')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'comments` ADD `place` varchar(150) DEFAULT NULL;');
                }
                if (!array_key_exists('secert', $_db->fetchRow($_db->select()->from('table.comments')->page(1, 1)))) {
                    $_db->query('ALTER TABLE `' . $_prefix . 'comments` ADD `secert` INT DEFAULT 0;');
                }
            } catch (Exception $e) {
            }
        }
		
		
        // 匹配 v1.2.0
        if (version_compare(Common::VERSION, '1.2.0') == 0){
            // 先对源文件做备份，再覆盖写入
            copy(__TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php", __TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php.bak");
            copy(self::replace_root_dir.'ty1.2.0/Feedback.php', __TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php");

            copy(__TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php", __TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php.bak");
            copy(self::replace_root_dir.'ty1.2.0/Comments.php', __TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php");
			
            copy(__TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php", __TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php.bak");
            copy(self::replace_root_dir.'ty1.2.0/Edit.php', __TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php");
			
            copy(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php", __TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php.bak");
            copy(self::replace_root_dir.'ty1.2.0/Textarea.php', __TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php");
			
            copy(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php", __TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php.bak");
            copy(self::replace_root_dir.'ty1.2.0/Textarea.php', __TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php");
        }
		// 匹配 v1.2.1
        if (version_compare(Common::VERSION, '1.2.1') == 0){
            // 先对源文件做备份，再覆盖写入
            copy(__TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php", __TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php.bak");
            copy(self::replace_root_dir.'ty1.2.1/Feedback.php', __TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php");

            copy(__TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php", __TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php.bak");
            copy(self::replace_root_dir.'ty1.2.1/Comments.php', __TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php");
			
            copy(__TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php", __TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php.bak");
            copy(self::replace_root_dir.'ty1.2.1/Edit.php', __TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php");
        }
		
		
		
		
		
    }
	
	
	

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     */
    public static function deactivate()
    {
        //还原备份
        if (file_exists(__TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php.bak")) {
            unlink(__TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php");
            rename(__TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php.bak", __TYPECHO_ROOT_DIR__."/var/Widget/Feedback.php");
        }

        if (file_exists(__TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php.bak")) {
            unlink(__TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php");
            rename(__TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php.bak", __TYPECHO_ROOT_DIR__."/var/Widget/Base/Comments.php");
        }
		
        if (file_exists(__TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php.bak")) {
            unlink(__TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php");
            rename(__TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php.bak", __TYPECHO_ROOT_DIR__."/var/Widget/Metas/Category/Edit.php");
        }
		
        if (file_exists(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php.bak")) {
            unlink(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php");
            rename(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php.bak", __TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Helper/Form/Element/Textarea.php");
        }
		
        if (file_exists(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php.bak")) {
            unlink(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php");
            rename(__TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php.bak", __TYPECHO_ROOT_DIR__."/var/Typecho/Widget/Archive.php");
        }
    }

    /**
     * 获取插件配置面板
     *
     * @param Form $form 配置面板
     */
    public static function config(Form $form)
    {
    }

    /**
     * 个人用户的配置面板
     *
     * @param Form $form
     */
    public static function personalConfig(Form $form)
    {
    }
    
    /**
     * 加密文章解决403问题
     *
     * @param Form $form
     */
    public static function passwordpost($new, $obj) {
        $new['fuck403'] = false;
        if ($new['hidden']){
        $new['text'] = '
        !!!
        <form class="protected" action="' . Typecho_Widget::widget('Widget_Security')->getTokenUrl($new['permalink']). '" method="post">'.'<p class="word" style="text-align: center;font-size: 2rem;line-height: 2.5rem;z-index: 1;color: var(--main);position: relative;padding: 2rem 0;text-shadow: var(--text-shadow);">请输入密码访问</p>'.'<p style="text-align: center;margin: 0 0 1rem;"><input style="padding: 0.25rem 1rem;line-height: 1.5rem;margin: 0.5rem;border: 1px dashed var(--main);" type="password" class="text" name="protectPassword" /><input style="padding: 0.25rem 1rem;line-height: 1.5rem;margin: 0.5rem;border: 1px dashed var(--main);" type="hidden" name="protectCID" value="' . $new['cid'] . '" />&nbsp;<input style="padding: 0.25rem 1rem;line-height: 1.5rem;margin: 0.5rem;border: 1px dashed var(--main);" type="submit" class="submit" value="' . _t('提交') . '" /></p>'.'</form>
        !!!
        ';
        $new['hidden'] = false;
        $new['fuck403'] = true;
        }
        return $new; 
    }
}
