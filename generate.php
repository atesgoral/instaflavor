<?php
ob_start();

try {
    $redir_url = $_SERVER["REDIRECT_SCRIPT_URL"];

    echo "Redirect URL: " . $redir_url . "\n";

    $dest_file = substr($redir_url, strpos($redir_url, "/cache/") + 1);
    $src_file = "../../uploads/" . substr($dest_file, 6, -4);
    $ext = substr($dest_file, -3);

    echo "Destination file: " . $dest_file . "\n";
    echo "Source file: " . $src_file . "\n";

    $dir = dirname($dest_file);

    echo "Creating directories: " . $dir . "\n";

    @mkdir(escapeshellarg($dir), 0775, true);

    switch ($ext) {
    case "jpg":
        $args = "-ss 1 -vframes 1 -r 1";
        break;
    case "flv":
        $args = "-ar 22050";
        break;
    default:
        throw new Exception("Don't know how to generate " . $ext);
    }

    $cmd = "ffmpeg -i " . escapeshellarg($src_file) . " " . $args . " "
        . escapeshellarg($dest_file) . " 2>&1";

    echo "Command: " . $cmd . "\n";

    exec($cmd, $output, $ret_code);

    echo "    " . implode("\n    ", $output) . "\n";

    if ($ret_code != 0) {
        @unlink(escapeshellarg($dest_file));
        throw new Exception("Return code was " . $ret_code);
    }

    if (!file_exists($dest_file)) {
        throw new Exception("Destination file not generated");
    }

    ob_end_clean();

    header("Location: " . $_SERVER["REDIRECT_SCRIPT_URI"]);
} catch (Exception $e) {
    echo "Generation failed: ",  $e->getMessage();

    header("HTTP/1.1 404 Not Found");
    header("Content-Type: text/plain");

    ob_end_flush();
}
?>
