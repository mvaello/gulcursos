<?php 
include('vendors'.DS.'phpcaptcha'.DS.'php-captcha.inc.php');

class CaptchaComponent extends Object
{
    var $controller;
 
    function startup( &$controller ) {
        $this->controller = &$controller;
    }

    function image(){
        
        $imagesPath = '..'.DS.'vendors'.DS.'phpcaptcha'.DS.'/fonts/';
        
        $aFonts = array(
            $imagesPath.'VeraBd.ttf',
            $imagesPath.'VeraIt.ttf',
            $imagesPath.'Vera.ttf'
        );
        
        $oVisualCaptcha = new PhpCaptcha($aFonts, 200, 60);
        $oVisualCaptcha->UseColour(true);
        //$oVisualCaptcha->SetOwnerText('Source: '.FULL_BASE_URL);
        $oVisualCaptcha->SetNumChars(5);
        $oVisualCaptcha->Create();
    }
    
    function check($userCode, $caseInsensitive = true){
        if ($caseInsensitive) {
            $userCode = strtoupper($userCode);
        }
        
        if (!empty($_SESSION['php_captcha']) && $userCode == $_SESSION['php_captcha']) {
            // clear to prevent re-use
            unset($_SESSION['php_captcha']);
            
            return true;
        }
        else return false;
    }
}
?>
