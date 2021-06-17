define([
    'ko',
    'uiComponent',
], function (ko, Component) {
    'use strict';

    var self;
    return Component.extend({
        additionalText: ko.observable('Click a row, button, or list item to show additional text here.'),
        randomColour: ko.observable("rgb(0, 0, 0)"),
        defaults: {
            template: 'Magelearn_CodeSample/index',
        },
        initialize: function () {
            self = this;
            this._super();
            //call the subscribeToText function to run on intialize
            this.subscribeToText();
        },
        getAdditionalText: function (data,event) {
            self.additionalText(data.additional_text);
        },
        subscribeToText: function() {
            this.additionalText.subscribe(function(newValue) {
                console.log(newValue);
                self.updateTextColour();
            });
        },
        randomNumber: function() {
                return Math.floor((Math.random() * 255) + 1);
        },
        updateTextColour: function() {
            //define RGB values
            var red = self.randomNumber(),
                blue = self.randomNumber(),
                green = self.randomNumber();
                
            self.randomColour('rgb(' + red + ', ' + blue + ', ' + green + ')');
        }
    });
});