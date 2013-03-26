//@require @packageOverrides
Ext.Loader.setConfig({
    enabled: true
});

Ext.application({
	views: [
		{{#ext.view}}
		'{{className}}'{{#isLessThanTotal}} ,{{/isLessThanTotal}}
		{{/ext.view}}
	],
    autoCreateViewport: true,
    name: '{{defaultConfig.package}}'
});
