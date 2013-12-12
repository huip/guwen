define (require,exports,module)->
  Backbone = require 'backbone'
  class TopicModel extends Backbone.Model
    urlRoot:"index.php/api/topic/"
  module.exports = TopicModel
