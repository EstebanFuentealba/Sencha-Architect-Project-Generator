Ext.define('{{defaultConfig.package}}.view.{{table.className}}', {
    extend: 'Ext.window.Window',
    height: 250,
    width: 400,
    title: 'My {{table.className}}',
    initComponent: function() {
        var me = this;
        me.callParent(arguments);
    }
});