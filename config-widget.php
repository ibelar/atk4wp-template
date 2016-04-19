<?php
/**
 * Widget Configuration
 *
 * $config['widget']['id']  => [ $options ]  (array)(Required) An array containining the widget options. $options explain below.
 * 		Id must be unique within your namespace.
 *		Ex: $config['widget']['wdg1'] => [$wdg1_options];
 *			$config['widget']['wdg2'] => [$wdg2_options];
 *
 *  ---------------------------
 *	Array $options :
 *  'uses'            => (string)(Required) The widget class to use. The class must extends Wp_WpWidget
 *						Ex: 'uses' =>  __NAMESPACE__ . '\Widget\Event'
 *						
 *  'title'           => (string)(Required) A string that hold the title of the widget as it appear in the admin area.
 *  'widget_ops'      => (array)(Optional)  An array that hold widget option as defined in Wordpress widget options.
 *	'display'         => [$display](array)(Optional) An array that hold the widget front end display option. $display array explain below.
 *	'form'			  => [$form] (array)(Optional) An array that hold the widget form option. $form array explain below.
 *  
 *	'fields'          => [$fields](array)(Optional) An array that hold form fields definitions options. $fields array explain below.
 *						 Note: If 'form' is not defined but 'fields' are; then the widget will use Wp_Widget_Form by default.
 *----------------------------
 *
 *	Array $display: 
 *    'uses'         => (string)(Required) A string that hold the class name to use for displaying the widget.
 *                      	if not set here, you must set it in your widget using the addWidgetDisplay('className') function.
 *    'title'        => (optional)(string) A string that hold the front end display title of the widget.
 *                      	title may also be set using setWidgetDisplayTitle( 'title') function.
 *---------------------------
 *   
 *	Array $form:
 *    'uses'         => (string)(Required) A string that hold the class name use for displaying the widget form.
 *---------------------------
 *
 *	Array $fields:
 *      $id          => [$field] (array) An array that hold the field definition options. $field explain below.
 *						$id is the field name add to the form. Ex: 'date' => [$field]
 *---------------------------
 *
 *	Array $field:
 *      'type'       => (string)(Required) A string that hold the field type. Ex: line, date, dropdown.
 *      'caption'    => (string)(Optional) A string that hold the field caption.
 *      'default'    => (string)(Optional)  A string that hold field default value.
 *       'list'      => (array)(Optional)  An array that hold a field list value. For value list field like dropdown.
 */

