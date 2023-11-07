<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}">
  <head>
    <title>Intranet - GSB</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="https://img.icons8.com/ios/50/factory.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com" type=""></script>
  </head>
  <body class="bg-blue-100" >

    <div class="flex">

      @yield('menu')
      @yield('contenu1')
      @yield('contenu2')
    </div>

  </body>
  </html>
