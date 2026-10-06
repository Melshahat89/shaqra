<?php

/*
|--------------------------------------------------------------------------
| DGA Platforms Code (كود المنصات) options
|--------------------------------------------------------------------------
| preloader: full-page loading screen. OFF by default — DGA review asked for
|            no splash screen on open; inline spinners/skeletons are used instead.
|            Set DGA_PRELOADER=true in .env only if DGA requests it again
|            (inline spinners / skeletons are unaffected).
*/
return [
    'preloader' => filter_var(env('DGA_PRELOADER', false), FILTER_VALIDATE_BOOLEAN),
];
