WP-Framework (NOT maintained anymore)
============
WordPress Framework for custom theme development  (PHP > 5.3)
  

## This framework works in 3 parts :
* jb-framework (inside mu-plugins)
* jb-project
* jb-theme

Every repository have (almost) the same classes. jb-theme extends jb-project which extends jb-framework. By doing this, we keep it very modular for the client need.
___

### jb-framework (mu-plugins folder)
- Responsible for all framework related function. Everything inside those classes should be very general.

### jb-project (mu-plugins folder)
- Responsible for all project related function in a WordPress mulsitite installation. Normally you would declare (for example) general post-types which are the same for all website in the project (http://en.wikipedia.org/wiki/Don't_repeat_yourself).
- Every class from the framework is instanciated here.

### jb-theme (theme/jb-theme folder)
- Responsible for all theme related functions.
