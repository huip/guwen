define (require,exports,module)->
  Backbone = require 'backbone'
  class UserInfoModel extends Backbone.Model
    urlRoot:"index.php/api/uinfo/"
  module.exports = UserInfoModel
