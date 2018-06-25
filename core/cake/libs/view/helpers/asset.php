<?php
/*
* Asset Packer CakePHP Component
* Copyright (c) 2008 Matt Curry
* www.PseudoCoder.com
* http://www.pseudocoder.com/archives/2007/08/08/automatic-asset-packer-cakephp-helper
*
* @author      mattc <matt@pseudocoder.com>
* @version     1.2
* @license     MIT
*
*/
class AssetHelper extends Helper
{
    //Cake debug = 0                          packed js/css returned.  $this->debug doesn't do anything.
    //Cake debug > 0, $this->debug = false    essentially turns the helper off.  js/css not packed.  Good for debugging your js/css files.
    //Cake debug > 0, $this->debug = true     packed js/css returned.  Good for debugging this helper.
    var $debug = false;
    //there is a *minimal* perfomance hit associated with looking up the filemtimes
    //if you clean out your cached dir (as set below) on builds then you don't need this.
    var $checkTS = true;
    //the packed files are named by stringing together all the individual file names
    //this can generate really long names, so by setting this option to true
    //the long name is md5'd, producing a resonable length file name.
    var $md5FileName = true;
    //you can change this if you want to store the files in a different location.
    //this is relative to your webroot/js and webroot/css paths
    var $cachePath = '';
    //set the css compression level
    //options: default, low_compression, high_compression, highest_compression
    //default is no compression
    //I like high_compression because it still leaves the file readable.
    var $cssCompression = 'high_compression';
    var $helpers = array(
        'Html',
        'Javascript'
    );
    var $viewScriptCount = 0;
    //flag so we know the view is done rendering and it's the layouts turn
    function afterRender($viewFile)
    {
        $this->viewScriptCount = count($this->_View->_scripts);
    }
    function scripts_for_layout()
    {
        //nothing to do
        if (!$this->_View->_scripts) {
            return;
        }
        //move the layout scripts to the front
        $this->_View->_scripts = array_merge(array_slice($this->_View->_scripts, $this->viewScriptCount) , array_slice($this->_View->_scripts, 0, $this->viewScriptCount));
        if (Configure::read('debug') && $this->debug == false) {
            return join("\n\t", $this->_View->_scripts);
        }
        //split the scripts into js and css
        foreach($this->_View->_scripts as $i => $script) {
            if (preg_match('/js\/(.*).js/', $script, $match)) {
                $temp = array();
                $temp['script'] = $match[1];
                $temp['name'] = basename($match[1]);
                $js[] = $temp;
                //remove the script since it will become part of the merged script
                unset($this->_View->_scripts[$i]);
            } else if (preg_match('/css\/(.*).css/', $script, $match)) {
                $temp = array();
                $temp['script'] = $match[1];
                $temp['name'] = basename($match[1]);
                $css[] = $temp;
                //remove the script since it will become part of the merged script
                unset($this->_View->_scripts[$i]);
            }
        }
        $scripts_for_layout = '';
        //first the css
        if (!empty($css)) {
            $scripts_for_layout.= $this->Html->css($this->process('css', $css));
            $scripts_for_layout.= "\n\t";
        }
        //then the js
        if (!empty($js)) {
            $scripts_for_layout.= $this->Javascript->link($this->process('js', $js));
        }
        //finally anything that was left over, usually codeBlocks
        $scripts_for_layout = join("\n\t", $this->_View->_scripts) . $scripts_for_layout;
        return $scripts_for_layout;
    }
    function process($type, $data)
    {
		switch ($type) {
            case 'js':
                $path = JS;
                break;

            case 'css':
                $path = CSS;
                break;
        }
        //check if the cached file exists
        $names = Set::extract($data, '{n}.name');
        $fileName = $this->__generateFileName($names) . '.' . $type;
        //file doesn't exist.  create it.
        if (!file_exists($path . DS . $fileName)) {
            $ts = time();
            //merge the script
            $scriptBuffer = '';
            $scripts = Set::extract($data, '{n}.script');
			switch ($type) {
				case 'js':
					App::import('Vendor', 'JSMin', true, array() , 'jsmin' . DS . 'jsmin.php');
					break;

				case 'css':
					App::import('Vendor', 'csstidy', true, array() , 'csstidy' . DS . 'class.csstidy.php');
					break;
			}
            foreach($scripts as $script) {
                $buffer = file_get_contents($path . $script . '.' . $type);
                switch ($type) {
                    case 'js':
						$buffer = trim(JSMin::minify($buffer));
                        break;

                    case 'css':
                        $tidy = new csstidy();
                        $tidy->settings['merge_selectors'] = false;
                        $tidy->load_template($this->cssCompression);
                        $tidy->parse($buffer);
                        $buffer = $tidy->print->plain();
                        break;
                }
                $scriptBuffer.= "\n/* $script.$type */\n" . $buffer;
            }
            //write the file
            $fileName = $this->__generateFileName($names) . '.' . $type;
			App::import('Core', 'File');
            $file = new File($path . $this->cachePath . $fileName);
            $file->write(trim($scriptBuffer));
        }
        if ($type == 'css') {
            //$html->css doesn't check if the file already has
            //the .css extension and adds it automatically, so we need to remove it.
            $fileName = str_replace('.css', '', $fileName);
        }
        return $fileName;
    }
    function __generateFileName($names)
    {
        $fileName = str_replace('.', '-', implode('_', $names));
        if ($this->md5FileName) {
            $fileName = md5($fileName);
        }
        return $fileName;
    }
}
?>