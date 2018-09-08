<?php

namespace site\mvc;

use site\JPHP;

class HomeController extends AbstractController
{
    /**
     * @return string
     */
    public function render(): string
    {
        return JPHP::getTemplateEngine()->render("pages/home", [
            "api" => $this->api_example,
            "multi_threading" => $this->multi_threading_example,
            "unicode_strings" => $this->unicode_strings_example,
            "gui" => $this->gui_example,
            "web" => $this->web_example,
        ]);
    }

    public function useRegexp(): bool
    {
        return false;
    }

    public function getPath(): string
    {
        return "/";
    }

    private $api_example = "<?php\nString::shuffle(\$str); // New API for primitive types

// API for Streams instead of fopen, fclose, etc.
Stream::getContents('path/to/file');
    
// API for regex instead of preg_*
\$valid = Regex::match('^[a-z]+$', \$str);
    
// Flow API for iterators and arrays
echo Flow::of([1, 2, 3])
    ->map(function(\$n) { return \$n * 10; })
    ->reduce(function(&\$r, \$n) { \$r += \$n; });";

    private $multi_threading_example = "<?php\n\$thread = new Thread(function () {
    \$i = 0;
    
    while (true) {
        \$i++;
        echo \$i, \"\\n\";
    
        sleep(2); // every 2 seconds
    }
});
    
\$thread->start(); // start thread";

    private $unicode_strings_example = "<?php\n// Unicode like in Java, UTF-16

// (from japan) programing language
\$str = \"プログラミング言語\";
    
// Get length of the unicode string
echo String::length(\$str);
    
// Change symbol by index
\$str[1] = '語';
    
echo \$str;";

    private $gui_example = "<?php\n
use php\\gui\\{ UXApplication, UXForm }; // import JavaFX classes from jphp-gui-ext

UXApplication::runLater(function () {
    \$form = new UXForm(); // create new form
    \$form->title = \"Hello, World!!\";
    \$form->size = [300, 200]; 
    \$form->show(); // show form
});";
    private $web_example = "<?php\n
use php\\http\\HttpServer;
use php\\http\\HttpServerRequest;
use php\\http\\HttpServerResponse; // import classes from jphp-httpserver-ext

\$server = new HttpServer(5000, \"localhost\");
\$server->get(\"/\", function (HttpServerRequest \$req, HttpServerResponse \$res) {
    \$res->charsetEncoding(\"UTF-8\"); // set UTF-8
    \$res->body(\"<h1>Hello from JPHP!</h1>\");
});

\$server->stopAtShutdown(true);
\$server->run(); // start server on http://localhost:5000
";
}