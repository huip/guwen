define (require,exports,module)->
  Backbone = require 'backbone'
  class RelativeModel extends Backbone.Model
    urlRoot:"index.php/api/relative/"
  module.exports = RelativeModel
