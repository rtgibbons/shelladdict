<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

Router::connect('/addict/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/addict/logout', array('controller' => 'users', 'action' => 'logout'));
Router::connect('/addict/register', array('controller' => 'users', 'action' => 'create'));

Router::connect('/addict/:username', array('controller' => 'users', 'action' => 'profile'), array('pass' => array('username')));
Router::connect('/addict', array('controller' => 'users', 'action' => 'index'));

Router::connect('/*', array('controller' => 'pages', 'action' => 'display', 'home'));