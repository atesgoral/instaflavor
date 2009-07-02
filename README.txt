--------------------------------------------------------------------------------
Instaflavor v0.1
--------------------------------------------------------------------------------

http://github.com/atesgoral/instaflavor/

Copyright (c) 2009 Ates Goral

--------------------------------------------------------------------------------

Licensed under the MIT license.

http://www.opensource.org/licenses/mit-license.php

--------------------------------------------------------------------------------
Instaflavor is a Wordpress plug-in for automatic generation of flash movies
(FLV) and their thumbnails. It relies on ffmpeg being already installed (and in
your PATH environment variable). Currently, Flowplayer is used by the FLV
player, but there's no restriction on what player can be used.

How it works:

Links to videos with recognized extensions (wmv, mov, mpeg) are modified to
include a thumbnail image and to play the video when clicked. A 404 handler
automatically generates the thumbnail and FLV on demand. Generated files are
cached and served as static files so that the browser can cache them on the
client-side.

The whole thing is in its very early stages and the overall architecture may
drastically change (especially to decouple it from a particular FLV player).