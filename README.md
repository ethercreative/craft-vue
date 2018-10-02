# craft-vue
A helper module for building Craft CMS plugins with Vue components.

This supports all major browsers **except** IE11.

## Installation

```
composer require ether/craft-vue
```

## Usage

First, register the module in your plugin's `init` function:

```php
class Plugin extends \craft\base\Plugin
{

    public function init ()
    {
        parent::init();
        
        \ether\craftvue\CraftVue::register();
        
        // ...
    }

}
```

Then in your JS register your component (this should be a JS file imported by an 
asset bundle):

```js
import MyComponent from '../vue/MyComponent.vue';

Craft.booting(Vue => {
    Vue.component('my-component', MyComponent);
});
```

You can import your component however you want, but if you use `.vue` files be 
sure to compile them beforehand. `Craft.booting` supports returned `Promises`, 
and `await` / `async` syntax.

It's now possible to use `<my-component></my-component>` anywhere in the `#main` 
div.

## Future Features
- [ ] CLI for creating boilerplate for compatible Vue components with 
hot-reloading and other fun stuff (something like `./craft vue/create [name]`).