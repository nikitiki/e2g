/**
 * E2Gアプリケーションクラス
 *
 * @autohr @cypher-works.com
 */
// {{{ E2G
E2G.app.App = Ext.extend( Ext.util.Observable, { 

    // {{{ commonInit
    /**
     * 共通初期化メソッド
     */
    commonInit : function() {

        // s.gif
        Ext.BLANK_IMAGE_URL = 'extjs/resources/images/default/s.gif';

        // クイックチップス初期化
        Ext.QuickTips.init();

    },
    // }}}


    // {{{ initApp
    /**
     * アプリケーション初期化メソッド
     */
    initApp : function() {

    },
    // }}}


    // {{{ run
    /**
     * アプリケーション実行メソッド
     */
    run : function() {

        // 共通初期化処理実行
        this.commonInit();

        // アプリケーション初期化
        this.initApp();

    }
    // }}}

});

// }}}

// {{{ onReady
Ext.onReady( function(){

    // アプリケーション実行
    window.Application = new E2G.app.App();
    Application.run();

});
// }}}

