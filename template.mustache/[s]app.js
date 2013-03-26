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
	views: [
		{{#ext.view}}
		'{{className}}'{{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/ext.view}}
	],
    autoCreateViewport: true,
    name: '{{defaultConfig.package}}'
});
