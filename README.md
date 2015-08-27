# open-orchestra-user-bundle

| Service       | Badge         |
| ------------- |:-------------:|
| Travis | [![Build Status](https://travis-ci.org/open-orchestra/open-orchestra-user-bundle.svg)](https://travis-ci.org/open-orchestra/open-orchestra-user-bundle) |
| CodeClimate (quality) | [![Code Climate](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle/badges/gpa.svg)](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle) |
| CodeClimate (coverage) | [![Test Coverage](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle/badges/coverage.svg)](https://codeclimate.com/github/open-orchestra/open-orchestra-user-bundle/coverage) |
| Sensio Insight | [![SensioLabsInsight](https://insight.sensiolabs.com/projects/7e9bf4b8-87e9-4572-a1e1-a67880a1d5af/big.png)](https://insight.sensiolabs.com/projects/7e9bf4b8-87e9-4572-a1e1-a67880a1d5af) |
| VersionEye | [![Dependency Status](https://www.versioneye.com/user/projects/551e87ad971f78433900010e/badge.svg?style=flat)](https://www.versioneye.com/user/projects/551e87ad971f78433900010e) |

## Usage with mongo db

To use the `open-orchestra-user-bundle` you should also activate and configure the `FosUserBundle`

Configuration :

``` yaml
    fos_user:
        db_driver: mongodb
        firewall_name: main
        user_class: %user_class%
        group:
            group_class: %group_class%
```

In this configuration you can choose a parameter :

 - `user_class` : either your own user class or `OpenOrchestra\UserBundle\Document\User`
 - `group_class : either :
   - Your own group class
   - If you use the `open-orchestra-cms-bundle` : `OpenOrchestra\GroupBundle\Document\Group`
   - If you use only the `open-orchestra-user-bundle` : `OpenOrchestra\UserBundle\Document\Group`

## Usage with another database

To use the `open-orchestra-user-bundle` with another database, you should :

 - follow the `FosUserBundle` documentation on how to use the database
 - Create your own user class, and configure the bundle with the correct parameters
