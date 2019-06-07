# Ulfius

HTTP Framework for REST Applications in C.

Based on [GNU Libmicrohttpd](https://www.gnu.org/software/libmicrohttpd/) for the backend web server, [Jansson](http://www.digip.org/jansson/) for the json manipulation library, and [Libcurl](http://curl.haxx.se/libcurl/) for the http/smtp client API.

Used to facilitate creation of web applications in C programs with a small memory footprint, as in embedded systems applications.

You can create webservices in HTTP or HTTPS mode, stream data, or implement server websockets.

## Hello World! example application

The source code of a hello world using Ulfius is the following:

```c
/**
 * test.c
 * Small Hello World! example
 * to compile with gcc, run the following command
 * gcc -o test test.c -lulfius
 */
#include <stdio.h>
#include <ulfius.h>

#define PORT 8080

/**
 * Callback function for the web application on /helloworld url call
 */
int callback_hello_world (const struct _u_request * request, struct _u_response * response, void * user_data) {
  ulfius_set_string_body_response(response, 200, "Hello World!");
  return U_CALLBACK_CONTINUE;
}

/**
 * main function
 */
int main(void) {
  struct _u_instance instance;

  // Initialize instance with the port number
  if (ulfius_init_instance(&instance, PORT, NULL, NULL) != U_OK) {
    fprintf(stderr, "Error ulfius_init_instance, abort\n");
    return(1);
  }

  // Endpoint list declaration
  ulfius_add_endpoint_by_val(&instance, "GET", "/helloworld", NULL, 0, &callback_hello_world, NULL);

  // Start the framework
  if (ulfius_start_framework(&instance) == U_OK) {
    printf("Start framework on port %d\n", instance.port);

    // Wait for the user to press <enter> on the console to quit the application
    getchar();
  } else {
    fprintf(stderr, "Error starting framework\n");
  }
  printf("End framework\n");

  ulfius_stop_framework(&instance);
  ulfius_clean_instance(&instance);

  return 0;
}
```

## Installation

See [INSTALL.md](INSTALL.md) file for installation details

## Documentation

See [API.md](API.md) file for API documentation details

## Example programs source code

Example programs are available to understand the different functionalities available, see [example_programs](https://github.com/babelouest/ulfius/blob/master/example_programs) folder for detailed sample source codes and documentation.

## Example callback functions

Example callback functions are available in the folder [example_callbacks](https://github.com/babelouest/ulfius/blob/master/example_callbacks). The example callback functions available are:
- static file server: to provide static files of a specific folder
- oauth2 bearer: to check the validity of a Oauth2 bearer jwt token. Requires [libjwt](https://github.com/benmcollins/libjwt).

## Projects using Ulfius framework

- [Angharad](https://github.com/babelouest/angharad), House automation system for ZWave and other types of devices
- [Glewlwyd](https://github.com/babelouest/glewlwyd), a lightweight OAuth2 authentication server that provides [JSON Web Tokens](https://jwt.io/)
- [Hutch](https://github.com/babelouest/hutch), a safe locker for passwords and other secrets, using client side encryption only
- [Taliesin](https://github.com/babelouest/taliesin), a lightweight audio streaming server
- [Taulas Raspberry Pi Serial interface](https://github.com/babelouest/taulas/tree/master/taulas_raspberrypi_serial), an interface for Arduino devices that implent [Taulas](https://github.com/babelouest/taulas/) protocol, a house automation protocol

## What's new in Ulfius 2.2?

Allow to use your own callback function when uploading files with `ulfius_set_upload_file_callback_function`, so a large file can be uploaded, even with the option `struct _u_instance.max_post_param_size` set.

## What's new in Ulfius 2.1?

I know it wasn't long since Ulfius 2.0 was released. But after some review and tests, I realized some adjustments had to be made to avoid bugs and to clean the framework a little bit more.

Some of the adjustments made in the new release:
- An annoying bug has been fixed that made streaming data a little buggy when used on raspbian. Now if you don't know the data size you're sending, use the macro U_STREAM_SIZE_UNKOWN instead of the previous value -1. There is some updates in the stream callback function parameter types. Check the [streaming data documentation](API.md#streaming-data).
- Fix bug on `ulfius_send_http_request` that didn't send back all headers value with the same name (#19)
- Fix websocket declaration structures to have them outside of the `ulfius.h`, because it could lead to horrifying bugs when you compile ulfius with websocket but add `#define U_DISABLE_WEBSOCKET` in your application.
- Add proxy value for outgoing requests (#18)
- Unify and update functions name `ulfius_set_[string|json|binary]_body`. You may have to update your legacy code.

The minor version number has been incremented, from 2.0 to 2.1 because some of the changes may require changes in your own code.

## What's new in Ulfius 2.0?

Ulfius 2.0 brings several changes that make the library incompatible with Ulfius 1.0.x branch. The goal of making Ulfius 2.0 is to make a spring cleaning of some functions, remove what is apparently useless, and should bring bugs and memory loss. The main new features are multiple callback functions and websockets implementation.

### Multiple callback functions

Instead of having an authentication callback function, then a main callback function, you can now have as much callback functions as you want for the same endpoint. A `priority` number has been added in the `struct _u_endpoint` and the auth_callback function and its dependencies have been removed.

For example, let's say you have the following endpoints defined:

- `GET` `/api/tomato/:tomato` => `tomato_get_callback` function, priority 10
- `GET` `/api/potato/:potato` => `potato_get_callback` function, priority 10
- `GET` `/api/*` => `api_validate_callback` function, priority 5
- `*` `*` => `authentication_callback` function, priority 1
- `GET` `*` => `gzip_body_callback` function, priority 99

Then if the client calls the url `GET` `/api/potato/myPotato`, the following callback functions will be called in that order:

- `authentication_callback`
- `api_validate_callback`
- `potato_get_callback`
- `gzip_body_callback`

*Warning:* In this example, the url parameter `myPotato` will be availabe only in the `potato_get_callback` function, because the other endpoints did not defined a url parameter after `/potato`.

If you need to communicate between callback functions for any purpose, you can use the new parameter `struct _u_response.shared_data`. This is a `void *` pointer initialized to `NULL`. If you use it, remember to free it after use, because the framework won't.

### Keep only binary_body in struct _u_request and struct _u_response

the values `string_body` and `json_body` have been removed from the structures `struct _u_request` and `struct _u_response`. This may be painless in the response if you used only the functions `ulfius_set_xxx_body_response`. Otherwise, you should make small arrangements to your code.

### Websockets

Ulfius now allows websockets communication between the client and the server. Check the [API.md](API.md#websockets-communication) file for implementation details.

Using websocket requires [libgnutls](https://www.gnutls.org/). It also requires a recent version of [Libmicrohttpd](https://www.gnu.org/software/libmicrohttpd/), at least 0.9.53.

If you dont need or can't use this feature, you can disable it by adding the option `WEBSOCKETFLAG=-DU_DISABLE_WEBSOCKET` to the make command when you build Ulfius:

```shell
$ make WEBSOCKETFLAG=-DU_DISABLE_WEBSOCKET
```

### Remove libjansson and libcurl hard dependency

In Ulfius 1.0, libjansson and libcurl were mandatory to build the library, but their usage was not in the core of the framework. Although they can be very useful, so the dependency is now optional.

They are enabled by default, but if you don't need them, you can disable them when you build Ulfius library.

#### libjansson dependency

This dependency allows to use the following functions:

```c
/**
 * ulfius_get_json_body_request
 * Get JSON structure from the request body if the request is valid
 */
json_t * ulfius_get_json_body_request(const struct _u_request * request, json_error_t * json_error);

/**
 * ulfius_set_json_body_request
 * Add a json_t body to a request
 * return U_OK on success
 */
int ulfius_set_json_body_request(struct _u_request * request, json_t * body);

/**
 * ulfius_set_json_body_response
 * Add a json_t body to a response
 * return U_OK on success
 */
int ulfius_set_json_body_response(struct _u_response * response, const uint status, const json_t * body);

/**
 * ulfius_get_json_body_response
 * Get JSON structure from the response body if the request is valid
 */
json_t * ulfius_get_json_body_response(struct _u_response * response, json_error_t * json_error);
```

If you want to disable these functions, append `JANSSONFLAG=-DU_DISABLE_JANSSON` when you build Ulfius library.

```
$ git clone https://github.com/babelouest/ulfius.git
$ cd ulfius/
$ git submodule update --init
$ make JANSSONFLAG=-DU_DISABLE_JANSSON
$ sudo make install
```

#### libcurl dependency

This dependency allows to use the following functions:

```c
/**
 * ulfius_send_http_request
 * Send a HTTP request and store the result into a _u_response
 * return U_OK on success
 */
int ulfius_send_http_request(const struct _u_request * request, struct _u_response * response);

/**
 * ulfius_send_http_streaming_request
 * Send a HTTP request and store the result into a _u_response
 * Except for the body which will be available using write_body_function in the write_body_data
 * return U_OK on success
 */
int ulfius_send_http_streaming_request(const struct _u_request * request, struct _u_response * response, size_t (* write_body_function)(void * contents, size_t size, size_t nmemb, void * user_data), void * write_body_data);

/**
 * ulfius_send_smtp_email
 * Send an email using libcurl
 * email is plain/text and UTF8 charset
 * host: smtp server host name
 * port: tcp port number (optional, 0 for default)
 * use_tls: true if the connection is tls secured
 * verify_certificate: true if you want to disable the certificate verification on a tls server
 * user: connection user name (optional, NULL: no user name)
 * password: connection password (optional, NULL: no password)
 * from: from address (mandatory)
 * to: to recipient address (mandatory)
 * cc: cc recipient address (optional, NULL: no cc)
 * bcc: bcc recipient address (optional, NULL: no bcc)
 * subject: email subject (mandatory)
 * mail_body: email body (mandatory)
 * return U_OK on success
 */
int ulfius_send_smtp_email(const char * host, 
                            const int port, 
                            const int use_tls, 
                            const int verify_certificate, 
                            const char * user, 
                            const char * password, 
                            const char * from, 
                            const char * to, 
                            const char * cc, 
                            const char * bcc, 
                            const char * subject, 
                            const char * mail_body);
```

If you want to disable these functions, append `CURLFLAG=-DU_DISABLE_CURL` when you build Ulfius library.

```
$ git clone https://github.com/babelouest/ulfius.git
$ cd ulfius/
$ git submodule update --init
$ make CURLFLAG=-DU_DISABLE_CURL
$ sudo make install
```

If you wan to disable libjansson and libcurl, you can append both parameters.

```
$ git clone https://github.com/babelouest/ulfius.git
$ cd ulfius/
$ git submodule update --init
$ make CURLFLAG=-DU_DISABLE_CURL JANSSONFLAG=-DU_DISABLE_JANSSON
$ sudo make install
```

### Ready-to-use callback functions

You can find some ready-to-use callback functions in the folder [example_callbacks](https://github.com/babelouest/ulfius/blob/master/example_callbacks).

## Questions, problems ?

I'm open for questions and suggestions, feel free to open an issue or send a pull request if you feel like it!
