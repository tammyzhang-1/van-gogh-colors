<?php
function match_routes($uri, $routes)
{
  if (is_array($routes)) {
    foreach ($routes as $route) {
      if (($uri == $route) || ($uri == $route . '/')) {
        return True;
      }
    }
    return False;
  } else {
    return ($uri == $routes) || ($uri == $routes . '/');
  }
}

// Grabs the URI and breaks it apart in case we have querystring stuff
error_log('');
error_log('HTTP Request: ' . $_SERVER['REQUEST_URI']);
$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

if (preg_match('/^\/public\//', $request_uri) || $request_uri == '/favicon.ico') {
  // serve the requested resource as-is.
  return False;
} else if (match_routes($request_uri, '/')) {
    require 'index.html';
  } else {
  error_log("  404 Not Found: " . $request_uri);
  http_response_code(404);
}
