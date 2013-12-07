define (require,exports,module)->
  Backbone = require 'backbone'
  class QinfoModel extends Backbone.Model
    urlRoot:"index.php/api/qinfo/"
  module.exports = QinfoModel
