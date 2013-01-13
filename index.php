<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */



# функция автоподключения плагина
function donatello_autoload()
{
	mso_hook_add( 'admin_init', 'donatello_admin_init');
	mso_hook_add( 'admin_head', 'donatello_admin_hear');
    mso_hook_add( 'content_out', 'donatello_content');
}

# функция выполняется при активации (вкл) плагина
function donatello_activate($args = array())
{	
	return $args;
}

# функция выполняется при деинсталяции плагина
function donatello_uninstall($args = array())
{	
	mso_delete_option('plugin_donatello', 'plugins' ); // удалим созданные опции
	return $args;
}

# функция выполняется при указаном хуке admin_init
function donatello_admin_init($args = array()) 
{

    mso_admin_menu_add('donatello', '', t('Донателло', 'admin'), 3);

    mso_hook_add('admin_head', 'donatello_admin_head');

    // добавить фотку
    $this_plugin_url = 'upload';
    mso_admin_menu_add( 'donatello', $this_plugin_url, t('Загрузить', 'admin'), 1);
    mso_admin_url_hook ('upload', 'donatello_admin_upload');


    // показать все фотографии
    $this_plugin_url = 'view';
    mso_admin_menu_add( 'donatello', $this_plugin_url, t('Просмотреть', 'admin'), 1);
    mso_admin_url_hook ('view', 'donatello_admin_view_all');
    
    // Просмотр по тегу 
    $this_plugin_url = 'tag';
    mso_admin_url_hook ('tag', 'donatello_admin_view_tag');
    
    // Просмотр по категории 
    $this_plugin_url = 'category';
    mso_admin_url_hook ('category', 'donatello_admin_view_category');
	
	return $args;
}

function donatello_admin_head($args = array()) 
{
        $url = getinfo('plugins_url') . 'donatello/';
        if (mso_segment(2) == 'upload') {
        $upload_url = getinfo('require-maxsite') . base64_encode('plugins/donatello/upload-ajax.php');
        echo <<<EOF
            <style type="text/css">@import url(${url}static/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css);</style>

            <script type="text/javascript" src="${url}static/plupload/js/plupload.full.js"></script>
            <script type="text/javascript" src="${url}static/plupload/js/jquery.plupload.queue/jquery.plupload.queue.js"></script>
            <script type="text/javascript" src="${url}static/plupload/js/i18n/ru.js"></script>

            <script type="text/javascript">
                $(function() {
                    $("#donatello-upload").pluploadQueue({
                        runtimes : 'html5',

                        url : '${upload_url}',
                        max_file_size : '10mb',

                        filters : [
                            {title : "Image files", extensions : "jpg,jpeg,png,JPG,JPEG,PNG"},
                        ]
                    });
                });
            </script>
EOF;
        }
        return $args;
}

# функция вызываемая при хуке, указанном в mso_admin_url_hook
function donatello_admin_view($args = array()) 
{
	
	mso_hook_add_dinamic( 'mso_admin_header', ' return $args . "' . t('Donatello') . '"; ' );
	mso_hook_add_dinamic( 'admin_title', ' return "' . t('Donatello') . ' - просмотр" . $args; ' );
	
	require(getinfo('plugins_dir') . 'donatello/admin-view.php');
}

function donatello_admin_view_tag($args = array()) 
{
	
	mso_hook_add_dinamic( 'mso_admin_header', ' return $args . "' . t('Donatello') . '"; ' );
	mso_hook_add_dinamic( 'admin_title', ' return "' . t('Donatello') . ' - теги" . $args; ' );
	
	require(getinfo('plugins_dir') . 'donatello/admin-view-tag.php');
}

function donatello_admin_view_category($args = array()) 
{
	
	mso_hook_add_dinamic( 'mso_admin_header', ' return $args . "' . t('Donatello') . '"; ' );
	mso_hook_add_dinamic( 'admin_title', ' return "' . t('Donatello') . ' - категории" . $args; ' );
	
	require(getinfo('plugins_dir') . 'donatello/admin-view-category.php');
}

function donatello_admin_view_galleries($args = array()) 
{
	
	mso_hook_add_dinamic( 'mso_admin_header', ' return $args . "' . t('Donatello') . '"; ' );
	mso_hook_add_dinamic( 'admin_title', ' return "' . t('Donatello') . ' - галереи" . $args; ' );
	
	require(getinfo('plugins_dir') . 'donatello/admin-view-galleries.php');
}

function donatello_admin_upload($args = array()) 
{
	
	mso_hook_add_dinamic( 'mso_admin_header', ' return $args . "' . t('Donatello') . '"; ' );
	mso_hook_add_dinamic( 'admin_title', ' return "' . t('Donatello') . ' - " . $args; ' );
	
	require(getinfo('plugins_dir') . 'donatello/admin-upload.php');
}

function dontatello_view_gallery($id) {
}

function donatello_content_callback($matches)
{
        if (isset($matches[1])) return donatello_view_gallery($matches[1]);
        else return '';
}

function donatello_content($content = '')
{
        $content = preg_replace_callback('!\[donatello=(.*?)\]!is', 'donatello_content_callback', $content);

        return $content;
}

function donatello_gallery_view ($gallery)
{

}


# end file
