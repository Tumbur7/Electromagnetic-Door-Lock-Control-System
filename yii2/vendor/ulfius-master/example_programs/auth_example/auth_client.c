/**
 * 
 * Ulfius Framework example program
 * 
 * This example program send several requests to describe
 * the function ulfius_request_http behaviour
 *  
 * Copyright 2015-2017 Nicolas Mora <mail@babelouest.org>
 * 
 * License MIT
 *
 */

#include <stdio.h>
#include <string.h>

#define U_DISABLE_JANSSON
#define U_DISABLE_WEBSOCKET
#include "../../include/ulfius.h"

#define SERVER_URL "http://localhost:2884/auth/basic"
#define SERVER_URL_DEFAULT "http://localhost:2884/auth/default"

/**
 * decode a u_map into a string
 */
char * print_map(const struct _u_map * map) {
  char * line, * to_return = NULL;
  const char **keys;
  int len, i;
  if (map != NULL) {
    keys = u_map_enum_keys(map);
    for (i=0; keys[i] != NULL; i++) {
      len = snprintf(NULL, 0, "key is %s, value is %s\n", keys[i], u_map_get(map, keys[i]));
      line = o_malloc((len+1)*sizeof(char));
      snprintf(line, (len+1), "key is %s, value is %s\n", keys[i], u_map_get(map, keys[i]));
      if (to_return != NULL) {
        len = strlen(to_return) + strlen(line) + 1;
        to_return = o_realloc(to_return, (len+1)*sizeof(char));
      } else {
        to_return = o_malloc((strlen(line) + 1)*sizeof(char));
        to_return[0] = 0;
      }
      strcat(to_return, line);
      o_free(line);
    }
    return to_return;
  } else {
    return NULL;
  }
}

void print_response(struct _u_response * response) {
  if (response != NULL) {
    char response_body[response->binary_body_length + 1];
    strncpy(response_body, response->binary_body, response->binary_body_length);
    response_body[response->binary_body_length] = '\0';
    printf("status is\n%ld\n\nstring body is \n%s\n\n",
           response->status, response_body);
  }
}

int main (int argc, char **argv) {
  
  struct _u_response response;
  int res;
  struct _u_request req_list[6];
  
  y_init_logs("auth_client", Y_LOG_MODE_CONSOLE, Y_LOG_LEVEL_DEBUG, NULL, "logs start");
  
  ulfius_init_request(&req_list[0]);
  req_list[0].http_verb = o_strdup("GET");
  req_list[0].http_url = o_strdup(SERVER_URL);
  
  ulfius_init_request(&req_list[1]);
  req_list[1].http_verb = o_strdup("GET");
  req_list[1].http_url = o_strdup(SERVER_URL);
  req_list[1].auth_basic_user = o_strdup("test");
  req_list[1].auth_basic_password = o_strdup("testpassword");
  
  ulfius_init_request(&req_list[2]);
  req_list[2].http_verb = o_strdup("GET");
  req_list[2].http_url = o_strdup(SERVER_URL);
  req_list[2].auth_basic_user = o_strdup("test");
  req_list[2].auth_basic_password = o_strdup("wrongpassword");
  
  ulfius_init_request(&req_list[3]);
  req_list[3].http_verb = o_strdup("GET");
  req_list[3].http_url = o_strdup(SERVER_URL "/404");

  ulfius_init_request(&req_list[4]);
  req_list[4].http_verb = o_strdup("GET");
  req_list[4].http_url = o_strdup(SERVER_URL_DEFAULT);
  req_list[4].auth_basic_user = o_strdup("test");
  req_list[4].auth_basic_password = o_strdup("testpassword");
  
  ulfius_init_request(&req_list[5]);
  req_list[5].http_verb = o_strdup("GET");
  req_list[5].http_url = o_strdup(SERVER_URL_DEFAULT);
  req_list[5].auth_basic_user = o_strdup("test");
  req_list[5].auth_basic_password = o_strdup("wrongpassword");
    
  printf("Press <enter> to run auth tests no authentication\n");
  getchar();
  ulfius_init_response(&response);
  res = ulfius_send_http_request(&req_list[0], &response);
  if (res == U_OK) {
    print_response(&response);
  } else {
    printf("Error in http request: %d\n", res);
  }
  ulfius_clean_response(&response);
  
  printf("Press <enter> to run auth tests success authentication\n");
  getchar();
  ulfius_init_response(&response);
  res = ulfius_send_http_request(&req_list[1], &response);
  if (res == U_OK) {
    print_response(&response);
  } else {
    printf("Error in http request: %d\n", res);
  }
  ulfius_clean_response(&response);
  
  printf("Press <enter> to run auth tests error authentication\n");
  getchar();
  ulfius_init_response(&response);
  res = ulfius_send_http_request(&req_list[2], &response);
  if (res == U_OK) {
    print_response(&response);
  } else {
    printf("Error in http request: %d\n", res);
  }
  ulfius_clean_response(&response);
  
  printf("Press <enter> to run auth tests 404\n");
  getchar();
  ulfius_init_response(&response);
  res = ulfius_send_http_request(&req_list[3], &response);
  if (res == U_OK) {
    print_response(&response);
  } else {
    printf("Error in http request: %d\n", res);
  }
  ulfius_clean_response(&response);

  printf("Press <enter> to run default auth tests success authentication\n");
  getchar();
  ulfius_init_response(&response);
  res = ulfius_send_http_request(&req_list[4], &response);
  if (res == U_OK) {
    print_response(&response);
  } else {
    printf("Error in http request: %d\n", res);
  }
  ulfius_clean_response(&response);
  
  printf("Press <enter> to run default auth tests error authentication\n");
  getchar();
  ulfius_init_response(&response);
  res = ulfius_send_http_request(&req_list[5], &response);
  if (res == U_OK) {
    print_response(&response);
  } else {
    printf("Error in http request: %d\n", res);
  }
  ulfius_clean_response(&response);
    
  // Wait for the user to press <enter> on the console to quit the application
  printf("Press <enter> to quit test\n");
  getchar();
  
  ulfius_clean_request(&req_list[0]);
  ulfius_clean_request(&req_list[1]);
  ulfius_clean_request(&req_list[2]);
  ulfius_clean_request(&req_list[3]);
  ulfius_clean_request(&req_list[4]);
  ulfius_clean_request(&req_list[5]);
  y_close_logs();
  return 0;
}
