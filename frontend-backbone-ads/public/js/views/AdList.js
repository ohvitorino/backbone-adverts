/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

app.AdListView = Backbone.View.extend({
    el: '#adList',

    initialize: function (initialAds) {
        this.collection = new app.AdList(initialAds);
        this.render();
    },

    render: function () {
        this.collection.each(function (item) {
            this.renderAd(item);
        }, this);
    },

    renderAd: function (item) {
        var adView = new app.AdView({
            model: item
        });

        this.$el.append(adView.render().el);
    }
});