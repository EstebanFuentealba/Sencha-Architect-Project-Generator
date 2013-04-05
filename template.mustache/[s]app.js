//@require @packageOverrides
Ext.Loader.setConfig({
    enabled: true
});

Ext.application({
	models: [
        {{#ext.model}}
		'{{className}}'{{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/ext.model}}
    ],
    stores: [
        {{#ext.store}}
		'{{className}}'{{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/ext.store}}
    ],
	views: [
		{{#ext.view}}
		'{{className}}'{{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/ext.view}}
	],
    autoCreateViewport: true,
    name: '{{defaultConfig.package}}'
});
