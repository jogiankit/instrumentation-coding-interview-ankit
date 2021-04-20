/* solarwinds extension for PHP */

#ifdef HAVE_CONFIG_H
# include "config.h"
#endif

#include "php.h"
#include "ext/standard/info.h"
#include "php_solarwinds.h"

/* For compatibility with older PHP versions */
#ifndef ZEND_PARSE_PARAMETERS_NONE
#define ZEND_PARSE_PARAMETERS_NONE() \
        ZEND_PARSE_PARAMETERS_START(0, 0) \
        ZEND_PARSE_PARAMETERS_END()
#endif

/* {{{ PHP_MINIT_FUNCTION */
PHP_MINIT_FUNCTION(solarwinds)
{
#if defined(ZTS) && defined(COMPILE_DL_SOLARWINDS)
    ZEND_TSRMLS_CACHE_UPDATE();
#endif
    printf("PHP_MINIT_FUNCTION solarwinds\n");
    return SUCCESS;
}
/* }}} */

/* {{{ PHP_MSHUTDOWN_FUNCTION */
PHP_MSHUTDOWN_FUNCTION(solarwinds)
{
    printf("PHP_MSHUTDOWN_FUNCTION solarwinds\n");
    return SUCCESS;
}
/* }}} */

/* {{{ PHP_RINIT_FUNCTION */
PHP_RINIT_FUNCTION(solarwinds)
{
    printf("PHP_RINIT_FUNCTION solarwinds\n");
    return SUCCESS;
}
/* }}} */

/* {{{ PHP_RSHUTDOWN_FUNCTION */
PHP_RSHUTDOWN_FUNCTION(solarwinds)
{
    printf("PHP_RSHUTDOWN_FUNCTION solarwinds\n");
    return SUCCESS;
}
/* }}} */

/* {{{ PHP_MINFO_FUNCTION */
PHP_MINFO_FUNCTION(solarwinds)
{
    php_info_print_table_start();
    php_info_print_table_header(2, "solarwinds support", "enabled");
    php_info_print_table_row(2, "version", PHP_SOLARWINDS_VERSION);
    php_info_print_table_end();
}
/* }}} */

/* {{{ solarwinds_module_entry */
zend_module_entry solarwinds_module_entry = {
        STANDARD_MODULE_HEADER,
        "solarwinds",               /* Extension name */
        NULL,                       /* zend_function_entry */
        PHP_MINIT(solarwinds),      /* PHP_MINIT - Module initialization */
        PHP_MSHUTDOWN(solarwinds),  /* PHP_MSHUTDOWN - Module shutdown */
        PHP_RINIT(solarwinds),      /* PHP_RINIT - Request initialization */
        PHP_RSHUTDOWN(solarwinds),  /* PHP_RSHUTDOWN - Request shutdown */
        PHP_MINFO(solarwinds),      /* PHP_MINFO - Module info */
        PHP_SOLARWINDS_VERSION,     /* Version */
        STANDARD_MODULE_PROPERTIES
};
/* }}} */

#ifdef COMPILE_DL_SOLARWINDS
# ifdef ZTS
ZEND_TSRMLS_CACHE_DEFINE()
# endif
ZEND_GET_MODULE(solarwinds)
#endif
