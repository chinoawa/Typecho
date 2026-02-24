<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<?php
if($this->options->cat_category_muban){
    $lunbo = $this->options->cat_category_muban;
    $slugArray = explode("||", $lunbo);
    $choose = '0';
    if(is_array($slugArray) && !empty($slugArray)){ 
        foreach($slugArray as $slug){
            if($this->is('category',$slug) && $choose == '0'){
                $choose = '1';
            }
        }
    }
}else{
    $choose = '0';
}
    if($choose == '1'){
        $this->need('archive_timeline.php');
    }elseif($choose == '0'){
        $this->need('archive_default.php');
    }
?>