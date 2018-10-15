# Project Group 5
Our own school project in PHP

# Good to know 
Always inherit Base_controller when you create a new controller which always should be named [name].controller.php.

A new model should always be called [name]_model.php.

All controllers must have an index method which is the default method that is called.

The htaccess-file in public is managing the rewrite of the URL and define the URL-base where the index is.

The htaccess-file in app folder restricts anyone using the site to get access to the private-files.

Use the developer branch before pulling your branch to the Master, like an trail and error.

# Base controller

The base controller contains:

 - Protected property: $modelObj
 - Public method: initModel()
 - Public method: reqView();

### $modelObj

Contains the instance of the called method.

### initModel()
The initModel method is responsible for requiring a model. The model name is passed to the method in a parameter as a string: $this->initModel('Model_name');

The initModel method is called in the controller you're working with.

The property $modelObj then contains an instance of the instantiated model which you can then call model functions on.

### reqView()
The reqView method is responsible for acquiring a view and can take two parameters, $view and $data. The view name is passed to the method as a string and $data is mixed (empty array as default): $this->reqView('product',$data);

# Admin

For all admin related work the files should be included in the admin folder, not the public folder.  

# Built with

- PHP
- MYSQL


