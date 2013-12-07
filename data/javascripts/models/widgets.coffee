define (require,exports,module)->
  $ = require '$'
  Backbone = require 'backbone'
  _ = require "underscore"
  
  class WidgetsModel extends Backbone.Model
    initialize: ->
    urlRoot:"index.php/api/widgets"

  module.exports = WidgetsModel
