define (require,exports,module)->
  class IndexView extends Backbone.View
    initialize: ->
      @.render()
    render: ->
      template = _.template $('#widgets_template').html(),{}
      @.$el.html template
  module.exports = IndexView
