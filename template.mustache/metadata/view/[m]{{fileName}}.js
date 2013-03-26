Ext.define('{{defaultConfig.package}}.model.{{table.tableName}}', {
    extend: 'Ext.data.Model',
    fields: [
        {{#table.columns}}
		{
			name: '{{columnName}}' {{#isInt}},
			type: 'int'
			{{/isInt}}
		} {{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/table.columns}}
    ]
});