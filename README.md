# ThinkPHP 方便被 mock 的 facade

## 安装
非开发依赖，不要加--dev   
```bash
composer require xwpd/thinkphp-facade 
```
自定义的所有Facade必须继承 Xwpd\ThinkFacade\Facade。

## 使用
1. 安装开发依赖
```bash
composer require mockery/mockery --dev
```

1. 使用此扩展包后 mock 方式   
例：MyFacade
```php
MyFacade::shouldReceive('get')
      ->once()
      ->with('key')
      ->andReturn('value');
MyFacade::get('key')=='value'//true
```

1. 框架自带 Facade 及 其他没有继承  Xwpd\ThinkFacade\Facade 的 Facade 的 mock 方式   
例： 缓存Cache的模拟
```php

use Mockery;
use Mockery\Mock;
//先找到 Cache 对应的绑定实现类 think\Cache ，并对其进行模拟
 $mock=Mockery::mock('think\Cache', function ($mock) {
    /**
     * @var Mock $mock
     */
    $return='return';
    $key='key';
    return $mock->shouldReceive('get')->with($key)->andReturn($return);
});
Container::getInstance()->bindTo('think\Cache',$mock);
//模拟后，即 Cache Facade 也被模拟
Cache::get('key')=='return'//true

```