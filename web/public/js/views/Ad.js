/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

app.AdView = Backbone.View.extend({
    tagName: 'div',
    className: 'book',
    template: _.template($('#adTemplate').html()),

    render: function () {
        this.$el.html(this.template(this.model.toJSON()));

        return this;
    }
});