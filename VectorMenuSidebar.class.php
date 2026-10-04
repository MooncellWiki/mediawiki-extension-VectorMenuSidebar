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
                $out->addHTML( '<div id="MenuSidebar" style="display:none">'. self::menuMessage( 'MenuSidebar', $skin->getSkinName() )->parse() . '<p id="vmsTB">' . wfMessage('toolbox')->plain() . '</p><ul id="MSToolbox"></ul>' );
                if ( $wgShowAfterMenuSidebar === true ) {
                        $out->addHTML( '<div>' . wfMessage('MenuSidebarAfter')->parse() . '</div>' );
                }
                $out->addHTML( '</div>' );
	    	$out->addHTML( '<script>window.addEventListener("DOMContentLoaded",(function(){document.querySelector("#MSToolbox").innerHTML=document.querySelector("#p-tb ul").innerHTML,document.querySelectorAll("#mw-panel > *:not(#p-logo)").forEach((function(e){return e.remove()}));for(var e=document.querySelectorAll("#MenuSidebar li>ul"),n=0;n<e.length;n++)e[n].parentElement.classList.add("child");e=document.querySelectorAll("#MenuSidebar > ul#MSToolbox > li");for(var o=0;o<e.length;o++)""===e[o].innerHTML&&e[o].parentNode.removeChild(e[o]);var r=document.querySelector("#MenuSidebar");r.setAttribute("style",""),document.querySelector("#mw-panel").appendChild(r)}));</script>' );
	    }
        }
        
        return true;
    }

    /**
     * MediaWiki:<name>-<skin> when that page exists, MediaWiki:<name> otherwise.
     *
     * MediaWiki:MenuSidebar may be shared with another skin that renders it itself
     * (Skin:Arknights does). The per-skin page lets this skin's copy differ without
     * forking the whole menu: it can be a one-line transclusion of the shared page with
     * a parameter, e.g. MediaWiki:MenuSidebar-vector = {{MediaWiki:MenuSidebar|vector=1}},
     * and the shared page wraps what only this skin should show in {{#if:{{{vector|}}}|…}}
     * (read directly, {{{vector|}}} is empty).
     */
    private static function menuMessage( $name, $skinName ) {
        $msg = wfMessage( $name . '-' . $skinName );
        if ( $msg->exists() && !$msg->isDisabled() ) {
            return $msg;
        }
        return wfMessage( $name );
    }
}
