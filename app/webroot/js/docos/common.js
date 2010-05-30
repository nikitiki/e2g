/**
 *
 */
$.extend( E2G.DocosCommon = {}, E2G.WindowUtil, {

    // {{{ setKeyEvents()
    /**
     * イベント発火設定関数
     */
    setKeyEvents : function() {
        var ref = this;

        // twitter風
        $( "#text" ).charCount({
            targetId: '#counter',
            allowed: 100,
            warning: 80 
        });
    }

});

Ext.onReady( function() {

    E2G.DocosCommon.load();
});
