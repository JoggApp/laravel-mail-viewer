All notable changes to the Laravel Mail Viewer be documented in this file

## v5.0.0 (04-09-2019)
- Now supports Laravel v6.0
- Laravel v5.6.* & Laravel v5.7.* are no longer supported, min requirement is now v5.8.*
- Support for Laravel v5.8.* will be dropped in v5.1.*

## v4.0.4 (06-03-2019)
- The package now renders the correct mailable having similar class name as another mailable in different namespace.
- Big thanks to [Thomas Kane](https://github.com/thomasjohnkane) for pointing out [this issue](https://github.com/JoaonzangoII/laravel-mail-viewer/issues/18).

## v4.0.3 (27-02-2019)
- Update travis config

## v4.0.2 (27-02-2019)
- drop php v7.1 support

## v4.0.1 (27-02-2019)
- phpunit update

## v4.0.0 (27-02-2019)
- Now supports Laravel v5.8

## v3.1.0 (05-12-2018)
- Fixed the behaviour of in_array by enabling strict checking.

## v3.0.0 (13-11-2018)
- If the constructor dependency is not type hinted it will trust the user input in the config file as a replacement. [PR for this feature](https://github.com/JoaonzangoII/laravel-mail-viewer/pull/15)
- Big thanks & credits to [Junhai](https://github.com/starvsion) for making this possible :)

## v2.2.0 (11-10-2018)
- The package now uses DB transactions. [PR for this feature](https://github.com/JoaonzangoII/laravel-mail-viewer/pull/12)
- Big thanks & credits to [Wouter Peschier](https://github.com/kielabokkie) for making this possible :)

## v2.1.1 (05-10-2018)
- [Bug fix](https://github.com/JoaonzangoII/laravel-mail-viewer/pull/11)

## v2.1.0 (05-10-2018)
- We can now define the [factory states](https://laravel.com/docs/5.7/database-testing#factory-states) to be used for any dependency of a mailable, if the dependency is an eloquent model. [PR for this feature](https://github.com/JoaonzangoII/laravel-mail-viewer/pull/10)
- Big thanks & credits to [Wouter Peschier](https://github.com/kielabokkie) for making this possible :)  

## v2.0.2 (29-09-2018)
- Fix class check and cover all data types.

## v2.0.1 (28-09-2018)
- The package now attempts to instantiate non eloquent objects using the container if no factory exists.

## v2.0.0 (27-09-2018)
- Major changes in how the mailables are registered in the config file.
- Please read the comments in the config file for the 'mailable' key and update yours accordingly.
- The config file is now cacheable as well as serializable.
- Directory structure changed.

## v1.0.1 (20-09-2018)
- Updated readme

## v1.0.0 (19-09-2018)
- Added Tests
- First major stable release

## v0.2.0 (07-09-2018)
- Minor improvements

## v0.1.0 (07-09-2018)
- Initial release