<?php
/* ------------------------------------------------------------------------
 *  mod_klixo_articles_slider  - Version 1.3.5
 * 20140206
 * ------------------------------------------------------------------------
 * Copyright (C) 2011-2014 Klixo. All Rights Reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * Author: JF Thier Klixo
 * Website: http://www.Klixo.se
 * ------------------------------------------------------------------------- */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldcustomSpacer extends JFormField {

    protected $type = 'customspacer';


    protected function getLabel() {
        return '<div style="padding:7px 0; clear:both;"> <span style=" display:block; padding:5px;  font-family: arial; font-size: 12pt; color: ' . $this->element['TextColor'] . '; background: none repeat scroll 0% 0% ' . $this->element['BgdColor'] . ' ;">' . JText::_($this->value) . '</span></div>';
       
    }

    protected function getInput() {
        return '';
    }

    protected function getTitle() {
        return $this->getLabel();
    }
}