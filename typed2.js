!function($) {

    "use strict";

    var Typed = function(el, options) {
        this.el = $(el);
        this.options = $.extend({}, $.fn.typed.defaults, options);
        this.strings = this.options.strings;
        this.typeSpeed = this.options.typeSpeed;
        this.currentString = 0;
        this.currentPos = 0;
        this.cursorChar = this.options.cursorChar;
        this.buffer = "";
        this.wait = 0;
        this.build();
    }

    Typed.prototype = {
        constructor: Typed,

        build: function() {
            // Insert cursor
            this.cursor = $("<span class=\"typed-cursor\">" + this.cursorChar + "</span>");
            this.el.after(this.cursor);

            this.next();
        },

        next: function() {
            var self = this;
            var delay;
            if (self.wait) {
                delay = self.wait;
                self.wait = 0;
            }
            else {
                var humanize = Math.round(Math.random() * (100 - 30));
                delay = self.typeSpeed + humanize;
            }
            self.wait = 0;
            setTimeout(function() {
                self.type();
            }, delay);
        },

        type: function() {
            var str = this.strings[this.currentString];
            var char = str.charAt(this.currentPos);
            if (char == '!' && this.currentPos == 0) {
                this.buffer += str.slice(1);
                this.currentPos = str.length - 1;
                this.wait = 1;
            }
            else if (char == '<') {
                this.buffer = this.buffer.slice(0, -1);
            }
            else if (char == '@') {
                this.wait = 1000;
            }
            else {
                this.buffer += char;
            }
            this.el.text(this.buffer);

            ++this.currentPos;
            if (this.currentPos == str.length) {
                this.currentPos = 0;
                ++this.currentString;
                if (this.currentString == this.strings.length) {
                    this.currentString = 0;
                    this.buffer = "";
                }
            }

            this.next();
        }
    }

    $.fn.typed = function (option) {
        return this.each(function () {
          var $this = $(this)
            , data = $this.data('typed')
            , options = typeof option == 'object' && option;
          if (!data) $this.data('typed', (data = new Typed(this, options)));
          if (typeof option == 'string') data[option]();
        });
    };

    $.fn.typed.defaults = {
        strings: ["hello"],
        typeSpeed: 500,
        cursorChar: "|",
    };

}(window.jQuery);

