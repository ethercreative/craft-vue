<?php
/**
 * Craft Vue
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2018 Ether Creative
 */

namespace ether\craftvue;

use ether\craftvue\web\assets\CraftVueAsset;
use yii\base\Module;

/**
 * Class CraftVue
 *
 * @author  Ether Creative
 * @package ether\craftvue
 */
class CraftVue extends Module
{

	public static function register ()
	{
		if (\Craft::$app->hasModule('craft-vue'))
			return;

		\Craft::$app->setModule('craft-vue', CraftVue::class);
		\Craft::$app->getModule('craft-vue');
	}

	/**
	 * @throws \yii\base\InvalidConfigException
	 */
	public function init ()
	{
		parent::init();

		$request = \Craft::$app->request;

		if (
			$request->isCpRequest
			&& $request->isGet
			&& strpos($request->fullPath, 'plugin-store') === false
		) {
			\Craft::$app->view->registerAssetBundle(CraftVueAsset::class);
		}
	}

}