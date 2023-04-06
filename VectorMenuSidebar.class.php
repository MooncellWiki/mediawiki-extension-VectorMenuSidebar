<?php
class VectorMenuSidebar {
    
    public static function BeforePageDisplay( $out, $skin ) {
        global $wgEnableVMSCustomStyle, $wgOut, $wgVectorMenuSidebar, $wgShowAfterMenuSidebar;//defined in LocalSettings.php
        
        if ( $wgOut->getSkin()->getSkinName() === "vector" ) {
            if ( $wgEnableVMSCustomStyle === true ){
                $style = wfMessage( 'MenuSidebar.css' )->plain();
                $out->addHeadItems( '<style type="text/css">'.$style.'</style>' );
            } else {
                $out->addHeadItems( '<link rel="stylesheet" type="text/css" href="/extensions/VectorMenuSidebar/resources/baseStyle.css">' );
            }
            
            if ( $wgVectorMenuSidebar === true ) {
                $out->addHTML( '<div id="MenuSidebar" style="display:none">'. wfMessage('MenuSidebar')->parse() . '<p id="vmsTB">' . wfMessage('toolbox')->plain() . '</p><ul id="MSToolbox"></ul>' );
                if ( $wgShowAfterMenuSidebar === true ) {
                        $out->addHTML( '<div>' . wfMessage('MenuSidebarAfter')->parse() . '</div>' );
                }
                $out->addHTML( '</div>' );
            }
        }
        
        return true;
    }
}
