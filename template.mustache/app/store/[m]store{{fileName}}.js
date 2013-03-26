Ext.define('{{defaultConfig.package}}.store.store{{table.tableName}}', {
	extend: 'Ext.data.Store',
	constructor: function(cfg) {
		var me = this;
		cfg = cfg || {};
		me.callParent([Ext.apply({
			storeId: 'store{{table.tableName}}',
			fields: [
				{{#table.columns}}
				{
					name: '{{columnName}}'
				}{{#isLessThanTotal}} ,{{/isLessThanTotal}}
				{{/table.columns}}
			]
		}, cfg)]);
	}
});