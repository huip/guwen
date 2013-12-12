define (require,exports,module)->
  Backbone = require 'backbone'
  class RelativeModel extends Backbone.Model
    urlRoot:"index.php/api/question/relative/id/"
  module.exports = RelativeModel
