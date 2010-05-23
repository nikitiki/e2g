/**
 * windowにまつわる共通処理を記述
 *
 * @author @cypher-wors.com
 */ 
//E2G.WindowUtil = Ext.extend( Object, { // ExtJS用
E2G.WindowUtil = {

    // ロード時処理
    load: function() {
        this.init();
    },

    // 初期化処理
    init: function() {
        var ref = this;
        ref.setKeyEvents();
    },

    // 共通キーイベント処理
    setKeyEvents: function() {
        var ref = this;
    }
}
//}); // ExtJS用
