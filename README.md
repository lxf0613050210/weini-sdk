# 唯妮供应链 SDK

Based on [foundation-sdk](https://github.com/HanSon/foundation-sdk)

Ref: [唯妮供应链开放平台](http://api.weinihaigou.com/interface/html/index.html)

## Requirement
- PHP >= 7.0
- **[composer](https://getcomposer.org/)**

## Installation
```
composer require seek-x2y/weini-sdk -vvv
```
## Usage
```
$config = [
    'key' => '',
    'parenter' => '',
//  'debug' => true,
];
    $api = new Weini($config);
    $res = $api->request('/api/sup/searchOrder.shtml','searchOrder', [
        'StartModified' => date('Y-m-d H:i:s', time() - 86000),
        'EndModified' => date('Y-m-d H:i:s'),
//            'Status' => '',
        'PageNo' => 1,
        'PageNum' => 100,
//            'IfReturnTotal' => '',
    ]);

```

## License

MIT
