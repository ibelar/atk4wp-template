#Welcome

This is a WordPress plugin development template done with the [Agile Toolkit interface (atk4-wp)](https://github.com/ibelar/atk4-wp) using the [Agile Toolkit framework (atk4)](http://www.agiletoolkit.org).

#Requirement

This WordPress plugin development template require to have the atk4-wp interface and the [Agile Toolkit framework (atk4)](http://www.agiletoolkit.org) to be install. 
[Instal atk4-wp](https://github.com/ibelar/atk4-wp);

#Instruction

##Download this template

Download a copy of this template and add it to your WorpPress plugin directory.

##Create a namespace for your plugin

Open composer.json file. Locate the autoload section and replace PLUGIN_NAMESPACE with your namespace. 
Make sure your namespace is unique in order to avoid conflict with other WordPress plugin and that your namespace does not contains any space.
You can also add a name and a description to your plugin composer package.

```json
{
  "name": "Add your name here",
  "description": "Add your description here",
  "license": "MIT",
  "autoload": {
    "psr-4": {
      "PLUGIN_NAMESPACE\\": "lib/"
    }
  }
}
```

Tell composer about your changes by running the composer dump-autoload command using terminal at the root of your plugin directory. 
This will create your autoload file needed for your plugin using your own namespace.

```
composer dump-autoload
```

##Edit plugin.php file

Open the plugin.php file and replace the top section with proper name and description corresponding to your plugin.

```php
/**
 * @wordpress-plugin
 * Plugin Name:       YOUR_PLUGIN_NAME
 * Plugin URI:        YOUR_SITE
 * Description:       YOUR_DESCRIPTION
 * Version:           1.0.0
 * Author:            YOUR_NAME
 */
```

Still in plugin.php replace PLUGIN_NAMESPACE to your namespace

```php
//Rename using your namespace.
namespace PLUGIN_NAMESPACE;
```

Finally edit the $atk_plugin_name variable with your plugin name.

```php
//Rename using your plugin name.
$atk_plugin_name  = "PLUGIN_NAME";
```

##Edit Plugin.php class

This file class is located within the lib directory. This class must extends the WpAtk class and implement the Pluggable interface.
Open the file and change the namespace value with your.

```php
//rename using your namespace.
namespace PLUGIN_NAMESPACE;
```
The Pluggable interface implement threes function that your Plugin class must define. Use these functions to define your plugin activation, deactivation and uninstall behavior. 

```php
public function activatePlugin(){}
public function deactivatePlugin(){}
public function uninstallPlugin(){}
```
##Create WordPress components.

At this point, you can start building the WordPress component: panel, meta boxes, widget or shortcode for the plugin using one of the config-{component} file. 
For a better understanding of each component configuration, it might be a good idea to take a look at the atk4wp-sample plugin or look at each configuration file explanation.

#Note on Class loading

For properly loading each class within your plugin namespace, make sure you are using the namespace directive inside each class definition.

```php
namespace my_plugin\Model;
class Event extends \Model_Table
{
}
```
To add a class element that belong to your plugin namespace.
Example: adding a model class locate in MyPlugin/lib/Model/Event.php where Event class use `namespace my_plugin\Model;` directive.

```php
$this->add('my_plugin\Model\Event');
```

Use the backlash '\' for extending class using an atk4 or atk4-wp class. (outside of your namespace).

```php
class myClass extends \View{}
```

You will also need to use namespace qualifier for model using field reference like hasOne() or hasMany().

```php
namespace my_plugin\Model;
class Event extends \Model_Table
{
    $this->hasOne('my_plugin\Model\User');
    $this->hasMany('my_plugin\Model\EventDetail');
}
```


#License

Copyright (c) 2016 Alain Belair. MIT Licensed,

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.