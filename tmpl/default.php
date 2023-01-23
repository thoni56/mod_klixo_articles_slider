<?php
/* ------------------------------------------------------------------------
 *  mod_klixo_articles_slider  - Version 1.3.6
 * 20140227
 * ------------------------------------------------------------------------
 * Copyright (C) 2011-2014 Klixo. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Author: JF Thier Klixo
 * Website: http://www.Klixo.se
 * ------------------------------------------------------------------------- */

namespace KlixoArticlesSlider;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;

$contentWrapHeight = ($button_style != "hide") ? $slideShow_height - 21 : $slideShow_height;
$textBoxHeight = ($show_readmore) ? $contentWrapHeight - $ReadMore_font_size - 25 : $contentWrapHeight - 20;
$klixoSliderMod = 'div#klixoSlider_' . $module->id;
$navBarWidth = 'auto';


$moduleStyle = $klixoSliderMod . '{
        visibility:hidden; 
    }'
        .
        $klixoSliderMod . ' div.navBar
    {
        right: 5px;
        width:' . ($slideShow_width - 10) . 'px;
    }' .
        $klixoSliderMod . ' div.navBar ul 
    { 
        width:' . $navBarWidth . ';
        }'
        .
        $klixoSliderMod . ' div.navBar ul li.button_img
    { 
        color:' . $navBarTxtColor . ';
        }'
        .
        $klixoSliderMod . ' div.navBar ul li.button_img_selected
    { 
        color:' . $navBarTxtSelectColor . ';
        }'
        .
        $klixoSliderMod . ' div.slide_show_header h3 , ' . $klixoSliderMod . ' .slide_show_header h3 a , ' . $klixoSliderMod . ' .slide_show_header  a:visited{ 
        color:' . $title_color . '!important;
        font-size:' . $title_font_size . 'px !important; 
        height:' . ($title_font_size + 5) . 'px !important; 
    }'
        .
        $klixoSliderMod . ' div.readmore a{ 
        color:' . $read_more_color . ';
        font-size:' . $ReadMore_font_size . 'px; 
        height:' . ($ReadMore_font_size + 5) . 'px; 
    }'
        .
        $klixoSliderMod . ', div#moduleSlideShow' . $module->id . ' {
        background-color:' . $slideShow_background . '; 
        width:' . $slideShow_width . 'px; 
        height:' . $slideShow_height . 'px;
    }'
        .
        $klixoSliderMod . ' div.textContent {
        color:' . $description_color . ';  
        font-size:' . $content_font_size . 'px; 
        height:' . $textBoxHeight . 'px; 
    }'
        .
        $klixoSliderMod . ' div.contentBoxWrapper {
        height:' . $contentWrapHeight . 'px; 
        width:' . $slideShow_width . 'px;
        background-color:' . $slideShow_background . ';       
    }';

$document = Factory::getDocument();
$document->addStyleDeclaration($moduleStyle);

if (count($items) > 0):
    ?>
    <script type="text/javascript">
        if (typeof (jQuery) === 'undefined') {
            jQuery = jQuery.noConflict();
        }
        (function($) {
            var KSlideShow;
            $(window).load(function() {
                KSlideShow = new $.KSlider({
                    fx: '<?php echo $transitionList; ?>',
                    randomizeEffects: '<?php echo $randomizeEffects; ?>',
                    timeout: <?php echo $timer_speed; ?>,
                    speed: <?php echo $slideshow_speed; ?>,
                    next: '#next<?php echo $module->id; ?>',
                    prev: '#prev<?php echo $module->id; ?>',
                    pause: <?php echo ($pause) ? 1 : 0; ?>,
                    divId: <?php echo $module->id; ?>,
                    autoPlay: <?php echo $auto_play; ?>,
                    startingSlide: 0,
                    moduleID: '<?php echo $module->id; ?>',
                    showReadmore: <?php echo $show_readmore ?>,
                    slidesautoHeight: <?php echo $css_Scaling ?>
                });
                KSlideShow.sliderStart();

    <?php if ($css_Scaling == 1) { ?>
                    KSlideShow.resize();
    <?php }
    ?>
            });

        })(jQuery);
    </script>

    <div class="article_slider <?php echo $moduleclass_sfx; ?>" id="klixoSlider_<?php echo $module->id; ?>">
        <div id="moduleSlideShow<?php echo $module->id; ?>">
            <?php
            $index = 0;
            foreach ($items as $key => $item) {
                $index++;
                $clickEvent = "javascript: return true";
                ?>
                <div id="slide_<?php echo $index ?>">
                    <div class ="contentBoxWrapper">
                        <div class="content-box">
                            <div class="textContent current_content_<?php echo $module->id; ?>">
                                <?php if ($show_title) { ?>  
                                    <div class="slide_show_header caption_<?php echo $module->id; ?>">
                                        <?php if ($link_title) { ?>
                                            <h3><a href="<?php echo $item->link ?>" target="<?php echo $target; ?>" onclick="<?php echo $clickEvent ?>"><?php echo $item->sub_title ?></a> </h3>      
                                            <?php
                                        } else {
                                            echo '<h3>' . $item->sub_title . '</h3>';
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                echo $item->sub_content;
                                ?>
                            </div>
                        </div>	
                        <?php if ($show_readmore) : ?>  
                            <div class="readmore read_more_content_<?php echo $module->id; ?>"><a href="<?php echo $item->link ?>" target="<?php echo $target; ?>" onclick="<?php echo $clickEvent ?>"><?php echo JText::_('MORE_INFO') ?></a></div>
                        <?php endif ?>
                    </div>
                </div>
            <?php } ?> 
        </div>		

        <?php if ($prenext_show === '1') : ?>
            <a id="prev<?php echo $module->id; ?>" class="previous">&nbsp;&nbsp;&nbsp;&nbsp;</a>
            <a id="next<?php echo $module->id; ?>" class="next">&nbsp;&nbsp;&nbsp;&nbsp;</a>
        <?php endif ?>	
        <?php if ($button_style != "hide") : ?>   
            <div class="navBar" id="cover_buttons_<?php echo $module->id; ?>">	
                <div class="center_nav" style="background-color:<?php echo $navBarColor ?>;">			
                    <ul id="image_button_<?php echo $module->id; ?>" <?php echo ($button_style == 'dots') ? 'class="dots"' : 'class="numbers"' ?>>

                        <?php foreach ($items as $key => $item) { ?>

                            <?php $start =0;
                            if ($button_style == 'number') { ?>

                                <li class="<?php echo ($key == $start) ? "button_img_selected" : "button_img"; ?>" value="<?php echo $key; ?>"><?php echo ($key + 1); ?></li>

                            <?php } else { ?>

                                <li class="<?php echo ($key == $start) ? "button_img_selected" : "button_img"; ?>" value="<?php echo $key; ?>"></li>

                            <?php } ?>

                        <?php } ?> 
                    </ul>
                </div>
            </div>	
        <?php endif ?>	
    </div>

<?php else: ?><div class ="contentError"> <?php echo JText::_('NO_CONTENT') ?></div> 

<?php endif; ?>