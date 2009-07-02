$(function () {
    $("a").each(function (idx, el) {
        var q = $(el);
        var url = q.attr("href");

        var tokens = /\/uploads\/(.+?\.([^.]+))$/.exec(url);
        
        if (!tokens || !/^(wmv|mov|mpg)$/i.test(tokens[2])) {
            return true;
        }

        var id = "overlay" + idx;
        var cache_base = instaflavor_plugin_url + "cache/" + tokens[1];

        $('<a class="instaflavor_play" href="' + url
            + '" rel="#' + id
            + '" style="background-image: url('
            + cache_base + ".jpg"
            + ')"><span></span></a>'
            + '<div class="instaflavor_overlay" id="' + id +'">'
            + '<a class="instaflavor_player" href="'
            + cache_base + ".flv"
            + '">&nbsp;</a></div>')
            .insertBefore(q)
        q.wrap('<div class="instaflavor_desc"></div>');
    });
 
    $("a.instaflavor_play").overlay({
        onBeforeLoad: function() {
            this.getContent().find("a.instaflavor_player")
                .flowplayer(instaflavor_plugin_url + "flowplayer-3.1.1.swf");
            this.getBackgroundImage().expose({api: true}).load();	
        },

        onLoad: function(content) {
            this.getContent().find("a.instaflavor_player").flowplayer(0).load();
        },

        onClose: function(content) {
            $f().unload();
            this.getBackgroundImage().expose().close();
        }
    });
});
