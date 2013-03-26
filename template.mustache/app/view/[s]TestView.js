Ext.define('{{defaultConfig.package}}.view.{{defaultConfig.defaultView}}', {
    extend: 'Ext.window.Window',
    height: 250,
    width: 400,
    title: 'My Window',
    initComponent: function() {
        var me = this;
        me.callParent(arguments);
    }
});