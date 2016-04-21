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

WordPress components are added to your plugin via configuration file, each component having it's own configuration:

* Panels uses config-panel.php file;
  * Panel are WordPress admin page accessible via admin menu and sub-menu;
  * Example of a [Panel configuration](https://github.com/ibelar/atk4wp-sample/blob/master/config-panel.php) from the sample plugin;
* Meta boxes uses config-metabox.php file;
  * Example of a [Meta boxes configuration](https://github.com/ibelar/atk4wp-sample/blob/master/config-metabox.php) from the sample plugin;
* Widgets uses config-widget.php file;
  * Example of a [Widget configuration](https://github.com/ibelar/atk4wp-sample/blob/master/config-widget.php) from the sample plugin;
* Shortcodes uses config-shortcode.php file;
  * Example of a [Shortcode configuration](https://github.com/ibelar/atk4wp-sample/blob/master/config-shortcode.php) from the sample plugin;

Adding a component to your plugin usually require to add the component definition via the component configuration options.
The component options are required by WordPress to build the component itself inside WordPress but also to define the Agile Toolkit view class needed to display the component. This class is define via the 'uses' option.

Depending on the component type, the Agile Toolkit view class define by the component 'uses' option need to extends the proper interface class:

* The class define by 'uses' option for panel must extends WpPanel;
* The class define by 'uses' option for meta box must extends WpMetaBox;
* The class define by 'uses' option for shortcode must extends WpShortcode;
* The class define by 'uses' option for widget must extends WpWidget;

Except for the WpWidget class, all others interfaces classes are children of Agile Toolkit AbstractView. 
Therefore, you can treat them as a regular Agile Toolkit view class; like you would do in a normal Agile Toolkit application.

Example of a panel 'uses' configuration option:

```php
$config['panel']['event'] =  [  'type'  => 'panel',
                                'uses'  => 'my_plugin\Panel\MyPanel',
                                //other panel option...
                                ];
```

Then in MyPlugin/lib/Panel folder define MyPanel class:

```php
namespace my_plugin\Panel;
class MyPanel extends \Wp_WpPanel {}
```
###Note on WpWidget Class

This class is not a children of an Agile Toolkit AbstractView, simply because WordPress required that widgets must extends their widget class. 

####Widget display and onDisplay callback

In order to be able to set the widget display using an Agile Toolkit view, you will add it using the addWidgetDisplay('View') function.
You may pass a regular Agile Toolkit view class to the function or define your own.

You may also set the onDisplay( $callback ) function hook for the widget. This callback will be call prior to output the widget in WordPress giving a chance to setup the view.
The callback function will receive the Agile Toolkit view instance, the one define with addWidgetDisplay(), and a copy of the widget instance field value, if defined, as parameters.
This is useful for setting up the view prior to display it in WordPress.

Setting up a widget display in a WpWidget class:

```php
namespace my_plugin\Widget;
class MyWidget extends \Wp_WpWidget
{
    public function init()
    	{
    		parent::init();
    		//inject the atk view
    		$this->addWidgetDisplay('my_plugin\View\MyView', 'my_view_title');
    		//setup the display callback
    		$this->onDisplay( [$this, 'beforeDisplayWidget']);
    	}
    public function beforeDisplayWidget( $atkView, $instance  )
	{
	    //setup the atk view...
		$atkView->setModel('my_plugin\Model\MyModel');
	}
}
```

####Widget Form and onForm callback

Widget can also display form input element within the widget admin area of WordPress. (Appearance/Widgets). Form add to widgets need to extends Form_WpWidget class.
This is a special Agile Toolkit form adapted for widget display. Form are added via the addForm('Form_WpWidget') function. This function will also return the newly added form instance and this form instance can be use for adding field to the form using the addField() function.

Furthermore, it is also possible to setup a callback function just prior of outputting the form in WordPress admin area with the onForm(callback) function. 
The callback function will receive the Agile Toolkit form instance, the one define with addForm(), and a copy of the widget instance field value.

Field added to the form may also have default value by using the setInstanceDefaults() function by passing an array of field_id=>value pair to the function. 
Note that field input value added to the form is automatically save within WordPress option table when user click the widget 'Save' button.

```php
namespace my_plugin\Widget;
class MyWidget extends \Wp_WpWidget
{
    public function init()
    	{
    		parent::init();
    		//inject the atk form
    		$f = $this->addForm('Form_WpWidget');
    		$f->addField('line', 'title');
    		//setup the display callback
    		$this->onForm( [$this, 'beforeDisplayForm']);
    	    //set widget field default value
    	    $this->setInstanceDefaults( ['title'=> 'My Default Title'] );
    	}
    public function beforeDisplayForm( $atkForm, $instance  )
	{
	    //setup the atk form...
	}
}
```

#Class loading

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