define (require,exports,module)->
  Backbone = require 'backbone'
  class QinfoModel extends Backbone.Model
    urlRoot:"index.php/api/question/info/id"
  module.exports = QinfoModel
