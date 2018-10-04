All notable changes to the Laravel Mail Viewer be documented in this file

## v2.1.1 (05-10-2018)
- [Bug fix](https://github.com/JoggApp/laravel-mail-viewer/pull/11)

## v2.1.0 (05-10-2018)
- We can now define the [factory states](https://laravel.com/docs/5.7/database-testing#factory-states) to be used for any dependency of a mailable, if the dependency is an eloquent model. [PR for this feature](https://github.com/JoggApp/laravel-mail-viewer/pull/10)
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