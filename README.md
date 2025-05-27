# Welcome to Xudid/Ui

With Xudid/Ui we can generate HTML5 from php.
Each HTML5 Tag is seen as an Object .

***Example***
~~~
$page = X::Page()
    ->importCss('vendor/xudid/Ui/css/ui.css')
    ->importScript(
        "alert('Hello Js');",
        new Script('alert("Alert from script object")', false),
        new Script('vendor/xudid/Ui/js/modal.js'),
    )
    ->feedBody(
        X::Div(
            X::P('Hello Ui'),
            X::Form(
                x::Date()
                    ->label("Birth Date")
                    ->name('birth_date'),
                X::TextField()
                    ->label('Name')
                    ->name('name'),
                X::TextField()->label('Email')
                    ->name('email'),
                X::Submit('Submit')
                    ->addClass('btn'),
            )
        )->addClass('content')
    );

echo $page->__toString();
~~~
View more on https://xudid.github.io/















