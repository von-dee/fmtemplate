<?php
use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

if(is_dir('public/')){
    require_once "scssphp/scss.inc.php";
    $scss = new Compiler();
    $scss->setImportPaths("media/scss/");
    $scss->setOutputStyle(OutputStyle::COMPRESSED);

    // will search for `scss/style.scss'
    $output = $scss->compile('@import "style.scss";');
    file_put_contents('media/css/style.css',$output);
}
?>
