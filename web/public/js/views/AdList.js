/**
 * Created by bruno on 06/06/15.
 */

var app = app || {};

app.AdListView = Backbone.View.extend({
    el: '#adList',

    initialize: function (initialAds) {
        this.collection = new app.AdList(initialAds);
        this.render();

        // The events the object is listening to
        this.listenTo(this.collection, 'add', this.renderAd);
    },

    events: {
        "click #btnAdd": "addAd"
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
    },

    // Event Handlers
    addAd: function (e) {
        e.preventDefault();

        var formData = {};

        $("#addAd").children("input").each(function (i, el) {
            var inputValue = $(el).val();
            if ( inputValue != "") {
                formData[el.name] = inputValue;
            }
        });

        // Add default publication time
        formData['publication_time'] = new Date();

        this.collection.add(new app.Ad(formData));

        // This clear form for next insertion
        this.clearFormData();
    },

    clearFormData: function () {
        $("#addAd").children("input").each(function(i, el) {
            $(el).val('');
        });
    }
});