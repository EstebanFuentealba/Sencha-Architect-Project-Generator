//@require @packageOverrides
Ext.Loader.setConfig({
    enabled: true
});

Ext.application({
	views: [
		{{#items}}
		'{{className}}'{{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/items}}
	],
    autoCreateViewport: true,
    name: '{{defaultConfig.package}}'
});
