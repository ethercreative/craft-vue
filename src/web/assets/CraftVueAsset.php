<?php
/**
 * Craft Vue
 *
 * @link      https://ethercreative.co.uk
 * @copyright Copyright (c) 2018 Ether Creative
 */

namespace ether\craftvue\web\assets;

use craft\web\assets\cp\CpAsset;
use craft\web\assets\vue\VueAsset;
use craft\web\View;
use yii\web\AssetBundle;

/**
 * Class CraftVueAsset
 *
 * @author  Ether Creative
 * @package ether\craftvue\web\assets
 */
class CraftVueAsset extends AssetBundle
{

	public function init ()
	{
		$this->sourcePath = __DIR__;

		$this->depends = [
			CpAsset::class,
			VueAsset::class,
		];

		parent::init();
	}

	public function registerAssetFiles ($view)
	{
		parent::registerAssetFiles($view);

		$jsBoot = <<<JS
window.Craft._awaitVue = [];
window.Craft.booting = function (callback) {
	window.Craft._awaitVue.push(callback);
}
JS;

		$jsReady = <<<JS
const CraftVue = async () => {
	for (let i = 0, l = window.Craft._awaitVue.length; i < l; ++i)
		await window.Craft._awaitVue[i](Vue);

	new Vue({
		el: '#main',
	});
};

CraftVue().then({}).catch(console.error);
JS;


		$view->registerJs($jsBoot, View::POS_HEAD);
		$view->registerJs($jsReady, View::POS_LOAD);
	}

}