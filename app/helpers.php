<?php
function log2($msg){
    \Illuminate\Support\Facades\Storage::disk('local')->append('log.log', date('Y-m-d H:i:s') . ' - ' . $msg);
}
