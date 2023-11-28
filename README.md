# AppleAuto PHP Library

[AppleAuto](https://github.com/pplulee/appleid_auto) is a project that helps you to manage shared Apple accounts.

With this library, you can easily implement several function provided by AppleAuto API.

## Installation

The library can be installed via [Composer](https://getcomposer.org/). Run the following command:

```bash
composer require sidecloud/appleauto-php
```

## Usage

### SharePage

This can let you get the accounts from the share page in AppleAuto.

If your share link is https://test.com/share/kfcv50, then replace 'share' with 'shareapi'.

If your share page requires a password, then add it as the second parameter.
Like https://test.com/shareapi/kfcv50/password

```php
// Create a new SharePage object
$page = new AppleAutoShare\SharePage("https://test.com/shareapi/kfcv50");

// The request will be sent when the object is created, so you can get the accounts directly
$accounts = $page->accounts;
echo "username".$accounts[0]->username;
echo "password".$accounts[0]->password;
echo "last_check".$accounts[0]->last_check; // The date and time in string format
echo "status".$accounts[0]->status?"Normal":"Abnormal"; // status is a boolean value

// The error message will be stored in $page->errorMsg, if there is.
// By default, it is null.
if ($page->errorMsg) {
    echo $page->errorMsg;
}
```

## License

This library is made available under the MIT License (MIT). Please see [License File](LICENSE) for more information.