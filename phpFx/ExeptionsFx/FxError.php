<?php
namespace phpFx\ExeptionsFx;

use phpFx\routerFx\FxException;

class FxError
{
    public static function handleException(\Throwable $e)
    {
        // Log the exception or take other necessary actions
        error_log($e);

        // Capture code snippet around the error
        $errorMessage = $e->getMessage();
        $errorDetails = $e->__toString();
        $errorTrace = $e->getTraceAsString();
        $errorDetails = self::captureCodeSnippet($e->getFile(), $e->getLine());

        // Display a user-friendly error page
        include 'pageError.php';
        exit;
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        // Log the error or take other necessary actions
        error_log("Error [$errno] $errstr in $errfile on line $errline");

        // Capture code snippet around the error
        $errorMessage = "Error [$errno] $errstr";
        $errorfile = "File: $errfile\nLine: $errline";
        $errorTrace = ''; // You can include more details here if needed
        $errorDetails = self::captureCodeSnippet($errfile, $errline);

        // Display a user-friendly error page
        include 'pageError.php';
        exit;
    }

    private static function captureCodeSnippet($file, $line)
    {
        $codeSnippet = '';
        $linesBefore = 10;
        $linesAfter = 5;

        if (file_exists($file)) {
            $fileContent = file($file);
            $startLine = max(1, $line - $linesBefore);
            $endLine = min(count($fileContent), $line + $linesAfter);

            for ($i = $startLine; $i <= $endLine; $i++) {
                $code = htmlspecialchars($fileContent[$i - 1], ENT_QUOTES, 'UTF-8');

                // Highlight the line with error in red
                if ($i == $line) {
                    $code = '<span style="color: red;">' . $code . '</span>';
                }

                $codeSnippet .= $code;
            }
        }

        return $codeSnippet;
    }
}