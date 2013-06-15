Sencha-Architect-Code-Generator
====================

Sencha Architect 2.x.x ORM Code Generator , make complete projects for Sencha Architect Only with a database model

Before _(Physical Model Diagram)_
--------------------------------------
![](https://raw.github.com/EstebanFuentealba/Sencha-Architect-Code-Generator/master/example/images/image_physical_diagram.png)

After _(Open Generated Project in Sencha Architect 2.2.2)_
--------------------------------------
![](https://raw.github.com/EstebanFuentealba/Sencha-Architect-Code-Generator/master/example/images/extjs-generator-project.png)

Preview Running _(Running Project in Chrome)_
--------------------------------------
![](https://raw.github.com/EstebanFuentealba/Sencha-Architect-Code-Generator/master/example/images/extjs_code_creator_example.png)



Require
--------------------------------------
- **PHP 5.4.3** for json_encode JSON_PRETTY_PRINT
- **MySQL 5.5.24** for mapping database

	**Windows users**
	--------------------------------------
		[Wampserver (32 bits & PHP 5.4) 2.2E](http://sourceforge.net/projects/wampserver/files/WampServer%202/WampServer%202.2/wampserver2.2e/wampserver2.2e-php5.4.3-httpd2.2.22-mysql5.5.24-32b.exe/download)
		[Wampserver (64 bits & PHP 5.4) 2.2E](http://sourceforge.net/projects/wampserver/files/WampServer%202/WampServer%202.2/wampserver2.2e/wampserver2.2e-php5.4.3-httpd-2.4.2-mysql5.5.24-x64.exe/download)
	
Steps
--------------------------------------
1. Have a database (MySQL) with a physical model preferably with foreign keys (CONSTRAINTS)
2. Configure database in **config.php** file
3. Open in your browser http://localhost/Sencha-Architect-Code-Generator/app/bootstrap.php
4. Go to **build** dir , open Sencha Architect Project
5. In the Sencha Architect **press Build Button** 
7. Run Project
8. Smiles
 
 
Example Instructions
--------------------------------------
[Example README](https://github.com/EstebanFuentealba/Sencha-Architect-Code-Generator/blob/master/example/README.md)

 
TODO List
--------------------------------------

- Order the code and create class model
- Add language pack
- Add Validators
- ~~Generate Actions of Controllers~~
- Add UI configuration (layouts, order, theme, Initial View)
- Generate Back-End .NET, Java, PHP (Optional)
- Add Sencha Touch Option
- Sencha Architect license to continue to test. 